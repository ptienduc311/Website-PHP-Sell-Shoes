<?php
get_header();
$list_buy = get_data_product_cart();
$total = get_total_cart();
?>

<div id="main-content-wp" class="checkout-page">
    <div class="section" id="breadcrumb-wp">
        <div class="wp-inner">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="?page=home" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Thanh toán</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="wrapper" class="wp-inner clearfix">
        <form method="POST" action="" name="form-checkout">
            <div class="section" id="customer-info-wp">
                <div class="section-head">
                    <h1 class="section-title">Thông tin khách hàng</h1>
                </div>
                <div class="section-detail">
                    <div class="form-row clearfix">
                        <div class="form-col fl-left">
                            <label for="fullname">Họ tên</label>
                            <input type="text" name="fullname" id="fullname" value="<?php echo set_value('fullname'); ?>">
                            <p class="error"> <?php echo form_error('fullname'); ?></p>
                        </div>
                        <div class="form-col fl-right">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" value="<?php echo set_value('email'); ?>">
                            <p class="error"> <?php echo form_error('email'); ?></p>
                        </div>
                    </div>
                    <div class="form-row clearfix">
                        <div class="form-col fl-left">
                            <label for="address">Địa chỉ</label>
                            <input type="text" name="address" id="address" value="<?php echo set_value('address'); ?>">
                            <p class="error"> <?php echo form_error('address'); ?></p>
                        </div>
                        <div class="form-col fl-right">
                            <label for="phone_number">Số điện thoại</label>
                            <input type="tel" name="phone_number" id="phone_number" value="<?php echo set_value('phone_number'); ?>">
                            <p class="error"> <?php echo form_error('phone_number'); ?></p>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-col">
                            <label for="notes">Ghi chú</label>
                            <textarea name="note"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="section" id="order-review-wp">
                <div class="section-head">
                    <h1 class="section-title">Thông tin đơn hàng</h1>
                </div>
                <div class="section-detail">
                    <?php
                    if (isset($_SESSION['cart'])) {
                    ?>
                        <table class="shop-table">
                            <thead>
                                <tr>
                                    <td>Sản phẩm</td>
                                    <td>Tổng</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($list_buy as &$data) {
                                    foreach ($data as &$item) {
                                ?>
                                        <tr class="cart-item">
                                            <td class="product-name">
                                                <div id="cart_checkout">
                                                    <div class="img_product_checkout">
                                                        <a href="<?php echo $item['url']; ?>" class="img-container">
                                                            <img src="<?php echo base_url(); ?>/admin/<?php echo $item['product_thumb'] ?>" alt="">
                                                        </a>
                                                    </div>
                                                    <div class="info_product_checkout">
                                                        <a href="<?php echo $item['url']; ?>">
                                                            <p class="product_name"><?php echo $item['product_name']; ?><strong class="product-quantity">x <?php echo $item['product_quantity']; ?></strong></p>
                                                        </a>
                                                        <p class="product_price"><?php echo currency_format($item['product_price']); ?> <span class="product_initial"><?php echo currency_format($item['product_initial']); ?></span></p>
                                                        <p class="size">Size: <span><?php echo $item['product_size']; ?></span></p>
                                                    </div>
                                                </div>

                                            </td>
                                            <td class="product-total"><?php echo currency_format($item['sub_total']); ?></td>
                                        </tr>
                                <?php
                                    }
                                }
                                ?>

                            </tbody>
                            <tfoot>
                                <tr class="order-total">
                                    <td>Tổng đơn hàng:</td>
                                    <td><strong class="total-price" style="text-transform: lowercase;"><?php echo currency_format($total); ?></strong></td>
                                </tr>
                            </tfoot>
                        </table>
                    <?php
                    } else {
                    ?>
                        <div class="checkout_empty">
                            <p class="text_empty">Chưa có sản phẩm nào</p>
                            <p class="checkout_buy">Nhấn vào <a href="?mod=product">đây</a> để mua hàng</p>
                        </div>
                    <?php
                    }
                    ?>

                    <div id="payment-checkout-wp">
                        <ul id="payment_methods">
                            <li>
                                <input type="radio" id="online-payment" name="payment-method" value="Online">
                                <label for="online-payment">Thanh toán online</label>
                            </li>
                            <li>
                                <input type="radio" id="payment-home" name="payment-method" value="COD">
                                <label for="payment-home">Thanh toán khi nhận hàng</label>
                            </li>
                        </ul>
                        <p class="error"> <?php echo form_error('payment-method'); ?></p>
                    </div>
                    <div class="place-order-wp clearfix">
                        <input type="submit" id="order-now" name="btn-order" value="Đặt hàng">
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<?php
get_footer();
show_array($list_buy);
echo "<hr>";
foreach($list_buy as $item){
    show_array($item);
}
echo "<hr>";
foreach($list_buy as $item){
    foreach($item as $data)
        show_array($data);
}
// show_array($_SESSION['cart']);
?>