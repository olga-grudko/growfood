<?php
/**
 * Created by PhpStorm.
 * User: olga
 * Date: 24.04.19
 * Time: 20:56
 */

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class ChangeTarifRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'tarif' => 'required|int|exists:tarifs,id',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'tarif.required'  =>  'Поле "Тариф" обязательно для заполнения',
            'tarif.integer'  =>  'Поле "Тариф" должно быть числом',
            'tarif.exists'  =>  'Указан не существующий тариф',
        ];
    }
}