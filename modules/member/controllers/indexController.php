<?php
function construct(){
    load_model('index');
    load_model('info');
    load('lib', 'validation');
}
function indexAction(){
    load_view('index');
}

function infoAction(){
    global $error, $fullname, $phone_number,  $address, $password_current, $password_confirm, $password_new;
    if(isset($_POST['btn-update'])){
        $fullname = $_POST['fullname'];
        $phone_number = $_POST['phone_number'];
        $address = $_POST['address'];
        $data = [
            'fullname' => $fullname,
            'phone_number' => $phone_number,
            'address' => $address
        ];
        // show_array($data);
        updateCustomerInfo($data, $_SESSION['username']);
        echo "<script>alert('Cập nhật dữ liệu thành công')</script>";
    }
    if(isset($_POST['btn-reset'])){
        $password_current = $_POST['password-current'];
        $password_confirm = $_POST['password-confirm'];
        $password_new = $_POST['password-new'];
        if (empty($password_current)) {
            $error['password_current'] = "Vui lòng nhập mật khẩu hiện tại";
        } else {
            if (check_password($_SESSION['username'], md5($password_current))) {
                if (empty($password_confirm) || empty($password_new)) {
                    $error['password_new'] = "Vui lòng nhập mật khẩu mới";
                } else {
                    if ($password_new == $password_confirm) {
                        $data = [
                            'password' => md5($password_new),
                        ];
                        updateCustomerInfo($data, $_SESSION['username']);
                        echo "<script>alert('Mật khẩu đã được thay đổi');</script>";
                    } else {
                        $error['password_mismatched'] = "Mật khẩu không khớp, mời nhập lại";
                    }
                }
            } else {
                $error['password'] = "Mật khẩu bạn vừa nhập không đúng";
            }
        }
    }
    load_view('info');
}
#----------------------ĐĂNG XUẤT----------------------
function logoutAction()
{
    unset($_SESSION['is_login']);
    unset($_SESSION['username']);
    unset($_SESSION['fullname']);
    unset($_SESSION['role']);
    // setcookie('password', $_POST['password'], time() - 3600);
    // setcookie('username', $_SESSION['username'], time() - 3600);
    redirect("?mod=home");
}