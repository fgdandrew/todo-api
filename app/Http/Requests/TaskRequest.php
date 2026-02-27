<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
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
        $rules = [
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
        ];

        // Правило для status при создании или если status передан
        if ($this->isMethod('post') || $this->has('status')) {
            $rules['status'] = 'in:pending,in_progress,completed';
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Название задачи обязательно для заполнения',
            'title.max'      => 'Название не может быть длиннее 255 символов',
            'status.in'      => 'Статус должен быть одним из: pending, in_progress, completed',
        ];
    }

}
