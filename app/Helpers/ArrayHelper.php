<?php
/**
 * Created by PhpStorm.
 * User: olga
 * Date: 24.04.19
 * Time: 21:55
 */

namespace App\Helpers;


class ArrayHelper
{
    /**
     * Возвращает первый ключ в массиве
     * @param array $array
     * @return mixed
     */
    public static function getFirstKeyFromArray(array $array)
    {
        list($id, $name) = each($array);
        return $id;
    }

    /**
     *  Вjзвращает форматированный массив вида id=>name
     * @param array $array
     * @return array|null
     */
    public static function getFormattedArrayForDropdown(array $array)
    {
        if(empty($array['id']) || empty($array['name'])) {
            return null;
        }
        $ids = array_column($array, 'id');
        $names = array_column($array, 'name');
        return array_combine($ids, $names);
    }
}