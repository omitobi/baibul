<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\BollsLife\ChapterInBolls;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
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
        $book = piper($request->get('book', 'John'))
                ->to(Str::lower(...))
                ->to(Str::ucfirst(...))
                ->up();
        $chapter = (int) $request->get('chapter', 1);
        $version = piper('esv')
            ->to($request->get(...), 'version')
            ->up(strtoupper(...));

//        dd($book, $chapter, $version, $request->all());

        /** @var ChapterInBolls[]|Arrayed $bookInBolls */
        $bookInBolls = piper('bibles/bolls.life.esv.json')
            ->to(base_path(...))
            ->to(File::json(...))
            ->to(fn($d) => (array) $d)
            ->up(arrayed(...));

        $bookInBolls = $bookInBolls->map(fn(array $chapter) => new ChapterInBolls(
            chapters: $chapter['chapters'],
            bookid: $chapter['bookid'],
            name: $chapter['name']
        ));

        /** @var ChapterInBolls $chapterInBolls */
        $chapterInBolls = $bookInBolls
            ->collect()
            ->firstWhere('name', $book);

        // Let\s get the bible chapter.
        $maxChapter = min($chapterInBolls->chapters, $chapter);

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
            'currentBook' => $book,
            'currentChapter' => $chapter,
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
