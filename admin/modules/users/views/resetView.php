<?php
get_header();
?>

<div id="main-content-wp" class="change-pass-page">
    <div class="wrap clearfix">
        <?php
        get_sidebar('users');
        ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Đổi mật khẩu</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST">
                        <label for="password-current">Mật khẩu hiện tại</label>
                        <input type="password" name="password-current" id="password-current">
                        <p class="error"> <?php echo form_error('password_current'); ?></p>
                        <p class="error"> <?php echo form_error('password'); ?></p>
                        <label for="password-new">Mật khẩu mới</label>
                        <input type="password" name="password-new" id="password-new">
                        <label for="password-confirm">Xác nhận mật khẩu</label>
                        <input type="password" name="password-confirm" id="password-confirm">
                        <p class="error"> <?php echo form_error('password_new'); ?></p>
                        <p class="error"> <?php echo form_error('password_mismatched'); ?></p>
                        <button type="submit" name="btn-submit" id="btn-submit">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
get_footer();
// show_array($_SESSION);  
?>