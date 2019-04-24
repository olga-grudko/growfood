<?php
/**
 * Created by PhpStorm.
 * User: olga
 * Date: 24.04.19
 * Time: 17:15
 */

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'phone' => 'required|regex:/[0-9]{9}/|max:9',
            'tarif' => 'required|int|exists:tarifs,id',
            'delivery_day' => 'required|int|exists:delivery_days,day',
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
            'name.required' => 'Поле "Имя" обязательно для заполнения',
            'name.string' => 'Поле "Имя" должно быть строкой',
            'name.max' => 'Поле "Имя" должно быть не больше 255 символов',

            'phone.required'  =>  'Поле "Телефон" обязательно для заполнения',
            'phone.unique' => 'Такой номер телефона уже зарегистрирован',
            'phone.regex' => 'Не верный формат номера телефона',
            'phone.max' => 'Неверный номер телефона',

            'tarif.required'  =>  'Поле "Тариф" обязательно для заполнения',
            'tarif.integer'  =>  'Поле "Тариф" должно быть числом',
            'tarif.exists'  =>  'Указан не существующий тариф',


            'delivery_day.required'  =>  'Поле "День доставки" обязательно для заполнения',
            'delivery_day.integer'  =>  'Поле "День" должно быть числом',
            'delivery_day.exists'  =>  'Указан не верный день',

        ];
    }
}