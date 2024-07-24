<?php

namespace App\Http\Requests\Author;

use Illuminate\Foundation\Http\FormRequest;

class AuthorRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'name' => ['required', 'string'],
            'biography' => ['required', 'string'],
        ];

        if ($this->method() == 'POST') {
            array_push($rules['name'], 'unique:authors,name');
        } else {
            $authorId = $this->route('author');
            array_push($rules['name'], 'unique:authors,name,' . $authorId);
        }

        return $rules;
    }
}
