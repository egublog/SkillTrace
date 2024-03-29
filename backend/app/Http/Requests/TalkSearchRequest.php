<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * /Searchのリクエストクラス
 */
class TalkSearchRequest extends FormRequest
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
            'talk_search_name' => 'required'
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
            "talk_search_name.required" => "キーワードを入力してください。"
        ];
    }
}
