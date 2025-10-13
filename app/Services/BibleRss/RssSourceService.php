<?php

declare(strict_types=1);

namespace App\Services\BibleRss;

use Illuminate\Support\Facades\Log;

class RssSourceService
{
    public function getData(): array
    {
        foreach ($this->sources() as $source) {
            try {
                return $source->getFeedData();
            } catch (\Throwable $e) {
                Log::warning('Error getting feed data', [
                    'source' => $source,
                    'exception' => $e,
                ]);
            }
        }

        throw new \Exception('No feed data found');
    }

    /**
     * @return array<Rss>
     */
    protected function sources(): array
    {
        return [
            new BibleGateway(),
            new CustomRss(),
        ];
    }
}
