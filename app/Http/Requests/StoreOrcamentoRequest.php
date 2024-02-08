<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrcamentoRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id_cliente' => ['bail', 'required', 'integer'],
            'id_vendedor' => ['bail', 'required', 'integer'],

            'data' => ['required', 'string', 'date'],
            'hora' => ['required', 'string', 'time'],

            'descricao' => ['required', 'string', 'min:3'],
            'valor' => ['required', 'decimal:2'],
        ];
    }
}
