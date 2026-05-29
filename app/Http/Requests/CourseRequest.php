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
        return true;
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

    protected function prepareForValidation(): void
    {
        if ($this->has('tags')) {
            $this->merge([
                'tags' => $this->normalizeArrayInput($this->tags),
            ]);
        }

        if ($this->has('learning_points')) {
            $this->merge([
                'learning_points' => $this->normalizeArrayInput($this->learning_points),
            ]);
        }
    }

    private function normalizeArrayInput($value): ?array
    {
        if (is_array($value)) {
            return $value;
        }

        if (is_string($value) && $value !== '') {
            $decoded = json_decode($value, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                return $decoded;
            }
            // Fallback: split by comma or newline if it's a plain string
            return array_filter(array_map('trim', preg_split('/[\n,]+/', $value)));
        }

        return is_array($value) ? $value : null;
    }

    protected function failedValidation(Validator $validator): never
    {
        $payload = $this->all();
        \Illuminate\Support\Facades\Log::info('Validation failed payload: ' . json_encode([
            'errors' => $validator->errors(),
            'payload' => $payload,
            'learning_points_type' => gettype($payload['learning_points'] ?? null)
        ]));
        
        throw new HttpResponseException(response()->json([
            'success' => false,
            'data'    => $validator->errors(),
            'message' => 'Validation failed.',
        ], 422));
    }
}
