<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bible Ready - {{ request('book', 'John') }} {{ request('chapter', 1) }} ESV</title>
</head>
<body>

<div class="tab-pane container fade" id="bible-ready">
    <div class="card mb-3 border-0">
        <div class="row g-0">
            <div class="col-12">
                <div class="card-body">
                    <iframe
                        src="{{
                            \Transprime\Url\Url::make(
                                 fullDomain: url('/bible-ready'),
                                 query: ['book' => request('book', 'John'), 'chapter' => request('chapter', 1)],
                            )
                        }}"
                        class="mt-2"
                        style="border: 0; width: 100%; height: 100%;"
                    ></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
