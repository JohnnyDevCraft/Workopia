<?php

namespace Framework;

class Validation
{
    /**
     * Validates a string
     *
     * @param $value
     * @param int $min
     * @param int $max
     * @return bool
     */
    public static function String($value, int $min = 1, int $max = 5000)
    {
        if(is_string($value)){
            $value = trim($value);
            $length = strlen($value);

            return $length >= $min && $length <= $max;
        }
        return false;
    }


    /**
     *  Validate email address
     *
     * @param string $value
     * @return mixed
     */
    public static function Email(string $value) {
        $value = trim($value);

        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }

    /**
     * Match a value against another
     *
     * @param string $value1
     * @param string $value2
     * @param bool $ignoreCase
     * @return bool
     */
    public static function Match(string $value1, string $value2, bool $ignoreCase = false) {
        $value1 = trim($value1);
        $value2 = trim($value2);

        return $ignoreCase ? strtolower($value2) === strtolower($value1) : $value1 === $value2;
    }
}