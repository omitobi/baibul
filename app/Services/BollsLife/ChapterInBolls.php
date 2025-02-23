<?php

declare(strict_types=1);

namespace App\Services\BollsLife;

class ChapterInBolls
{
    public function __construct(
        public readonly int $chapters,
        public readonly int $bookid,
        public readonly string $name,
    ) {
    }
}
