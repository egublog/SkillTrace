<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileImageRequest extends FormRequest
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
            //プロフィール画像
            'profile_img' => 'image|mimes:jpeg,png,jpg,gif|max:1024|dimensions:max_width=300',
        ];
    }

    public function messages()
    {
        return [
            "profile_img.image" => "指定されたファイルが画像ではありません。",
            "profile_img.mimes" => "指定された拡張子（PNG/JPG/GIF）ではありません。",
            "profile_img.max" => "１Ｍを超えています。",
            "profile_img.dimensions" => "横幅は最大300pxです。",
        ];
    }
}
