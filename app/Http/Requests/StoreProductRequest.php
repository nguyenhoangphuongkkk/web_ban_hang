<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'product_name' => 'required',
            'description'=>'required',
            'price'=>'required',
            'image'=>'required',
            'category_id'=>'required',
            'stock_quantity'=>'required',
        ];
    }

    public function messages() {
        return [
         'product_name.required' => 'Nhập name product',
         'description.required' => 'Nhập mô tả',
         'price.required' => 'Nhập giá',
         'stock_quantity.required' => 'Nhập số lượng sản phẩm',
         'image.required' => 'Nhập hình ảnh',
       ];
     }
}
