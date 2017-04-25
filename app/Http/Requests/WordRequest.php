<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WordRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        switch ($this->method()) {
            case 'PUT':
            case 'PATCH':
            case 'POST':
                return [
                    'word' => 'required|min:3|unique:words,word',
                    'category_id' => 'required|not_in:default',
                    'ans.*.answer' => 'required|max:100',
                ];
        }
    }
}
