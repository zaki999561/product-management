<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true;
    }

    /**
     * バリデーションルール
     */
    public function rules()
    {
        return [
            'product_id' => 'required|integer|exists:products,id',
            'quantity' => 'nullable|integer|min:1',
        ];
    }

    /**
     * カスタムメッセージ
     */
    public function messages()
    {
        return [
            'product_id.required' => '商品IDは必須です。',
            'product_id.exists' => '指定された商品は存在しません。',
            'quantity.required' => '数量は必須です。',
            'quantity.integer' => '数量は整数で指定してください。',
            'quantity.min' => '数量は1以上を指定してください。',
        ];
    }
}
