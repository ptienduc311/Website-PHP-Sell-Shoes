<?php

// function check_login($username, $password) {
//     global $list_users;
//     foreach ($list_users as $user) {
//         if ($username == $user['username'] && md5($password) == $user['password']) {
//             return true;
//         }
//     }
//     return false;
// }

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

//Hàm kiểm tra trường đó có tồn tại trong mảng không
// function info_user($field) {
//     global $list_users;
//     if (isset($_SESSION['is_login'])) {
//         foreach ($list_users as $user) {
//             if ($_SESSION['username'] == $user['username']) {
//                 if (array_key_exists($field, $user)) {
//                     return $user[$field];
//                 }
//             }
//         }
//     }
//     return false;
// }
