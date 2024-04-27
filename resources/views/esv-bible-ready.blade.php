@php
$book = request('book', 'John');
$chapter = request('chapter', 1);
@endphp
{!! \Illuminate\Support\Facades\Http::get("https://www.esv.org/${book}+${chapter}/") !!}
