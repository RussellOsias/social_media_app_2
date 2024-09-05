<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        // Ensure that the user making the request is authorized to update the profile
        // This can be customized based on your application's authorization logic
        return true; // Assuming that all authenticated users can update their profiles
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'], // Name is required and should be a string with max length of 255 characters
            'email' => ['required', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)], // Email is required, should be a valid email, unique excluding the current user
        ];
    }
}
