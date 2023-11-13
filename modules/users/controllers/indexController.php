<?php
function construct()
{
    load_model('index');
    load('lib', 'validation');
    load('lib', 'email');
}

#---------------ĐĂNG KÝ---------------
function registerAction()
{
    global $error, $username, $password, $email, $data;
    if (isset($_POST['btn-reg'])) {

        #Kiểm tra validation username
        if (empty($_POST['username'])) {
            $error['username'] = "Vui lòng nhập tên đăng nhập của bạn";
        } else {
            if (!is_username($_POST['username'])) {
                $error['username'] = "Xin lỗi, tên đăng nhập phải có từ 8-32 ký tự và bao gồm ít nhất một chữ cái (a-z A-Z) và số (0-9)";
            } else {
                $username = $_POST['username'];
            }
        }

        #Kiểm tra password
        if (empty($_POST['password'])) {
            $error['password'] = "Vui lòng nhập mật khẩu của bạn";
        } else {
            if (!is_password($_POST['password'])) {
                $error['password'] = "Xin lỗi, mật khẩu phải có từ 6-32 ký tự và bao gồm chữ cái, số, các ký tự đặc biệt";
            } else {
                $password = md5($_POST['password']);
            }
        }

        #Kiểm tra email
        if (empty($_POST['email'])) {
            $error['email'] = "Vui lòng nhập email của bạn";
        } else {
            $email = $_POST['email'];
        }


        #Kết luận
        if (empty($error)) {
            if (!user_exists($username, $email)) {
                $active_token = md5($username . time());
                $data = [
                    'username' => $username,
                    'password' => $password,
                    'email' => $email,
                    'active_token' => $active_token
                ];
                $link_active = base_url("?mod=users&action=active&active_token=$active_token");
                $link_register = base_url("?mod=users&action=register");
                $content = '
                <!DOCTYPE html>
                    <html lang="en">
                    <head>
                        <meta charset="UTF-8">
                        <meta http-equiv="X-UA-Compatible" content="IE=edge">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <style>
                            body {
                                font-family: Arial, sans-serif;
                                line-height: 1.6;
                                color: #333;
                                background-color: #f4f4f4;
                                margin: 0;
                                padding: 0;
                            }

                            .container {
                                max-width: 600px;
                                margin: 20px auto;
                                padding: 20px;
                                background-color: #fff;
                                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                                border-radius: 5px;
                            }

                            .header {
                                background-color: #007bff;
                                color: #fff;
                                padding: 10px;
                                text-align: center;
                            }

                            .content {
                                margin-top: 20px;
                            }

                            p {
                                margin-bottom: 15px;
                            }
                            p.notify {
                                opacity: 0.7;
                                font-style: italic;
                            }
                        
                            a.register {
                                text-transform: uppercase;
                                font-weight: bold;
                                color: red;
                                text-decoration: none;
                                transition: text-decoration 0.3s ease;
                            }
                        
                            a.register:hover {
                                text-decoration: underline;
                            }

                        </style>
                    </head>
                    <body>
                        <div class="container">
                            <div class="header">
                                <h2>Xác nhận tài khoản của bạn</h2>
                            </div>
                            <div class="content">
                                <p>Xin chào ' . $username . ',</p>
                                <p>Cảm ơn bạn đã đăng ký tài khoản tại Shoes Store. Để hoàn tất quá trình đăng ký, hãy nhấn vào nút bên dưới:</p>
                                <a class="button" href="' . $link_active . '" style="display: inline-block; padding: 10px 20px; background-color: #007bff; color: #fff; text-decoration: none;">Xác nhận tài khoản</a>
                                <p>Nếu bạn không thực hiện đăng ký, vui lòng bỏ qua email này.</p>
                                <p class="notify">Email này có hiệu lực trong vòng 24 giờ. Nếu quá 24 giờ xác nhận sẽ không còn hiệu lực.</p>
                                <p class="notify">Nếu bạn vẫn muốn đăng ký tài khoản thì hãy nhấn vào đường dẫn bên dưới</p>
                                <a href="' . $link_register . '" class="register">Đăng ký</a>
                                <p style="font-weight:bold;">Trân trọng,</p>
                                <p>Shoes Store</p>
                            </div>
                        </div>
                    </body>
                    </html>
                ';

                add_user($data);
                send_mail($email, '', "SHOES STORE - Đăng ký tài khoản Shoes Store", $content);
                delete_unconfirmed_accounts();
            } else {
                $error['account'] = "Email hoặc username đã tồn tại trên hệ thống ";
            }
        }
    }
    load_view('register');
}

#-------Xác nhận email để kích hoạt tài khoản-------
function activeAction(){
    $active_token = $_GET["active_token"];
    if (check_active_token($active_token)) {
        active_user($active_token);
        load_view("active");
    } else {
        echo "Yêu cầu kích hoạt không hợp lệ hoặc tài khoản đã được kích hoạt trước đó";
    }
    
}

