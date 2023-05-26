<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['success' => false, 'message' => $validator->errors()], 412));
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'min:8',
                'max:20',
                Rule::unique('users')->ignore($this->id),
            ],
            'email' => [
                'required',
                'min:12',
                'max:15',
                Rule::unique('users')->ignore($this->id),
            ],
            'password' => [
                'required',
                'min:6',
                'max:20',
                Rule::unique('users')->ignore($this->id),
            ],
<<<<<<< HEAD
=======
            'password' =>[
                'required',
                Rule::unique('users')->ignore($this->id),
            ] 
>>>>>>> d18784f38fb64a5bdb7d91abad45093ad23496ec

        ];
    }
}
