<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Chatkun</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <script
  src="https://code.jquery.com/jquery-3.5.1.js"
  integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
  crossorigin="anonymous"></script>
    <script src="{{ asset('js/all.js') }}"></script>
</head>
<body>
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="title m-b-md">
                Chat
            </div>
                <ul id="chatman">
                    <li>こんにちは!</li>
                </ul>
                <div id="txtarea1">
                    <div>投稿</div>
                    <div id="top_form1">
                        <textarea id="txt1" name="name" cols="15" rows="1" placeholder="name">tanaka</textarea>
                        <textarea id="txt2" name="mail" cols="15" rows="1" placeholder="mail"></textarea>
                    </div>
                    <div id="btm_form1">
                        <textarea id="txt3" name="text" cols="50" rows="5" placeholder="text">tess</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">送信</button>
                </div>
                <div>
                                <button type="button" id="chatX" onclick="chat()">更新</button>
                                </div>
                                <br>
        </div>
    </div>
</body>
</html>
