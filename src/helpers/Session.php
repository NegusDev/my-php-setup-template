<?php

declare(strict_types=1);

namespace helpers;

class Session
{
    public static function logout()
    {
        if (isset($_POST['session_id'])) {
            unset($_SESSION['admin_id']);
            unset($_SESSION['username']);
            unset($_SESSION['unique_id']);
            unset($_SESSION['role_id']);

            header("location:/");
            exit();
        }
    }

    public static function isLoggedIn($session_id)
    {
        if (isset($_SESSION[$session_id])) {
            return true;
        }
        header("location:/");
        exit();
    }


    public function setCookie()
    {}
}
