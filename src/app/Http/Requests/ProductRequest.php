<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProductRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'seasons' => 'required|array|min:1',
            'seasons.*' => 'exists:seasons,id',
            'description' => 'required|string|     max:120',
            'image' => [
                'nullable', 
                'image',
                'mimes:png,jpeg',
                'max:2048',
            ],
        ];
    }

    public function imageRules() 
    {
        return 'required|image|mimes:jpeg,png,jpg,gif|max:2048';
    }

    public function messages()
        {
            return [
            'name.required' => '商品名を入力してください。',
            'price.required' => '価格を入力してください。',
            'price.integer' => '価格は整数で入力してください。',
            'price.min' => '価格は0以上の値を入力してください。',
            'description.required' => '商品説明を入力してください。',
            'seasons.required' => '季節を1つ以上選択してください。', 
            'seasons.min' => '季節を1つ以上選択してください。', 
            'seasons.*.exists' => '選択された季節は存在しません。',
            'image.required' => '画像を選択してください。',
            'image.image' => '画像ファイルを選択してください。',
            'image.mimes' => '画像ファイルはjpeg, png, jpg, gifのいずれかの形式で選択してください。',
            'image.max' => '画像ファイルのサイズは2MB以下にしてください。',
        
        ];
    }

         public function attributes()
        {
            return [
                'name' => '商品名',
                'price' => '価格',
                'description' => '商品説明',
                'seasons' => '季節',
                'image' => '商品画像',
        ];
    }
}
