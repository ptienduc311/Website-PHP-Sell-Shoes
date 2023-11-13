<?php
get_header();
?>

<div id="main-content-wp" class="info-account-page">
    <div class="wrap clearfix">
        <?php
        get_sidebar('users');
        ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Cập nhật tài khoản</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST">
                        <label for="display-name">Tên hiển thị</label>
                        <input type="text" name="fullname" id="display-name" value="<?php echo $info_user['fullname']; ?>">
                        <p class="error"> <?php echo form_error('fullname'); ?></p>
                        <label for="username">Tên đăng nhập</label>
                        <input type="text" name="username" id="username" placeholder="admin" readonly="readonly" value="<?php echo $info_user['username']; ?>">
                        <p class="error"> <?php echo form_error('username'); ?></p>
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" value="<?php echo $info_user['email']; ?>">
                        <p class="error"> <?php echo form_error('email'); ?></p>
                        <label for="tel">Số điện thoại</label>
                        <input type="tel" name="phone_number" id="tel" value="<?php echo $info_user['phone_number']; ?>">
                        <label for="address">Địa chỉ</label>
                        <textarea name="address" id="address"><?php echo $info_user['address']; ?></textarea>
                        <button type="submit" name="btn-submit" id="btn-submit">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
get_footer();
// show_array($info_user);
?>