<?php

#----------ĐĂNG NHẬP----------
//Kiểm tra tồn tại tài khoản
function check_login($username, $password)
{
    $check_user = db_num_rows("select * from `users` where `username`='{$username}' and `password`='{$password}'");
    if ($check_user > 0) {
        return true;
    }
    return false;
}

//Kiểm tra tài khoản đã kích hoạt chưa
function check_active($username){
    $check_active = db_num_rows("select * from `users` where `username`='{$username}' and `is_active`='1'");
    if ($check_active > 0) {
        return true;
    }
    return false;
}

//Kiểm tra kiểu tài khoản theo username
function check_type_user($username){
    $sql = "SELECT `type_user` FROM `users` WHERE username = '$username'";
    $data = db_fetch_row($sql);
    return $data['type_user'];
}

#----------ĐĂNG KÝ--------------
//Kiểm tra email hay username có tồn tại trên hệ thống chưa
function user_exists($username, $email)
{
    $sql = db_num_rows("SELECT * FROM users WHERE username='$username' OR email='$email'");
    if ($sql > 0) {
        return true;
    }
    return false;
}

//Thêm 1 user mới
function add_user($data)
{
    return db_insert('users', $data);
}

//Xóa 1 tài khoản khi chưa xác nhận email trong khoảng thời gian 1 ngày
function delete_unconfirmed_accounts()
{
    $where = "created_at <= NOW() - INTERVAL 1 MINUTE AND is_active = '0'";
    return db_delete('users', $where);
}

#------Xác nhận đăng ký----------
//Xác thực mã xác nhận
function check_active_token($active_token)
{
    $sql = db_num_rows("SELECT * FROM users WHERE `active_token`='$active_token' and `is_active`='0'");
    if ($sql > 0) {
        return true;
    }
    return false;
}
//Chuyển active_token = 1
function active_user($active_token)
{
    return db_update('users', ['is_active' => 1], "`active_token`='$active_token'");
}


#----------RESET MẬT KHẨU----------
//Kiểm tra tồn tại email
function check_email($email)
{
    $check = db_num_rows("SELECT * FROM `users` WHERE `email` = '$email'");
    if ($check > 0) {
        return true;
    }
    return false;
}

//Cập nhật mã reset_token
function update_reset_token($data, $email){
    return db_update('users', $data, "`email` = '$email'");
}

#-------------CẬP NHẬT MẬT KHẨU MỚI-----------

//Kiểm tra reset_token trên database
function check_reset_token($reset_token){
    $check = db_num_rows("SELECT * FROM `users` WHERE `reset_token` = '$reset_token'");
    if ($check > 0) {
        return true;
    }
    return false;
}

//Cập nhật mật khẩu
function update_new_pass($data, $reset_token){
    db_update('users', $data, "`reset_token` = '$reset_token'");
}