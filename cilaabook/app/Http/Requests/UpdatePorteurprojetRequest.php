<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdatePorteurprojetRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nom' => ['required', 'min:5', 'regex:/^[a-zA-Z\s]+$/'],
            'email' => ['required', 'email', 'unique:porteurprojets,email'],
            'password' => ['required','min:8'],
            'adresse' => ['required','regex:/^[a-zA-Z\s]+$/'],
            'image' => ['required','image','mimes:jpeg,png,jpg,gif'],
            'telephone' => ['required','regex:/^(70|75|76|77|78)[0-9]{7}$/'],
            'statut' => ['required','in:personne,entreprise'],
        ];
    }
    public function messages(): array
    {
        return [
            'nom.required'=> 'Le champs nom est obligatoire',
            'email.required'=> 'Le champs email est obligatoire',
            'adresse.required'=> 'Le champs adresse est obligatoire',
            'telephone.required'=> 'Le champs telephone est obligatoire et doit commencer par 78 ou 77 ou 76 ou 70',
            'password.required'=> 'Le champs mot de passe est obligatoire et doit contenir minimum 8 caracteres',
            'statut.required'=> 'Veillez selectionnez un type de bailleur',

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
}
