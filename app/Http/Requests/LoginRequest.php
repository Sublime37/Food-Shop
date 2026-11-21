<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Override;

class LoginRequest extends FormRequest
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
            "email" => ["required", "email", "max:255", "string"],
            "password" => ["required", "max:100", "string"],
         ];
    }

    #[Override]
    protected function prepareForValidation(): void
    {
        if (is_string($this->email)) {
            $this->merge([
                'email' => mb_strtolower(trim($this->email))
            ]);
        }
    }

    #[Override]
    public function messages(): array
    {
        return [
            "email.required" => "Необходимо указать почту.",
            "email.string" => "Почта должна быть строкой.",
            "email.email" => "Недопустимый формат почты.",
            "email.max" => "Размер почты выходит за пределы диапазона.",
            "password.required" => "Необходимо указать пароль.",
            "password.max" => "Размер пароля выходит за пределы диапазона.",
            "password.string" => "Пароль должен быть строкой."
        ];
    }
}
