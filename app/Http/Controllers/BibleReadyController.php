<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Transprime\Arrayed\Arrayed;
use Transprime\Url\Url;

class BibleReadyController
{
    /**
     * @link https://bolls.life/api/#Get%20a%20translation
     */
    public static function bollsChapter(Request $request): View
    {
        // 43 is John.
        $book = $request->get('book', 'John');
        $chapter = $request->get('chapter', 1);
        $version = piper('esv')
            ->to($request->get(...), 'version')
            ->up(strtoupper(...));

//        dd($book, $chapter, $version, $request->all());

        /** @var Arrayed $bookInBolls */
        $bookInBolls = piper('bibles/bolls.life.esv.json')
            ->to(base_path(...))
            ->to(File::get(...))
            ->to(json_decode(...))
            ->to(fn($d) => (array) $d)
            ->up(arrayed(...));

        $chapterInBolls = $bookInBolls
            ->offsetGet($bookInBolls->search(fn($d) => $d->name === $book));
        $maxChapter = min($chapterInBolls->chapters, $chapter);

        // Let\s get the bible chapter.
        $url = sprintf(
            'https://bolls.life/get-chapter/%s/%s/%s',
            $version,
            $chapterInBolls->bookid,
            $maxChapter,
        );

        $cache = \cache()->remember(...);
        $chapterJson = $cache($url, 360, fn() => Http::get($url)->json());

        $nextChapter = min($maxChapter + 1, $chapterInBolls->chapters);
        $previousChapter = max($maxChapter - 1, 1);

        $previousChapterUrl = Url::make(
            fullDomain: route('bolls-life-bible-ready'),
            query: ['book' => $book, 'chapter' => $previousChapter],
        )->toString();

        $nextChapterUrl = Url::make(
            fullDomain: route('bolls-life-bible-ready'),
            query: ['book' => $book, 'chapter' => $nextChapter],
        )->toString();

        return view('bolls-life-bible', [
            'chapterJson' => $chapterJson,
            'chapterTitle' => sprintf("%s %s", $chapterInBolls->name, $maxChapter),
            'bibleVersion' => 'ESV',
            'nextChapter' => $nextChapter,
            'previousChapter' => $previousChapter,
            'previousChapterUrl' => $previousChapterUrl,
            'nextChapterUrl' => $nextChapterUrl,
        ]);
    }
}
