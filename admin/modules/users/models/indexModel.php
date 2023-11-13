<?php
#----------ĐĂNG KÝ----------

//Thêm 1 user mới
function add_user($data)
{
    return db_insert('users', $data);
}

//Xóa 1 tài khoản khi chưa xác nhận email trong khoảng thời gian 1 ngày
function delete_unconfirmed_accounts()
{
    $where = "created_at <= NOW() - INTERVAL 1 DAY AND is_active = '0'";
    return db_delete('users', $where);
}

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


//Lấy thông tin user qua username
function get_user_by_username($username)
{
    $item = db_fetch_row("select * from `users` where `username`='$username'");
    if (!empty($item)) {
        return $item;
    }
}



function info_user($label = 'id')
{
    $username = $_SESSION['username'];
    $user = db_fetch_array("select *from `users` where `username`='$username'");
    return $user[$label];
}


function user_exists($username, $email)
{
    $sql = db_num_rows("SELECT * FROM users WHERE username='$username' OR email='$email'");
    if ($sql > 0) {
        return true;
    }
    return false;
}

function get_list_users()
{
    $result = db_fetch_array("select * from users");
    return $result;
}

//Lấy thông tin user qua id
function get_user_by_id($id)
{
    $item = db_fetch_row("select * from users where user_id=$id");
    return $item;
}

//Cập nhật thông tin user
function update_user($data, $username)
{
    return db_update("users", $data, "`username`='$username'");
}

//Cập nhật mật khẩu mới cho user
function update_password($username, $new_password)
{
    global $conn;
    $sql = db_query("UPDATE `users` SET `password` = MD5('$new_password') WHERE `users`.`username` = '$username'");
    return $sql;
}

#---------CẬP NHẬT MẬT KHẨU----------------
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