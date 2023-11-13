<?php

//Lấy thông tin member by username
function getMemberByUsername($username) {
    $sql = "SELECT * FROM `users` WHERE username='$username'";
    return db_fetch_row($sql);
}

//Cập nhật thông tin khách hàng nhập
function updateCustomerInfo($data, $username){
	return db_update('users', $data, "username = '$username'");
}

//Kiểm tra mật khẩu người dùng
function check_password($username, $password){
    $check_password = db_num_rows("select * from `users` where `username`='{$username}' and `password`='$password'");
    if ($check_password > 0) {
        return true;
    }
    return false;
}