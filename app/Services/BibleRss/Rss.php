<?php

declare(strict_types=1);

namespace App\Services\BibleRss;

interface Rss
{
    public function getFeedData(): array;
}
