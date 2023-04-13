<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'surname' => 'required|string',
            'name' => 'required|string',
            'patronymic' => 'required|string',
            'campaign' => 'nullable|string',
            'phone' => 'required|string',
            'email' => 'required|email:rfc,dns',
            'date_of_birth' => 'nullable|string',
            'image' => 'nullable|file',
        ];
    }
}
