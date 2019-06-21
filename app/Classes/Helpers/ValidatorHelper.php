<?php namespace App\Classes\Helpers;


use Illuminate\Validation\Validator;

class ValidatorHelper
{

    /**
     * Gets error messages from validator and concatenates them to string with given separator.
     *
     * @param $validator
     * @param string $separator
     * @return string
     */
    public static function toString($validator, $separator=' ')
    {
        return implode($separator, $validator->errors()->all());
    }

    /**
     * Gets error messages from validator as array.
     *
     * @param $validator
     * @return array
     */
    public static function toArray(Validator $validator)
    {
        return $validator->errors()->all();
    }
}