<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>
    @vite(['resources/css/app.css'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
            crossorigin="anonymous"></script>
    <!-- Styles -->
    <style>
    </style>
</head>
<body class="antialiased">
<div style="max-width: 400px; min-width: 400px; min-height:250px; max-height: 250px">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" data-bs-toggle="tab" href="#verse">Daily Verse</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#reader">Reader</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#bible-ready">Bible Ready</a>
        </li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content mt-1">
        <div class="tab-pane container active" id="verse">
            <div class="card mb-3 border-0"
                 style="max-width: 400px; min-width: 400px; min-height:250px; max-height: 250px">
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
        </div>
        <div class="tab-pane container fade" id="reader">
            <div class="card mb-3 border-0">
                <div class="row g-0">
                    <div class="col-12">
                        <div class="card-body">
                            <h5 class="card-title border-bottom py-1">Bible Reader</h5>
                            <form class="row" method="get">
                                <div class="col-6">
                                    <label for="book" class="form-label">Book</label>
                                    <input
                                        class="form-control"
                                        list="books"
                                        id="book"
                                        name="book"
                                        value="{{ request('book', 'John') }}"
                                        placeholder="Type to search...">
                                    <datalist id="books">
                                        @foreach($books ?? [] as $book)
                                            <option value="{{ $book }}" onclick="getAudio('book', '{{ $book }}')">
                                        @endforeach
                                    </datalist>
                                </div>
                                <div class="col-4">
                                    <label for="chapter" class="form-label">Chapter</label>
                                    <input
                                        class="form-control"
                                        list="chapters"
                                        id="chapter"
                                        name="chapter"
                                        value="{{ request('chapter', '1') }}"
                                        placeholder="Search...">
                                    <datalist id="chapters">
                                        @foreach($chapters ?? [] as $chapter)
                                            <option value="{{ $chapter }}">
                                        @endforeach
                                    </datalist>
                                </div>
                                <div class="col-2">
                                    <label for="submit" class="form-label">..</label>
                                    <button type="submit" class="btn btn-outline-dark">Go</button>
                                </div>
                            </form>

                            <iframe
                                src="https://www.esv.org/audio-player/ {{request('book', 'John') }} + {{ request('chapter', '1') }}"
                                class="mt-2"
                                style="border: 0; width: 100%; height: 109px;"
                            ></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane container fade" id="bible-ready">
            <div class="card mb-3 border-0">
                <div class="row g-0">
                    <div class="col-12">
                        <div class="card-body">
                            <h5 class="card-title border-bottom py-1">Bible Ready</h5>
                            <div class="row">
                                <div class="col-12">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Search" aria-label="Search"
                                               aria-describedby="button-addon2">
                                        <button class="btn btn-outline-dark" type="button" id="button-addon2">Search
                                        </button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="offset-3 col-md-6">
                                        <a class="btn btn-lg btn-outline-dark" href="{{ route('bible-ready-main') }}" target="_blank">Open</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
