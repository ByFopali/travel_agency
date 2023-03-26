<?php

namespace App\Http\Requests\Tour;

use Illuminate\Foundation\Http\FormRequest;

class TourUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'nullable|string|max:255',
            'price' => 'nullable|integer|min:1',
            'description' => 'nullable|string',
            'image' => 'nullable|image',
            'place_id' => 'nullable|integer|min:1',
            'discount_id' => 'nullable|integer|min:1'
        ];
    }
}
