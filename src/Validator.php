<?php

namespace Dois\Validation;

use Illuminate\Validation\Validator as IlluminateValidator;

class Validator extends IlluminateValidator
{

    /**
     * Valida se o CPF é válido
     *
     * @param [string] $attribute
     * @param [string] $value
     * @return boolean
     */
    protected function validateCpf($attribute, $value)
    {

        if (strlen($value) != 11 || preg_match("/^{$value[0]}{11}$/", $value)) {
            return false;
        }
        for ($s = 10, $n = 0, $i = 0; $s >= 2; $n += $value[$i++] * $s--);
        if ($value[9] != ((($n %= 11) < 2) ? 0 : 11 - $n)) {
            return false;
        }
        for ($s = 11, $n = 0, $i = 0; $s >= 2; $n += $value[$i++] * $s--);
        if ($value[10] != ((($n %= 11) < 2) ? 0 : 11 - $n)) {
            return false;
        }
        return true;
    }

    /**
     * Valida se o CNPJ é válido
     * @param string $attribute
     * @param string $value
     * @return boolean
     */
    protected function validateCnpj($attribute, $value)
    {


        $b = [6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];

        if (strlen($value) != 14) {
            return false;
        } elseif (preg_match("/^{$value[0]}{14}$/", $value) > 0) {

            return false;
        }

        for ($i = 0, $n = 0; $i < 12; $n += $value[$i] * $b[++$i]);

        if ($value[12] != ((($n %= 11) < 2) ? 0 : 11 - $n)) {
            return false;
        }

        for ($i = 0, $n = 0; $i <= 12; $n += $value[$i] * $b[$i++]);

        if ($value[13] != ((($n %= 11) < 2) ? 0 : 11 - $n)) {
            return false;
        }

        return true;
    }

    /**
     * Undocumented function
     *
     * @param [type] $attribute
     * @param [type] $value
     * @return bool
     */
    protected function validateCpfCnpj($attribute, $value)
    {
        if (strlen($value) == 11) {
            return $this->validateCpf($attribute, $value);
        }
        if (strlen($value) == 14) {
            return $this->validateCnpj($attribute, $value);
        }

        return true;
    }


    protected function validatePassword($attribute, $value)
    {
        if (preg_match(
            "/^(?=.*?[A-Z])(?=.*?[0-9])[a-zA-Z0-9!\"#\$%&'\(\)\*\+,-\.\/:;<=>\?@[\]\^_`\{\|}~]{8,}$/", $value) > 0) {
            return false;
        }

        return true;
    }

     /**
    * Valida o formato do celular junto com o ddd
    * @param string $attribute
    * @param string $value
    * @return boolean
    */
    protected function validateMobile($attribute, $value)
    {
        return preg_match('/^\d{2}\d{5}\d{4}$/', $value) > 0;
    }
}
