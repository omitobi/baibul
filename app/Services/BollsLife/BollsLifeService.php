<?php

namespace App\Services\BollsLife;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Transprime\Arrayed\Arrayed;

/**
 * @link https://bolls.life/api/#Get%20a%20translation
 */
class BollsLifeService
{
    public function __construct(public readonly int $cacheTime = 360)
    {
    }

    public function getChapterContent(
        string $book,
        int $chapter,
        string $version,
    ): ChapterContent {
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
        $chapterJson = $cache($url, $this->cacheTime, fn() => Http::get($url)->json());

        $nextChapter = min($maxChapter + 1, $chapterInBolls->chapters);
        $previousChapter = max($maxChapter - 1, 1);

        $chapterTitle = sprintf("%s %s", $chapterInBolls->name, $maxChapter);

        return new ChapterContent(
            chapterJson: $chapterJson,
            chapterTitle: $chapterTitle,
            previousChapter: $previousChapter,
            nextChapter: $nextChapter,
        );
    }
}
