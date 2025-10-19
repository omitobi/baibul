<?php

declare(strict_types=1);

namespace App\Services\BibleRss;

use App\Services\BollsLife\BollsLifeService;

class CustomRss implements Rss
{
    public function getFeedData(): array
    {
        $verseContent = app(BollsLifeService::class)->getVerseContent();
        return [
            'title' => $verseContent->verseJson['text'],
            'permalink' => '',
            ...collect([''])
                ->map(fn($item) => [
                    'scripture_reference' => $verseContent->verseTitle,
                    'description' => $verseContent->verseJson['text'],
                    'content' => $verseContent->verseJson['text'],
                    'date' => now()->toFormattedDayDateString('Y-m-d'),
                    'link' => (string) url('/'),
                    'reference_version' => $verseContent->version,
                ])->first()
        ];
    }
}
