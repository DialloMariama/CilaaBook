<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreBailleurRequest extends FormRequest
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
            'nom' => 'required',
            'email' => 'required|email|unique:bailleurs,email',
            'password' => 'required',
            'adresse' => 'required',
            'telephone' => 'required',
            'statut' => 'required|in:personne,entreprise',

        ];
    }
    public function failedValidation(validator $validator ){
        throw new HttpResponseException(response()->json([
            'success'=>false,
            'status_code'=>422,
            'error'=>true,
            'message'=>'erreur de validation',
            'errorList'=>$validator->errors()
        ]));
    }
    public function messages(): array
    {
        return [
            'nom.required'=> 'Le champs nom est obligatoire',
            'email.required'=> 'Le champs email est obligatoire',
            'adresse.required'=> 'Le champs adresse est obligatoire',
            'telephone.required'=> 'Le champs telephone est obligatoire',
            'password.required'=> 'Le champs mot de passe est obligatoire',
            'statut.required'=> 'Veillez selectionnez un type de bailleur',

        ];
    }
}
