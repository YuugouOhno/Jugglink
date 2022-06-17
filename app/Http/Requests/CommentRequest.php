<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
{
    public function rules()
    {
        return [
            'post.text' => 'required|string|max:100'
        ];
    }
}
