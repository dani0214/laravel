<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class TLF implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return ($this->isValidTLF($value));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Debe ser un Telefono valido';
    }

    /**
     * Checks if  is valid.
     * 
     * @return bool
     */
    public function isValidTLF($tlf)
    {
        $tlfRegEx = '%^(?:(?:\(?(?:00|\+)([1-4]\d\d|[1-9]\d?)\)?)?[\-\.\ \\\/]?)?((?:\(?\d{1,}\)?[\-\.\ \\\/]?){0,})(?:[\-\.\ \\\/]?(?:#|ext\.?|extension|x)[\-\.\ \\\/]?(\d+))?$%i';

        if (preg_match($tlfRegEx, $tlf)) {
            return true;
        }

        return false;
    }
}
