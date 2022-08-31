<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
    public function rules(Request $request)
    {
        $rules = [
            'name' => 'required|array',
            'name.en' => 'required|string|max:255',
            'name.*' => 'max:255',
        ];

        $rules['email'] = $request->isMethod('patch') ? 'required|email|unique:users,email,' . auth()->id() : 'required|email|unique:users,email';
        $rules['password'] = $request->isMethod('patch') ? 'nullable|min:8|confirmed' : 'required|min:8|confirmed';

        return $rules;
    }

    public function attributes()
    {
        return [
            "name.en" => __('app.English Name'),
            "name.ar" => __('app.Arabic Name'),
        ];
    }
}