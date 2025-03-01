<?php

declare(strict_types=1);

namespace App\Services\Bible;

use Illuminate\Support\Facades\File;

class BooksService
{
    public function books(): array
    {
        return cache()->rememberForever(
            'books',
            piper(base_path('bibles/books.json'))
                ->to(File::json(...))
            ->up(...),
        );
    }
}
