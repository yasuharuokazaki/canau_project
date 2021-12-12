<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('OAuth') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    {{-- @if($noZoomCode) --}}
                    <div class="alert alert-danger mb-3" role="alert">
                        <h4 class="alert-heading">OAuth認証成功</h4>

                        <h2>Make Meeting</h2>
                    </div>
                    {{-- @else --}}
                    {{-- <h1>Return 一覧</h1> --}}
                    {{-- <p>アクセスToken:{{ $access_token }}</p> --}}
                    <h1>Meeting作成フォーム</h1>
                    <div class="main-content">
                        <form method="post" action="/make_meeting">
                            @csrf
                            <input type="hidden" name="access_token" value="{{ $access_token }}" hidden=True>
                            {{-- @if(isset($error)) --}}
                            {{-- <div class="alert alert-danger mb-3" role="alert">
                                入力項目に誤りがあります。ご確認の上、もう一度送信をお願いします。
                            </div> --}}
                            {{-- @endif --}}

                            <div class="mb-3">
                                <label for="email" class="form-label">メールアドレス<span class="err"> *入力必須</span></label>
                                <input type="email" name="email" class="form-control" id="email" placeholder="name@example.com">
                                {{-- @if(isset($error['companyname']))<p class="err">{{$error['companyname'][0]}}</p>@endif --}}
                            </div>

                            <div class="mb-3">
                                <label for="your-name" class="form-label">お名前<span class="err"> *入力必須</span></label>
                                <input type="text" name="yourname" class="form-control" id="your-name" placeholder="お名前をご入力ください" required>
                                {{-- @if(isset($error['companyname']))<p class="err">{{$error['companyname'][0]}}</p>@endif --}}
                            </div>

                            <div class="mb-3">
                                <label for="company-name" class="form-label">職業名<span class="err"> *入力必須</span></label>
                                <input type="text" name="workname" class="form-control" id="company-name" placeholder="株式会社〇〇〇〇">
                                {{-- @if(isset($error['companyname']))<p class="err">{{$error['companyname'][0]}}</p>@endif --}}
                            </div>

                            <div class="mb-3">
                                <label for="startAt" class="form-label">ミーティング開始日時</label>
                                <input type="datetime-local" name="startAt" class="form-control" id="startAt" placeholder="name@example.com">
                                {{-- @if(isset($error['companyname']))<p class="err">{{$error['companyname'][0]}}</p>@endif --}}
                            </div>

                            <div class="mb-3">
                                <label for="content" class="form-label">仕事の内容<span class="err"> *入力必須</span></label>
                                <textarea name="content" class="form-control" id="content" rows="3"></textarea>
                                <small>1000文字以内でご入力ください。</small>
                                {{-- @if(isset($error['companyname']))<p class="err">{{$error['companyname'][0]}}</p>@endif --}}
                            </div>

                            <div class="col-auto">
                                <button type="submit" class="submit-btn btn btn-primary btn-lg">送信</button>
                            </div>
                        </form>
                    </div>

                    {{-- @endif --}}
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
