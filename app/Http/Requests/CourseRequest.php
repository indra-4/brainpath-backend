<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CourseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title'           => ['required', 'string', 'max:255'],
            'external_url'    => ['nullable', 'url', 'max:255'],
            'description'     => ['nullable', 'string'],
            'category'        => ['required', 'string', 'max:255'],
            'level'           => ['nullable', 'string', 'max:255'],
            'duration_text'   => ['nullable', 'string', 'max:255'],
            'tags'            => ['nullable', 'array'],
            'summary'         => ['nullable', 'string'],
            'learning_points' => ['nullable', 'array'],
        ];
    }

    protected function failedValidation(Validator $validator): never
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'data'    => $validator->errors(),
            'message' => 'Validation failed.',
        ], 422));
    }
}
