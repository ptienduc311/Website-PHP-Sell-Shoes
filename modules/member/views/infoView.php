<?php
get_header("member");
$data_member = getMemberByUsername($_SESSION['username']);
?>

<div id="main-content-wp-member" class="home-page clearfix">
    <div class="wp-inner">
        <div class="main-content fl-right">
            <div class="block-welcom">
                <div class="welcom-logo">
                    <img src="public/images/avatar.png" alt="">
                </div>
                <div class="welcom-member">
                    <p class="text-welcom-1">Xin chào</p>
                    <p class="text-welcom-2"><?php echo $data_member['username']; ?></p>
                    <div class="welcom-info">
                        <div class="item-contentWelcome">
                            <p>Ngày tham gia</p>
                            <div class="cp-icon">
                                <i class="fa-regular fa-calendar-days"></i>
                            </div>
                            <p>7/11/2023</p>
                        </div>
                        <div class="item-contentWelcome">
                            <p>Hạng thành viên</p>
                            <div class="cp-icon">
                                <i class="fa-solid fa-ranking-star"></i>
                            </div>
                            <p>ShoesNull</p>
                        </div>
                        <div class="item-contentWelcome">
                            <p>Tổng đơn mua</p>
                            <div class="cp-icon">
                                <i class="fa-solid fa-cart-shopping"></i>
                            </div>
                            <p>7/11/2023</p>
                        </div>
                    </div>
                </div>
                <div id="info-member">
                    <h3>Thông tin khách hàng</h3>
                    <form action="" method="post" id="">
                        <div class="form-group">
                            <label for="fullname">Họ và tên:</label>
                            <input type="text" name="fullname" id="fullname" value="<?php echo $data_member['fullname']; ?>" placeholder="Nhập họ tên">
                        </div>
                        <div class="form-group">
                            <label for="username">Tên đăng nhập:</label>
                            <input type="text" name="username" id="username" readonly="readonly" value="<?php echo $data_member['username']; ?>" style="background-color: #d3c4c4;">
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="text" name="email" id="email" value="<?php echo $data_member['email']; ?>" readonly="readonly" style="background-color: #d3c4c4;">
                        </div>
                        <div class="form-group">
                            <label for="phone_number">Số điện thoại:</label>
                            <input type="text" name="phone_number" id="phone_number" value="<?php echo $data_member['phone_number']; ?>" placeholder="Nhập số điện thoại">
                        </div>
                        <div class="form-group">
                            <label for="address">Địa chỉ:</label>
                            <input type="text" name="address" id="address" value="<?php echo $data_member['address']; ?>" placeholder="Nhập địa chỉ">
                        </div>
                        <input class="button-member" type="submit" value="Cập nhật thông tin" name="btn-update">
                </div>

                <div id="info-member">
                    <h3>Thay đổi mật khẩu</h3>
                    <form action="" method="post" id="">
                        <div class="form-group">
                            <label for="password-current">Mật khẩu hiện tại:</label>
                            <input type="password" name="password-current" id="password-current" value="" placeholder="Nhập mật khẩu hiện tại">
                        </div>
                        <p class="error"> <?php echo form_error('password_current'); ?></p>
                        <p class="error"> <?php echo form_error('password'); ?></p>
                        <div class="form-group">
                            <label for="password-new">Mật khẩu mới:</label>
                            <input type="password" name="password-new" id="password-new" value="" placeholder="Xác nhận mật khẩu">
                        </div>
                        <div class="form-group">
                            <label for="password-confirm">Nhập lại mật khẩu mới:</label>
                            <input type="password" name="password-confirm" id="password-confirm" value="" placeholder="Nhập mật khẩu mới">
                        </div>
                        <p class="error"> <?php echo form_error('password_new'); ?></p>
                        <p class="error"> <?php echo form_error('password_mismatched'); ?></p>
                        <input class="button-member" type="submit" value="Xác nhận" name="btn-reset">
                </div>

            </div>
            </form>
        </div>

    </div>
    <div class="sidebar fl-left">
        <div class="block-menu">
            <div class="block-menu-item button-home active">
                <div class="item-menu">
                    <div class="box-icon">
                        <i class="fa-solid fa-house-user"></i>
                    </div>
                    <p>Trang chủ</p>
                </div>
            </div>
            <div class="block-menu-item button-historty">
                <div class="item-menu">
                    <div class="box-icon">
                        <i class="fa-solid fa-bag-shopping"></i>
                    </div>
                    <p>Lịch sử mua hàng</p>
                </div>
            </div>
            <div class="block-menu-item button-guarantee">
                <div class="item-menu">
                    <div class="box-icon">
                        <i class="fa-solid fa-shield"></i>
                    </div>
                    <p>Tra cứu bảo hành</p>
                </div>
            </div>
            <div class="block-menu-item button-promotion">
                <div class="item-menu">
                    <div class="box-icon">
                        <i class="fa-solid fa-gift"></i>
                    </div>
                    <p>Ưu đãi của bạn</p>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<?php
get_footer();
// show_array($data_member);
?>