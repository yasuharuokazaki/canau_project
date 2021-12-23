<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\DateTimeZone;
use DateTimeZone as GlobalDateTimeZone;

class ApiController extends Controller
{

    // OAuth認証後の処理
    public function oauth_success(Request $request){
        $oauthReturn = $request;
        // ddd($oauthReturn);

        // apiアクセスkey作成
        $basic = base64_encode(env('ZOOM_CLIENT_ID').':'.env('ZOOM_CLIENT_SECRET'));

        // HTTPS通信のためのクラス作成
        $client = new Client([
            'headers' => ['Authorization' => 'Basic '.$basic]
        ]);

        // APIたたく
        $res = $client->request('POST','https://zoom.us/oauth/token',[
            'query' => [
                'grant_type'=>'authorization_code',
                'code'=>$request['code'],
                'redirect_uri'=>'http://127.0.0.1:8000/zoom/auth'
            ]
        ]);

        // APIレスポンス
        $result = json_decode($res->getBody()->getContents());
        $access_token = $result->access_token;
        return view("oauth_success",compact('access_token'));
    }

    // ミーティング作成
    public function make_meeting(Request $request){
        // バリデーション
        $validator = Validator::make($request->all(),[
            'email'=>'required|email:rfc',
            'yourname'=>'required',
            'workname'=>'required',
            'startAt'=>'date|required',
            'content'=>'required|max:1000',
        ]);

        $error = $validator->getMessageBag()->toArray();

        if($validator->fails()){
            return view('form',compact("error"));
        }

        $topic = $request->yourname."様（".$request->workname.") ミーティング";

        // $user = auth()->user();←zoomアプリユーザーという意味。今回は自分のみだから、指定せず
        // $zoom_usr = $this->me();

        // Zoom上のCanauのアカウントにミーティングを作成するエンドポイントを指定するURL
        $url = 'https://api.zoom.us/v2/users/me/meetings';

        // HTTP通信用のクラス作成
        $client = new \GuzzleHttp\Client([
            'headers' => [
                'Authorization' => 'Bearer '.$request->access_token,
                'Content-Type'=>'application/json'
            ],
        ]);

        // $meeting_password = substr(base_convert(bin2hex(openssl_random_pseudo_bytes(9)),16,36),0,9);
        // dd($request);
        // ミーティング作成のためにAPIたたく
        $time = $request->startAt;
        // dd($time.':00');
        // $time = strtotime($time);
        // dd($time);
        // $time = date("Y-m-d\TH:m:s",$time);
        // dd($time);
        $start_time=$time.':00';
        // remove 'Z'
        // dd($start_time);
        $res = $client->request('POST',$url,[
            \GuzzleHttp\RequestOptions::JSON => [
                'topic'=>$topic,
                'type'=>2,
                'start_time'=>$start_time,
                'timezone'=>'Asia/Tokyo',
                // 'password'=>$meeting_password←ミーティングパスワード。今回は指定せず
            ]
        ]);

        $result = json_decode($res->getBody()->getContents());

        // データベースにミーティング情報を保存したければ、以下にモデルのクラスを作成して保存
        // Meething.tablename->some_var
        // これは、デモ用なので、ミーティング情報の保存までは作成してません。
        $t = new DateTime($result->start_time);
        $time = $t->setTimezone(new GlobalDateTimeZone('Asia/Tokyo'));
        // $time_zone = new DateTimeZone('Asia/Tokyo');

        // dd($time->format('Y-m-d H:i:s'));
        $result_array = array(
            "topic"=>$result->topic,
            "startAt"=>$time->format('Y-m-d H:i:s'),
            "startUrl"=>$result->join_url,
        );
        // dd($result);
        return view("meeting_info",compact('result_array'));
    }
}
