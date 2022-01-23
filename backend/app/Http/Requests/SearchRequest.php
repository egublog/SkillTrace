<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * /search.searchのリクエストクラス
 */
class SearchRequest extends FormRequest
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
            'age' => 'numeric|between:0,150|nullable'
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
            'age.numeric' => '年齢を整数で記入してください。',
            'age.between' => '年齢は0~150の間で入力してください。'
        ];
    }
}
