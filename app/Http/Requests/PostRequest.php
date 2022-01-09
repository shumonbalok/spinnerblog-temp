<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
        return [
            'title' => 'required|max:100|min:5',
            'dscp' => 'required|max:400|min:40',
            'status' => 'required|boolean',
            // 'image' => 'required|mimes:jpg,png|max:2048',
            'image' => [request()->isMethod('post') ? 'required' : '', 'mimes:jpg,png', 'max:2048'],
        ];
    }
}
