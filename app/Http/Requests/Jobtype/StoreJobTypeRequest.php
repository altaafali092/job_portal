<?php

namespace App\Http\Requests\Jobtype;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreJobTypeRequest extends FormRequest
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
            'name'=> ['required','max:50','string'],
            'slug'=> ['required','alpha_dash',Rule::unique('job_Types','slug')],
            'status'=>['nullable'],
        ];
    }
}
