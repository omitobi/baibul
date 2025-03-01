<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\BollsLife\BollsLifeService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Transprime\Url\Url;

class BibleReadyController
{
    public static function bollsChapter(Request $request, BollsLifeService $bollsLifeService): View
    {
        // 43 is John.
        $book = piper($request->get('book', 'John'))
            ->to(Str::lower(...))
            ->to(Str::ucfirst(...))
            ->up();
        $chapter = (int)$request->get('chapter', 1);
        $version = piper('esv')
            ->to($request->get(...), 'version')
            ->up(strtoupper(...));

        $chapterContent = $bollsLifeService->getChapterContent(
            book: $book,
            chapter: $chapter,
            version: $version,
        );
        $previousChapterUrl = Url::make(
            fullDomain: route('bolls-life-bible-ready'),
            query: ['book' => $book, 'chapter' => $chapterContent->previousChapter],
        )->toString();

        $nextChapterUrl = Url::make(
            fullDomain: route('bolls-life-bible-ready'),
            query: ['book' => $book, 'chapter' => $chapterContent->nextChapter],
        )->toString();

        $books = cache()->rememberForever(
            'books',
            piper(base_path('bibles/books.json'))
                ->to(File::json(...))
                ->up(...),
        );

        return view('bolls-life-bible', [
            'books' => $books,
            'currentBook' => $book,
            'currentChapter' => $chapter,
            'chapterJson' => $chapterContent->chapterJson,
            'chapterTitle' => $chapterContent->chapterTitle,
            'bibleVersion' => 'ESV',
            'nextChapter' => $chapterContent->nextChapter,
            'previousChapter' => $chapterContent->previousChapter,
            'previousChapterUrl' => $previousChapterUrl,
            'nextChapterUrl' => $nextChapterUrl,
        ]);
    }
}
