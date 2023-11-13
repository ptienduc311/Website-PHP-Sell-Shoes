<?php
get_header("account");
?>

<div class="container" id="container">
    <a class="btn-home icon" href="?mod=home"><i class="fa-solid fa-house"></i></a>
    <div class="form-container sign-in">
        <form action="" method="POST">
            <h1>Đăng nhập</h1>
            <div class="social-icons">
                <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
            </div>
            <span>hoặc sử dụng tài khoản của bạn</span>
            <input type="text" name="username" placeholder="Username" value="<?php if(isset($_COOKIE['username'] ) && isset($_COOKIE['password'])){ echo $_COOKIE['username']; } ?>">
            <?php echo form_error('username'); ?>
            <input type="password" name="password" placeholder="Mật khẩu"  value="<?php if(isset($_COOKIE['username'] ) && isset($_COOKIE['password'])){ echo $_COOKIE['password']; } ?>">
            <?php echo form_error('password'); ?>
            <?php echo form_error('account'); ?>
            <div id="remember">
                <input type="checkbox" id="remember-me" name="remember-me">
                <label for="remember-me">Ghi nhớ đăng nhập</label>
            </div>
            <a href="?mod=users&action=resetPass">Quên mật khẩu?</a>
            <button type="submit" name="btn-login">Đăng nhập</button>

            <!-- <input type="submit" name="btn-login" value="Đăng nhập" class="btn-login" /> -->
        </form>
    </div>
    <div class="toggle-container">
        <div class="toggle">
            <div class="toggle-panel toggle-right">
                <h1>Chào bạn!</h1>
                <p>Hãy đăng ký là thành viên để tận hưởng dịch vụ của chúng tôi</p>
                <a href="?mod=users&action=register"><button class="hidden" id="register">Đăng ký</button></a>
            </div>
        </div>
    </div>
</div>

<?php
get_footer("account");
?>