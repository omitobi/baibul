<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bible Ready - {{ $chapterTitle }} {{ $bibleVersion }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>
    @vite(['resources/css/app.css'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js" crossorigin="anonymous"></script>
    <style>
        .search-box {
            display: flex;
            align-items: center;
            border: 2px solid #ccc;
            border-radius: 25px;
            padding: 5px 10px;
            width: 300px;
        }

        .search-box input {
            border: none;
            outline: none;
            width: 75%;
            padding: 5px;
            font-size: 16px;
        }

        .search-box i {
            color: #555;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row my-3 mx-1">
        <div class="col-md-8 offset-2">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <form method="get" class="form-check-inline">
                            <div class="col-6 offset-4">

                                    <div class="search-box">
                                        <label for="bible-ready-search"></label>
                                        <input type="text"
                                           id="bible-ready-search"
                                           value="{{ request('search') }}"
                                           name="search"
                                           placeholder="Search and press Enter...">
                                        <i class="fas fa-search "></i>
                                         &nbsp; | &nbsp; <span class="small">{{ $countOfSearch ?: 0 }}</span>
                                    </div>

                                <input
                                    type="hidden"
                                    class="form-control"
                                    name="chapter"
                                    value="{{ request('chapter', 1) }}"
                                >
                                <input
                                    type="hidden"
                                    class="form-control"
                                    name="book"
                                    value="{{ $currentBook }}"
                                >
                            </div>
                        </form>
                    </div>
                    <form class="row mt-2" method="get">
                        <div class="col-6">
                            <label for="bible-ready-book" class="form-label">Book</label>
                            <input
                                class="form-control"
                                list="books"
                                id="bible-ready-book"
                                name="book"
                                value="{{ $currentBook }}"
                                placeholder="Type to search..."
                                onchange="updateReadyBook(this)"
                            >
                            <datalist id="books">
                                @foreach($books ?? [] as $book)
                                    <option value="{{ $book }}">
                                @endforeach
                            </datalist>
                        </div>
                        <div class="col-4">
                            <label for="bible-ready-chapter" class="form-label">Chapter</label>
                            <input
                                class="form-control"
                                list="chapters"
                                id="bible-ready-chapter"
                                name="chapter"
                                value="{{ request('chapter', 1) }}"
                                placeholder="Search..."
                                onchange="updateReadyChapter(this)"
                            >
                            <datalist id="chapters">
                                @foreach($chapters ?? [] as $chapter)
                                    <option value="{{ $chapter }}">
                                @endforeach
                            </datalist>
                        </div>
                        <div class="col-1">
                            <label for="bible-ready-chapter" class="form-label">...</label>
                            <a class="btn btn-outline-dark"
                               id="bible-ready-open-btn"
                               href="{{ route('bolls-life-bible-ready', ['book' => $currentBook, 'chapter' => $currentChapter]) }}"
                            >Open</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row my-3">
        <div class="col-md-12 d-flex justify-content-between">
            <h5>{{ $chapterTitle }}</h5>
            <div>
                <a
                    href="{{ $previousChapterUrl }}"
                    class="btn btn-sm btn-outline-dark rounded-0"
                >&lt;&lt;</a>
                <a
                    href="{{ $nextChapterUrl }}"
                    class="btn btn-sm btn-outline-dark rounded-0"
                >&gt;&gt;</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            @foreach($chapterJson as $chapter)
                <div>
                    <strong>{{ $chapter['verse'] }}</strong>
                    {!! $chapter['text'] !!}
                </div>
                <hr>
            @endforeach
        </div>
    </div>

    <div class="row my-2">
        <div class="col-md-12">
            <a
                href="{{ $previousChapterUrl }}"
                class="btn btn-sm btn-outline-dark rounded-0"
            >&lt;&lt; Previous Chapter</a>
            <a
                href="{{ $nextChapterUrl }}"
                class="btn btn-sm btn-outline-dark rounded-0"
            >&gt;&gt; Next Chapter</a>
        </div>
    </div>

</div>
@include('bible-chapter-switch-script')
<script></script>
</body>
</html>