#---------------ĐĂNG NHẬP--------------
function loginAction()
{
    global $error, $username, $password, $a;
    if (isset($_POST['btn-login'])) {
        $error = [];
        #Kiểm tra validation username
        if (empty($_POST['username'])) {
            $error['username'] = "Vui lòng nhập tên đăng nhập của bạn";
        } else {
            if (!is_username($_POST['username'])) {
                $error['username'] = "Xin lỗi, tên đăng nhập phải có từ 8-32 ký tự và bao gồm ít nhất một chữ cái (a-z A-Z) và số (0-9)";
            } else {
                $username = $_POST['username'];
            }
        }

        #Kiểm tra password
        if (empty($_POST['password'])) {
            $error['password'] = "Vui lòng nhập mật khẩu của bạn";
        } else {
            if (!is_password($_POST['password'])) {
                $error['password'] = "Xin lỗi, mật khẩu phải có từ 6-32 ký tự và bao gồm chữ cái, số, các ký tự đặc biệt";
            } else {
                $password = md5($_POST['password']);
            }
        }

        #Kết luận
        if (empty($error)) {
            if (check_login($username, $password)) {
                if (check_active($username)) {
                    //Lưu trữ phiên đăng nhập
                    $_SESSION['is_login'] = true;
                    $_SESSION['username'] = $username;
                    //Chuyển hướng người dùng
                    #Ghi nhớ đăng nhập
                    if (isset($_POST['remember-me'])) {
                        setcookie('password', $_POST['password'], time() + 3600);
                        setcookie('username', $_SESSION['username'], time() + 3600);
                    }
                    if (check_type_user($username) == '1') {
                        $_SESSION['role'] = "admin";
                        redirect("admin/?");
                    } else {
                        $_SESSION['role'] = "member";
                        redirect("?mod=member");
                    }
                }
                else{
                    $error["account"]="Tài khoản chưa được kích hoạt";
                }
            } else {
                $error['account'] = "Tài khoản không tồn tại";
            }
        }
        // show_array($_COOKIE);
    }
    load_view('login');
}

#--------ĐỔI MẬT KHẨU------------
function resetPassAction(){
    global $error, $email;
    if (isset($_POST['btn-confirm'])) {
        #Kiểm tra email
        if (empty($_POST['email'])) {
            $error['email'] = "Vui lòng nhập email của bạn";
        } else {
            $email = $_POST['email'];
        }
        if (empty($error)) {
            if (check_email($email)) {
                $reset_token = md5($email . time());
                $data = [
                    'reset_token' => $reset_token
                ];
                update_reset_token($data, $email);

                $link_active = base_url("?mod=users&action=newPass&reset_token=$reset_token");
                $content = '
            <!DOCTYPE html>
            <html lang="vi">

            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Đặt lại mật khẩu</title>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        background-color: #f2f2f2;
                        margin: 0;
                        padding: 0;
                    }

                    .container {
                        max-width: 600px;
                        margin: 20px auto;
                        padding: 20px;
                        background-color: #fff;
                        border-radius: 8px;
                        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                    }

                    .header {
                        background-color: #007bff;
                        color: #fff;
                        padding: 10px;
                        text-align: center;
                    }

                    h2 {
                        color: #333;
                    }

                    p {
                        color: #555;
                    }

                    p.phone,
                    p.email {
                        font-size: 14px;
                        font-style: italic;
                        opacity: 0.8;
                    }

                    span.phone,
                    span.email {
                        color: #cc0909;
                        font-weight: bold;
                        margin-top: 5px;
                    }

                    .button {
                        display: inline-block;
                        padding: 10px 20px;
                        background-color: #007BFF;
                        color: #fff;
                        text-decoration: none;
                        border-radius: 5px;
                    }

                    .button:hover {
                        background-color: #0056b3;
                    }
                </style>
            </head>

            <body>
                <div class="container">
                    <div class="header">
                        <h2>Đặt lại mật khẩu</h2>
                    </div>
                    <h3>Xin chào,</h3>
                    <p>Chúng tôi đã nhận được yêu cầu đặt lại mật khẩu của bạn. Nếu bạn không yêu cầu điều này, vui lòng bỏ qua email này.</p>
                    <p>Để đặt lại mật khẩu, hãy nhấp vào nút dưới đây:</p>
                    <a class="button" href="' . $link_active . '" style="display: inline-block; padding: 10px 20px; background-color: #007bff; color: #fff; text-decoration: none;">Đặt lại mật khẩu</a>
                    <p>Nếu bạn gặp bất kỳ vấn đề nào, vui lòng liên hệ với chúng tôi:</p>
                    <p class="phone">Qua số điện thoại: <span class="phone">0338.237.xxx</span></p>
                    <p class="email">Qua email: <span class="email">storeshoes@gmail.com</span></p>
                    <p>Shoes store hân hạnh được đồng hành cùng bạn</p>
                </div>
            </body>

            </html>
           ';
                send_mail($email, '', "SHOES STORE - Khôi phục lại mật khẩu", $content);
            } else {
                $error['account'] = "Email này không tồn tại";
            }
        }
    }
    load_view("resetPass");
}

#-------------ĐỔI MẬT KHẨU MỚI-------------------
function newPassAction(){
    global $error, $password;
    $reset_token = $_GET['reset_token'];
    if (check_reset_token($reset_token)) {
        if (isset($_POST['btn-confirm'])) {
            #Kiểm tra password
            if (empty($_POST['newPassword'])) {
                $error['password'] = "Vui lòng nhập mật khẩu của bạn";
            } else {
                if (!is_password($_POST['newPassword'])) {
                    $error['password'] = "Xin lỗi, mật khẩu phải có từ 6-32 ký tự và bao gồm chữ cái, số, các ký tự đặc biệt";
                } else {
                    if($_POST['newPassword'] != $_POST['confirmPassword']){
                        $error['password'] = "Mật khẩu không khớp, mời nhập lại";
                    }
                    else{
                        $password = md5($_POST['newPassword']);
                    }
                }
            }
            if(empty($error)){
                $data=[
                    'password'=>$password,
                ];
                update_new_pass($data, $reset_token);
                redirect("?mod=users&action=login");
            }
        }
    }
    else{
        $error['code'] = "Mã xác nhận không đúng";
    }
    load_view("newPass");
}
