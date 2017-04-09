<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class WordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        switch ($this->method()) {
            case 'PUT':
            case 'PATCH':
            case 'POST':
                return [
                    'content' => 'required|max:255',
                    'category' => 'required|not_in:default',
                    'answer.*.content' => 'required|max:255',
                ];
        }
    }
}
