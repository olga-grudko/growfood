<?php
/**
 * Created by PhpStorm.
 * User: olga
 * Date: 24.04.19
 * Time: 21:32
 */

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class ChangeDeliveryDay extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
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
            'delivery_day.required'  =>  'Поле "День доставки" обязательно для заполнения',
            'delivery_day.integer'  =>  'Поле "День" должно быть числом',
            'delivery_day.exists'  =>  'Указан не верный день',
        ];
    }
}