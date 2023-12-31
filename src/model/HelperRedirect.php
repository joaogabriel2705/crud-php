<?php

namespace APP\Model;

class HelperRedirect {
    public static function redirectWithMessage($message, $session_name, string $view) : void 
    {
        session_start();
        $_SESSION[$session_name] = $message;
        header("location: $view");
        die();

    }

    public static function redirect(string $view) : void 
    {
        header("location: $view");
        die();
    }
}

?>