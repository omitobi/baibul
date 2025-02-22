<?php

use App\Http\Controllers\BibleReadyController;
use Illuminate\Support\Facades\Route;

Route::get('/bolls-life/bible-ready', BibleReadyController::bollsChapter(...))
    ->name('bolls-life-bible-ready');
Route::view('bible-ready', 'esv-bible-ready');
Route::view('bible-ready-main', 'bible-ready-main')->name('bible-ready-main');
Route::get('/', function () {
    $feed = \Feeds::make('http://www.biblegateway.com/usage/votd/rss/votd.rdf?31');

    $data = array(
        'title'     => $feed->get_title(),
        'permalink' => $feed->get_permalink(),
        ...collect($feed->get_items())
            ->map(fn($item) => [
                'scripture_reference' => $item->get_title(),
                'description' => $item->get_description(),
                'content' => $item->get_content(),
                'date' => $item->get_date(),
                'link' => $item->data['child'][""]['guid'][0]['data'] ?? null,
                'reference_version' => 'NIV'
        ])->first()
    );

    $data['books'] = json_decode(
        \Illuminate\Support\Facades\File::get(base_path('bibles/books.json')),
        true
    );

    $data['chapters'] = range(1, 150);

    return view('welcome', $data);
});
