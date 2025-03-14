<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'product_name' => 'required|max:20',
            'company_id' => 'required|string',
            'price' => 'required|integer|min:0',
            'stock' => 'required|integer|min:0',
        ];
    }

    public function messages()
    {
        return [
            'product_name.required' => '必須項目です',
            'company_id.required' => '必須項目です',
            'price.required' => '必須項目です',
            'stock.required' => '必須項目です',
            'price.min' => '価格は負の数値ではなく、整数で入力してください',
            'stock.min' => '在庫数は負の数値ではなく、整数で入力してください',
        ];
    }

    
}
