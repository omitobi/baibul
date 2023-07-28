<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css'])
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
        <!-- Styles -->
        <style>
        </style>
    </head>
    <body class="antialiased">
        <div class="card mb-3" style="max-width: 400px; min-width: 400px; min-height:250px; max-height: 250px">
                <div class="row g-0">
                    <div class="col-4 bg-light">
                        <img src="{{ asset('images/bible.jpg') }}" class="img-fluid rounded-start" alt="...">
                        <div class="small text-truncate">
                            <sup>
                                <a href="{{ $link }}" class="">{{ $link }}</a>
                            </sup>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="card-body">
                            <h5 class="card-title">{{ $scripture_reference }} {{ $reference_version }}</h5>
                            <p class="card-text small">{!! $content !!}</p>
                            <p class="card-text"><small class="text-body-secondary">{{ $date }}</small></p>
                        </div>
                    </div>
                </div>
            </div>
    </body>
</html>
