<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SkillTraceRequest extends FormRequest
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
            'trace_img' => 'image|mimes:jpeg,png,jpg,gif|max:1024|dimensions:max_width=300',
            'category' => 'required',
            'trace' => 'required'
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
            "trace_img.image" => "指定されたファイルが画像ではありません。",
            "trace_img.mimes" => "指定された拡張子（PNG/JPG/GIF）ではありません。",
            "trace_img.max" => "１Ｍを超えています。",
            "trace_img.dimensions" => "横幅は最大300pxです。",
            "category.required" => "カテゴリーを選択してください。",
            "trace.required" => "軌跡は必ず入力してください。"
        ];
    }
}
