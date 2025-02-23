<?php

declare(strict_types=1);

namespace App\Services\BollsLife;

class ChapterContent
{
    public function __construct(
        public readonly array $chapterJson,
        public readonly string $chapterTitle,
        public readonly int $previousChapter,
        public readonly int $nextChapter,
    ) {
    }
}
