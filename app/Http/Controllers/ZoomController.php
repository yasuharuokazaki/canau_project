<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class ZoomController extends Controller
{
    //認証が終わっていない場合

        public function index(Request $request){
            $user = auth()->user();
            // $noZoomCode = $user->zoom_code == null;
            $zoomOuthLink = 'https://zoom.us/oauth/authorize?'.http_build_query([
                'response_type'=>'code',
                'redirect_uri'=>env('APP_URL').'/zoom/auth',
                'client_id'=>env('ZOOM_CLIENT_ID'),
            ]);
            // $oauthSuccess=false;
            // $meetings = Meeting::all();

            return view('meeting_admin',compact('zoomOuthLink'));
        }



    }

