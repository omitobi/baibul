<?php

declare(strict_types=1);

namespace App\Services\Bible;

use Illuminate\Support\Facades\File;

class BooksService
{
    public function books(bool $forceRefresh = false): array
    {
        $getBooks = piper(base_path('bibles/books.json'))
            ->to(File::json(...))->up(...);

        if ($forceRefresh) {
            $books = cache()->pull('books');
        }

        return $books ?? cache()->rememberForever('books', $getBooks);
    }
}
