<?php

namespace App\Http\Requests\Locations;

use Illuminate\Foundation\Http\FormRequest;

class IndexLocationsRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'page' => 'sometimes|nullable|integer',
            'search' => 'sometimes|nullable|string|max:255',
            'datetime' => 'sometimes|nullable|date',
            'warehouses' => 'sometimes|nullable|array',
            'warehouses.*' => 'sometimes|integer',
        ];
    }
}
