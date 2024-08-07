<?php


//Hàm kiểm tra login
function is_login() {
    if (isset($_SESSION['is_login'])) {
        return TRUE;
    }
    return false;
}

//Trả về username của người login
function user_login() {
    if (!empty($_SESSION['username'])) {
        return $_SESSION['username'];
    }
    return false;
}

