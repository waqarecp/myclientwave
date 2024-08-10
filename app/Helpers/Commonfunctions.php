<?php

namespace App\Helpers;

class Commonfunctions
{
    /**
     * Check if a value is null or empty.
     *
     * @param mixed $value
     * @return bool
     */
    public static function isNullOrEmpty($value)
    {
        return $value === null || !isset($value) || trim($value) === '';
    }
}
