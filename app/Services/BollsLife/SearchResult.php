<?php

declare(strict_types=1);

namespace App\Services\BollsLife;

class SearchResult
{
    public function __construct(
        public readonly array $chapterArray,
        public readonly int $matchesCount,
    ) {
    }
}
