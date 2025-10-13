<?php

namespace App\Services\BollsLife;

class VerseContent
{
    public function __construct(
        public readonly string $bookName,
        public readonly array $verseJson,
        public readonly string $verseTitle,
        public readonly int $verse,
        public readonly string $version,
    ) {
    }
}
