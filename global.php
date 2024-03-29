<?php
/** Global functions that are likely to be used across the 'framework', if we can call it that way :) */

function has_message(string $key) : bool
{
    if(isset($_SESSION[$key]))
        return true;
    else
        return false;
}

function session_message() : string
{
    $msg = "";

    if(isset($_SESSION['message']))
    {
        $msg = $_SESSION['message'];
    }

    return $msg;
}

function redirect(string $url, string $message = "") : void
{
    if(strlen($message) >= 1)
        $_SESSION['message'] = $message;

    header("Location: " . $url);

}

function currentUrl() : string
{
    return strtok($_SERVER['REQUEST_URI'], '?');
}

function reset_session_message()
{
    unset($_SESSION['message']);
}