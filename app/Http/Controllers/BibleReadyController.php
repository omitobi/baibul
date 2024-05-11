<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Transprime\Arrayed\Arrayed;

class BibleReadyController
{
    /**
     * @link https://bolls.life/api/#Get%20a%20translation
     */
    public function bollsChapter(Request $request)
    {
        // 43 is John.
        $book = $request->get('book', 'John');
        $chapter = $request->get('chapter', 1);
        $version = piper('esv')
            ->to($request->get(...), 'version')
            ->up(strtoupper(...));

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

        return view('bolls-life-bible', [
            'chapterJson' => $chapterJson,
            'chapterTitle' => sprintf("%s %s", $chapterInBolls->name, $maxChapter),
            'bibleVersion' => 'ESV',
        ]);
    }
}
