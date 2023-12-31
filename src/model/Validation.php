<?php

namespace APP\Model;

class Validation
{
    public static function isValidName(string $name): bool
    {
        return preg_match("/^[\p{L}]+(?:['\s][\p{L}]+)*$/u", $name);
    }

    public static function isValidEmail(string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public static function isValidPassword(string $password): bool
    {
        return strlen($password) > 7;
    }
}
?>