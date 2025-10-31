<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreKapcsolatRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Bárki küldhet üzenetet
    }

    public function rules(): array
    {
        // Itt vannak a szerver oldali szabályok 
        return [
            'nev' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'uzenet' => 'required|string|min:5', // Legyen legalább 5 karakter
        ];
    }
}
