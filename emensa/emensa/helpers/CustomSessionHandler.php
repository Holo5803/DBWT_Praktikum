<?php


class CustomSessionHandler extends SessionHandler
{
    public function incrementSessionCount($key)
    {
        if (!isset($_SESSION[$key])) {
            $_SESSION[$key] = 0;
        }
        $_SESSION[$key]++;
    }

    public function getSessionValue($key, $default = null)
    {
        return $_SESSION[$key] ?? $default;
    }
}

