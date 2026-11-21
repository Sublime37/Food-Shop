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
            "products" => ["required", "array", "max:10", "min:1"],
            "products.*.id" => ["required", "integer", "exists:products,id", "distinct"],
            "products.*.qty" => ["required", "integer", "min:1", "max:100"],
            "address" => ["required", "string", "max:255"],
            "promocode" => ["nullable", "string", "min:1", "max:20"]
        ];
    }

    #[Override]
    public function messages()
    {
        return [
            "products.required" => "Продуктов нету в корзине.",
            "products.array" => "Передан не массив.",
            "products.max" => "Корзина переполнена.",
            "products.min" => "Добавьте хотя бы один товар.",
            "products.*.id.required" => "Недопустимое значение.",
            "products.*.id.integer" => "Поле продукта не является строкой.",
            "products.*.id.exists" => "Нет такого продукта.",
            "products.*.id.distinct" => "Дубликат продукта.",
            "products.*.qty.required" => "Не указно количество.",
            "products.*.qty.min" => "Недопустимый диапазон.",
            "products.*.qty.max" => "Недопустимый диапазон.",
            "address.required" => "Укажите адрес доставки.",
            "address.string" => "Адрес не является строкой.",
            "promocode.string" => "Промокод не является строкой.",
            "promocode.min" => "Нет такого промокода.",
            "promocode.max" => "Нет такого промокода."
        ];
    }
}
