<?php

namespace App\Http\Requests\Frontend\JobAplication;

use Illuminate\Foundation\Http\FormRequest;

class StoreJobApplicationRequest extends FormRequest
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
            // 'job_id'=>['required'],
            // 'user_id'=>['required'],
            // 'employer_id'=>['required'],
            // 'applied_date'=>['required'],
        ];
    }   
    
}
