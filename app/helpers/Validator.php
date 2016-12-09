<?php

class Validator {

    private static $errors = [];

    public static function validate($rules) {
        foreach ($rules as $key => $rule) {

            $vRules = explode('|', $rule[1]); // array ['isempty','isemail']

            foreach ($vRules as $vRule) {
                $errorMessage = self::{$vRule}($key, $rule[0]);
                self::pushError($errorMessage);
            }
        }

        return self::$errors;
    }

    private static function pushError($errorMessage) {
        (!empty($errorMessage)) ? array_push(self::$errors, $errorMessage) : null;
    }

    private static function isempty($key, $input) {
        $isempty = empty($input); // 1 if empty
        if ($isempty)
            return "$key is required";
    }

    private static function isemail($key, $input) {
        $isemail = filter_var($input, FILTER_VALIDATE_EMAIL);
        if (!$isemail)
            return "$key not valid email";
    }

    private static function isdigit($key, $input) {
        $isdigit = filter_var($input, FILTER_VALIDATE_INT);
        if (!$isdigit)
            return "$key not valid number";
    }

    private static function isurl($key, $input) {
        $isurl = filter_var($input, FILTER_VALIDATE_URL);
        if (!$isurl)
            return "$key not valid url";
    }

}
