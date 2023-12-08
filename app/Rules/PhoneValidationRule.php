<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PhoneValidationRule implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // Example: Validate that the phone number contains only digits
        return preg_match('/^\d+$/', $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The phone number is not valid.';
    }
}
