<?php

namespace App\Http\Requests;

use App\Enums\UserRole;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;

class CourseRequest extends FormRequest
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
        $user = Auth::user();

        return [
            'craftman_id' => [Rule::requiredIf(fn () => $user->role == UserRole::Admin), 'string', 'nullable'],
            'skills' => ['exclude_unless:type,project', 'array'],
            'title' => ['string', 'min:3', 'max:255', 'required'],
            'description' => ['string', 'max:255', 'required'],
            'craftsmanship_id' => ['string', 'required'],
            'materials' => ['array', 'required'],
            'cost' => ['integer', 'nullable'],
            'difficulty' => ['integer', 'required'],
            'video' => ['file', 'required', File::types(['mp4', 'wav'])],
            'is_draft' => ['boolean', 'required'],
        ];
    }
}
