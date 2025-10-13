<?php

namespace App\Services\BibleRss;

class BibleGateway implements Rss
{
    public function getFeedData(): array
    {
        $feed = cache()->remember(
            'bible-feed',
            \Carbon\Carbon::now()->endOfDay(),
            fn() => \Feeds::make('http://www.biblegateway.com/usage/votd/rss/votd.rdf?31'),
        );

        return array(
            'title'     => $feed->get_title(),
            'permalink' => $feed->get_permalink(),
            ...collect($feed->get_items())
                ->map(fn($item) => [
                    'scripture_reference' => $item->get_title(),
                    'description' => $item->get_description(),
                    'content' => $item->get_content(),
                    'date' => $item->get_date(),
                    'link' => $item->data['child'][""]['guid'][0]['data'] ?? null,
                    'reference_version' => 'NIV'
                ])->first()
        );
    }
}
