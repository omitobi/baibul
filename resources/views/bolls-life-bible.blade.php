<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bible Ready - {{ $chapterTitle }} {{ $bibleVersion }}</title>
</head>
<body>

<div class="container">

    <div class="row">
        <div class="col-md-12">
            <h1>{{ $chapterTitle }}</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            @foreach($chapterJson as $chapter)
                <div>
                    <strong>{{ $chapter['verse'] }}</strong>
                    {{ $chapter['text'] }}
                </div>
                <hr>
            @endforeach
        </div>
    </div>

</div>

</body>
</html>
