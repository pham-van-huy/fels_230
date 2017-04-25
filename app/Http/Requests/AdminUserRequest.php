<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->method()) {
            case 'PUT':
            case 'PATCH':
                return [
                    'name' => 'required|max:255',
                    'email' => 'required|email|max:255|unique:users,email,' . $this->request->get('userId'),
                    'password' => 'min:6|confirmed',
                    'avatar' => 'image|size:500',
                ];
            case 'POST':
                return [
                    'name' => 'required|max:255',
                    'email' => 'required|email|max:255|unique:users,email',
                    'password' => 'min:6|confirmed',
                    'avatar' => 'image|size:1',
                ];
        }
    }
}
