<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SkillStarRequest extends FormRequest
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
            'star_count' => 'required'
        ];
    }

            /**
     * エラー文
     *
     * @return array
     */
    public function messages()
    {
        return [
            'star_count.required' => '自己評価を選択してください。'
        ];
    }
}
