<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            // 'profile_image' => 'required',
            'name' => 'required|min:5|max:25',
            'biography' => 'required|min:50|max:255',
            'address' => 'required|min:10|max:255'
        ];
    }
}
