<?php

namespace App\Http\FormRequests\BollsLifeBible;

use App\Services\Bible\BooksService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BibleChapterRequest extends FormRequest
{
    public function authorize(): true
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'search' => ['nullable', 'alpha:ascii', 'min:1', 'max:1000'],
            'chapter' => ['required', 'integer', 'min:1','max:150'],
            'book' => [
                'required',
                'string',
                'ascii',
                'min:3',
                'max:255',
                Rule::in(app(BooksService::class)->books()),
            ],
        ];
    }
}
