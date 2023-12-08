<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest;

class StoreProjetRequest extends FormRequest
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


     public function rules()
     {
         return [
             "titre" => ['required', 'regex:/^[a-zA-Z0-9\s]{3,}$/'],
             "description" => ['required', 'regex:/^[a-zA-Z0-9\s]{3,}$/'],
             "statut" => ['required'],
             "image" => ['required', 'image'],
             "categorie_id" => ['required'],
             // ... autres règles
         ];
     }
     
     public function messages()
     {
         return [
             "titre.required" => 'Le titre est requis',
             "titre.regex" => 'Le titre doit être composé de lettres, de chiffres et d\'espaces (au moins 3 caractères)',
             "description.required" => 'La description est requise',
             "description.regex" => 'La description doit être composée de lettres, de chiffres et d\'espaces (au moins 3 caractères)',
             "statut.required" => 'Le statut est requis',
             "image.required" => 'L\'image est requise',
             "categorie_id.required" => 'La catégorie est requise',
             
         ];
     }
     
     protected function failedValidation(Validator $validator)
     {
         $errors = $validator->errors();
     
         throw new HttpResponseException(response()->json([
             'errors' => $errors,
         ], 422));
     }
     



    // public function rules()
    // {

    //     return [
    //         "titre" => ['required', 'regex:/^[a-zA-Z0-9\s]{3,}$/'],
    //         "description" => ['required', 'regex:/^[a-zA-Z0-9\s]{3,}$/'],
    //         "statut" => ['required'],
    //         "image" => ['required', 'image'],
    //         "categorie_id" => ['required'],
           
    //     ];
    // }


    // protected function failedValidation(Validator $validator)
    // {
    //     $errors = $validator->errors();

    //     throw new HttpResponseException(response()->json([

    //         'errors' => $errors,
    //     ], 422));
    // }
    // public function message()

    // {
    //     return response()->json( [
    //         "titre.required"=>'le titre est requis',
    //         "titre.min"=>'le titre doit au minimum avoir 8 caractères',
    //         "description.required"=>'la description est requise',
    //         "description.min"=>'la description doit au minimum avoir 8 caractères',

    //         "statut.required"=>'le statut est requis',
    //         "image.required" =>'l\'image est requis',
    //         "is_deleted"=>['required','Boolean'],
    //         "categorie_id" =>['array', 'exists:categories,id', 'required'],
    //         "porteurprojet_id"=>['array', 'exists:porteurprojets,id', 'required'],
    //     ]);
    // }
}
