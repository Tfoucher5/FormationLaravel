<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AbsenceRequest extends FormRequest
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
        $rules['user_id'] = 'required|exists:users,id';
        $rules['motif_id'] = 'required|exists:motifs,id';
        $rules['date_debut'] = 'required|date';
        $rules['date_fin'] = 'required|date|after_or_equal:date_debut';

        return $rules;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [];
    }
}
