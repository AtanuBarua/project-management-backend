<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
            'title' => 'required',
            'description' => 'required',
            'code' => 'required|unique:projects|max:6',
            'type' => 'required|integer',
            'client_id' => 'sometimes|integer|gt:0',
            'total_rate' => 'sometimes|numeric|min:0',
            'lead_by' => 'required|integer|gt:0',
            'start_date' => 'sometimes|date',
            'end_date' => 'sometimes|date',
            'created_by' => 'required|integer|gt:0',
            'status' => 'required|integer',
        ];
    }
}
