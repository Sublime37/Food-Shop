<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use Override;

class RegisterRequest extends FormRequest
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
            "name" => ["required", "string", "min:5", "max:20"],
            "email" => ["required", "email", "unique:users,email"],
            "password" => ["required", "confirmed",
                Password::min(8)
                ->letters()
                ->numbers()
                ->symbols()
                ->uncompromised()],
        ];
    }

    #[Override]
    protected function prepareForValidation(): void
    {
        if (is_string($this->email)) {
            $this->merge([
                'name' => trim($this->name),
                'email' => mb_strtolower(trim($this->email))
            ]);
        }
    }

    #[Override]
    public function messages(): array
    {
        return [
            "name.required" => "Не указано имя пользователя.",
            "name.string" => "Имя пользователя должна быть строкой.",
            "name.min" => "Имя пользователя должно быть в диапазоне от 5 до 20 символов.",
            "name.max" => "Имя пользователя должно быть в диапазоне от 5 до 20 символов.",
            "email.required" => "Необходимо указать почту.",
            "email.email" => "Недопустимый формат почты.",
            "email.unique" => "Пользователь с такой почтой уже существует.",
            "password.required" => "Не указан пароль.",
            "password.confirmed" => "Пароли не совпадают.",
            "password.min" => "Минимальный размер пароля 8 символов.",
            "password.letters" => "В пароле должны быть буквы.",
            "password.numbers" => "В пароле должны быть цифры.",
            "password.symbols" => "В пароле должны быть символы.",
            "password.uncompromised" => "Этот пароль найден в базах утечек. Придумайте другой."
        ];
    }
}
