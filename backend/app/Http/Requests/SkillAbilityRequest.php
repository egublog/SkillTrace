<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SkillAbilityRequest extends FormRequest
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
            'ability' => 'required',
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
            "ability.required" => "できることは必ず入力してください。"
        ];
    }
}
