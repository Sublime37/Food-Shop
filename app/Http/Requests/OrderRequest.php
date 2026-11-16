<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Override;

class OrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "id_products" => ["required", "array", "max:10", "min:1"],
            "id_products.*" => ["required", "integer"],
            "address" => ["required", "string"],
            "promocode" => ["string", "min:1", "max:20"]
        ];
    }

    #[Override]
    public function messages()
    {
        return [
            "id_products.required" => "Продуктов нету в корзине",
            "id_products.array" => "Передан не массив",
            "id_products.max" => "Корзина переполнена",
            "id_products.min" => "Добавьте хотя бы один товар",
            "address.required" => "Укажите адрес доставки",
            "address.string" => "Адрес не является строкой",
            "promocode.string" => "Промокод не является строкой",
            "promocode.min" => "нету такого промокода",
            "promocode.max" => "нету такого промокода"
        ];
    }
}
