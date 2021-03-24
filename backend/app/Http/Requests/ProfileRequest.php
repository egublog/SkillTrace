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
            'name' => 'required',
            'age' => 'required|numeric|between:0,150'
        ];
    }

    public function messages() {
        return [
            'name.required' => '名前は必ず入力してください。',
            'age.required' => '年齢は必ず入力してください。',
            'age.numeric' => '年齢を整数で記入してください。',
            'age.between' => '年齢は0~150の間で入力してください。'
        ];
    }
}
