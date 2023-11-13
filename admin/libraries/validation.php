<?php

function is_fullname($fullname)
{
    $pattern = '/^[\p{L}\p{N}_\.\s]{8,}$/u';
    if (!preg_match($pattern, $fullname)) {
        return false;
    }
    return true;
}

function is_username($username)
{
    $pattern = "/^(?=.*[A-Za-z])[A-Za-z0-9_\.]{3,32}$/";
    if (!preg_match($pattern, $username, $matches)) {
        return false;
    }
    return true;
}

function is_password($password)
{
    $pattern = "/^[A-Za-z0-9_\.!@#$%^&*()]{6,40}$/";
    if (!preg_match($pattern, $password, $matches)) {
        return false;
    }
    return true;
}

function is_email($email)
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return false;
    }
    return true;
}

function is_numberPhone($phone_number)
{
    $pattern = "/^[0-9]{10}$/";
    if (!preg_match($pattern, $phone_number, $matches)) {
        return FALSE;
    }
    return TRUE;
}

function form_error($label_field)
{
    global $error;
    if (!empty($error[$label_field]))
        return "$error[$label_field]";
}


function set_value($label_filed)
{
    global $$label_filed;
    if (!empty($$label_filed)) return $$label_filed;
}
