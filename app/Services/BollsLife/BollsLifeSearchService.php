<?php

declare(strict_types=1);

namespace App\Services\BollsLife;

class BollsLifeSearchService
{
    public function searchInChapterText(array $chapterArray, string|null $searchTerm): SearchResult
    {
        $matchesCount = 0;

        // If search term is not empty.
        if ($searchTerm && strlen($searchTerm)) {
            $search = e($searchTerm); // Escape search.
            // Find and replace $search in $json array with <strong>Text<strong>.
            $chapterArray = collect($chapterArray)->map(function ($verseArray) use ($search, &$matchesCount) {
                $count = 0;
                $verseArray['text'] = preg_replace(
                    "/$search/i",
                    "<strong class='text-warning'>$search</strong>",
                    e($verseArray['text']),
                    -1,
                    $count,
                );

                if ($count > 0) {
                    $matchesCount += $count;
                }

                return $verseArray;
            })->all();
        }

        return new SearchResult(
            chapterArray: $chapterArray,
            matchesCount: $matchesCount
        );
    }
}
