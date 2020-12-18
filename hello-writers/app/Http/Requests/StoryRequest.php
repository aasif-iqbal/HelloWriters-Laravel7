<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoryRequest extends FormRequest
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
        $storyId = $this->route('story.id');
        return [
            'title' => [
                'required',
                'min:10',
                'max:70',
                function ($attribute, $value, $fail) {
                    if ($value == 'Dummy title') {
                        $fail($attribute . ' is invalid.');
                    }
                },
                Rule::unique('stories')->ignore($storyId)
            ],
            'body' => ['required', 'min:50'],
            'type' => 'required',
            'status' => 'required',
            //'tags.*' => ['required', 'min:1', 'max:2'],
            'tags' => 'required',
            'image' => 'sometimes|mimes:jpeg,bmp,png,jpg'
        ];
    }
    //body is in-valid if body contain is more then 200 words in Type:short.
    //if the type is short then it should be less then 200 words.
    public function withValidator($v)
    {
        $v->sometimes('body', 'max:600', function ($input) {
            return $input->type == 'short';
        });
    }
    /**
     * Get the validation error message.
     *
     * @return string
     */
    //custom error message
    public function messages()
    {
        return [
            'tags.required' => 'Please Select At least One  Tag',
            //for all fields
            'required' => 'Please Enter Value of the :attribute field.'
        ];
    }
}
