<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * /profiles.storeのリクエストクラス
 */
class ProfileStoreRequest extends FormRequest
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
            'name' => 'required|string',
            'age' => 'required|numeric|between:0,150',
            'area_id' => 'required|integer',
            'history_id' => 'required|integer',
            'language_id' => 'required|integer',
        ];
    }

    /**
     * エラー文
     *
     * @return array
     */

    public function messages() {
        return [
            'name.required' => '名前は必ず入力してください。',
            'age.required' => '年齢は必ず入力してください。',
            'age.numeric' => '年齢を整数で記入してください。',
            'age.between' => '年齢は0~150の間で入力してください。',
            'area_id.required' => '住んでいる地域は必ず入力してください。',
            'history_id.required' => 'エンジニア歴は必ず入力してください。',
            'language_id.required' => '得意言語は必ず入力してください。'
        ];
    }

    /**
     * 5つに限定
     *
     * @return \Illuminate\Database\Query\Builder
     */

    public function userAttributes() {
        return $this->only([
            'name', 'age', 'area_id', 'history_id', 'language_id'
        ]);
    }
}
