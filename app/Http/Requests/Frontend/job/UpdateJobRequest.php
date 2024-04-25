<?php

namespace App\Http\Requests\Frontend\job;

use Illuminate\Foundation\Http\FormRequest;

class UpdateJobRequest extends FormRequest
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
        return [

            'job_name' => ['required', 'max:60', 'string'],
            'job_category_id' => ['required'],
            'job_type_id' => ['required'],
            'vacancy' => ['required', 'integer'],
            'salary' => ['nullable'],
            'location' => ['required'],
            'description' => ['nullable'],
            'benefit' => ['nullable'],
            'responsibility' => ['nullable'],
            'qualification' => ['nullable'],
            'experience_id' => ['required'],
            'keyword' => ['nullable'],
            'company_name' => ['required', 'max:60', 'string'],
            'company_location' => ['required'],
            'company_website' => ['nullable'],
            'status' => ['nullable'],

        ];
    }
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $this->merge(['user_id' => auth()->id()]);
        });
    }
}

