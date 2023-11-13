<?php
get_header("account");
?>

<div class="container active" id="container">
    <a class="btn-home icon"><i class="fa-solid fa-house"></i></a>
    <div class="form-container sign-up">
        <form method="POST">
            <h1>Tạo tài khoản</h1>
            <div class="social-icons">
                <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
            </div>
            <span>hoặc sử dụng email để đăng ký</span>
            <input type="text" name="username" placeholder="Name">
            <?php echo form_error('username'); ?>
            <input type="email" name="email" placeholder="Email">
            <?php echo form_error('email'); ?>
            <input type="password" name="password" placeholder="Mật khẩu">
            <?php echo form_error('password'); ?>
            <?php echo form_error('account'); ?>
            <button name="btn-reg">Đăng ký</button>
        </form>
    </div>
    <div class="toggle-container">
        <div class="toggle">
            <div class="toggle-panel toggle-left">
                <h1>Xin chào!</h1>
                <p>Bạn đã là thành viên!</p><br>
                <p>Hãy đăng nhập để cùng nhau khám phá ngay</p>
                <a href="?mod=users&action=login"><button class="hidden" id="login">Đăng nhập</button></a>
            </div>
        </div>
    </div>
</div>

<?php
get_footer("account")
?>