<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FractionRequest extends FormRequest
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
            'month' => 'required|max:3',
            'profile' => 'required|max:1',
            'fraction' => 'required|numeric|max:3'
        ];
    }
}
