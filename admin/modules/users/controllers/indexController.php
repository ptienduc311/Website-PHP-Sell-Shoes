<?php

function construct()
{
    load_model('index');
    load('lib', 'validation');
    load('lib', 'email');
}

function indexAction()
{
}



#----------------------ĐĂNG XUẤT----------------------
function logoutAction()
{
    unset($_SESSION['is_login']);
    unset($_SESSION['username']);
    unset($_SESSION['fullname']);
    unset($_SESSION['role']);
    setcookie('password', $_POST['password'], time() - 3600);
    setcookie('username', $_SESSION['username'], time() - 3600);
    header("Location: http://localhost/project/website_shoes/?mod=users&action=login");
}

#----------------------CẬP NHẬT----------------------
function updateAction()
{
    #Validation
    global $error, $fullname, $phone_number, $email, $address;
    if (isset($_POST['btn-submit'])) {
        $error = [];
        //Kiểm tra họ và tên
        if (empty($_POST['fullname'])) {
            $error['fullname'] = "Họ và tên không được bỏ trống";
        } else {
            $fullname = $_POST['fullname'];
        }
        //Kiểm tra định dạng email
        if (empty($_POST['email'])) {
            $error['email'] = "Email không được để trống";
        } else {
            if (!is_email($_POST['email'])) {
                $error['email'] = "Email không đúng định dạng";
            } else {
                $email = $_POST['email'];
            }
        }
        //Kiểm tra số điện thoại
        if (empty($_POST['phone_number'])) {
            $phone_number = NULL;
        } else {
            if (!is_numberPhone($_POST['phone_number'])) {
                $error['phone_number'] = 'Số điện thoại không đúng định dạng';
            } else {
                $phone_number = $_POST['phone_number'];
            }
        }
        //Kiểm tra địa chỉ
        if (empty($_POST['address'])) {
            $address = NULL;
        } else {
            $address = $_POST['address'];
        }

        if (empty($error)) {
            $data = [
                'fullname' => $fullname,
                'email' => $email,
                'phone_number' => $phone_number,
                'address' => $address
            ];
            update_user($data, $_SESSION['username']);
            // $_SESSION['fullname'] = $fullname;
        }
    }

    #Lấy thông tin của user qua username
    $info_user = get_user_by_username(user_login());

    #Tạo dữ liệu user gửi qua bên view
    $data['info_user'] = $info_user;
    // show_array($info_user);
    load_view('update', $data);
}

#----------------------ĐỔI MẬT KHẨU----------------------
function resetAction()
{
    global $error, $password_current, $password_confirm, $password_new;
    if (isset($_POST['btn-submit'])) {
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
    load_view('reset');
}