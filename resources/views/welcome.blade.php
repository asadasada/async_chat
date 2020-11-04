<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Chatkun</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
</head>
<body>
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="title m-b-md">
                Chat
            </div>
            @if(isset($values))
            {{ var_dump($values) }}
            @foreach($values['vars'] as $var)
            <ol class="lists">
                <li>{{ $values['name']."<<<".$var.":IPアドレス:".$values['ip']}}</li>
            </ol>
            @endforeach
            @endif
            <form action= "#" method="post" accept-charset="utf-8">
                {{ csrf_field() }}
                <div id="txtarea1">
                    <div>投稿</div>
                    <div id="top_form1">
                        <textarea id="txt1" name="name" cols="15" rows="1" placeholder="name">tanaka</textarea>
                        <textarea id="txt2" name="mail" cols="15" rows="1" placeholder="mail"></textarea>
                    </div>
                    <div id="btm_form1">
                        <textarea name="text" cols="50" rows="5" placeholder="text">tess</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">送信</button>
                </div>
                <div>
                                <button type="button" id="texts_koushin">更新</button>
                                </div>
                                <br>
            </form>
        </div>
    </div>
</body>
</html>
