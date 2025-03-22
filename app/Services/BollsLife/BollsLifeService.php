<?php

namespace App\Services\BollsLife;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
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
            ->firstWhere('name', Str::title($book));

        $chapters = $chapterInBolls?->chapters ?? 1;
        // 43 is John.
        $bookId = $chapterInBolls?->bookid ?? 43;
        $bookName = $chapterInBolls?->name ?? 'John';


        // Let\s get the bible chapter.
        $maxChapter = min($chapters ?? 1, $chapter);

        $url = sprintf(
            'https://bolls.life/get-chapter/%s/%s/%s',
            $version,
            $bookId,
            $maxChapter,
        );

        $cache = \cache()->remember(...);
        $chapterJson = $cache($url, $this->cacheTime, fn() => habitue($url)->get()->toArray());

        $nextChapter = min($maxChapter + 1, $chapters);
        $previousChapter = max($maxChapter - 1, 1);

        $chapterTitle = sprintf("%s %s", $bookName, $maxChapter);

        return new ChapterContent(
            bookName: $bookName,
            chapterJson: $chapterJson,
            chapterTitle: $chapterTitle,
            previousChapter: $previousChapter,
            nextChapter: $nextChapter,
        );
    }
}
