<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class AuthRequest extends FormRequest
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
    public function rules(Request $request)
    {
        $route_name = $request->route()->getName();
        switch ($route_name) {
            case ('client.login'):
                return [
                    'email' => 'required|email',
                    'password' => 'required|string|min:6',
                ];
                break;
        }
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'messages' => 'in_valid input',
            'errors' => $validator->errors(),
            'status' => false
        ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
    }
}
