<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    public function rules()
    {
        return [
            'post.video' => 'required',
            'post.technique' => 'required|string|max:50',
            'post.tool_id' => 'required',
            'post.tool_number' => 'required',
            'post.text' => 'required|string|max:100'
        ];
    }
}
