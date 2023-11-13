<?php
get_header();
$list_buy = get_data_product_cart();

?>

<div id="main-content-wp" class="cart-page">
    <div class="section" id="breadcrumb-wp">
        <div class="wp-inner">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="?page=home" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Giỏ hàng</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div id="wrapper" class="wp-inner clearfix">
        <?php
        if (!empty($list_buy)) {
        ?>
            <div class="section" id="info-cart-wp">
                <div class="section-detail table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <td>Mã sản phẩm</td>
                                <td>Ảnh sản phẩm</td>
                                <td>Thông tin sản phẩm</td>
                                <td>Giá sản phẩm</td>
                                <td>Số lượng</td>
                                <td colspan="2">Thành tiền</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($list_buy as $data) {
                                foreach ($data as $item) {
                            ?>
                                    <tr>
                                        <td>
                                            <?php echo $item['product_code']; ?>
                                        </td>
                                        <td>
                                            <a href="" title="" class="thumb">
                                                <img src="<?php echo base_url(); ?>/admin/<?php echo $item['product_thumb'] ?>" alt="">
                                            </a>
                                        </td>
                                        <td>
                                            <a href="<?php echo $item['url']; ?>" title="" class="name-product" id="name_product"><?php echo $item['product_name']; ?></a>
                                            <p id="size">Size giày: <span><?php echo $item['product_size']; ?></span></p>
                                        </td>
                                        <td><?php echo currency_format($item['product_price']); ?></td>
                                        <td>
                                            <input type="text" name="num-order" value="<?php echo $item['product_quantity']; ?>" class="num-order">
                                        </td>
                                        <td><?php echo currency_format($item['sub_total']); ?></td>
                                        <td>
                                            <a href="<?php echo $item['btn_delete'] ?>" title="" class="del-product"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>


                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="7">
                                    <div class="clearfix">
                                        <p id="total-price" class="fl-right">Tổng giá: <span><?php echo currency_format(get_total_cart()); ?></span></p>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="7">
                                    <div class="clearfix">
                                        <div class="fl-right">
                                            <a href="" title="" id="update-cart">Cập nhật giỏ hàng</a>
                                            <a href="?mod=checkout" title="" id="checkout-cart">Thanh toán</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="section" id="action-cart-wp">
                <div class="section-detail">
                    <p class="title">Click vào <span>“Cập nhật giỏ hàng”</span> để cập nhật số lượng. Nhập vào số lượng <span>0</span> để xóa sản phẩm khỏi giỏ hàng. Nhấn vào thanh toán để hoàn tất mua hàng.</p>
                    <a href="?mod=product" title="" id="buy-more">Mua tiếp</a><br />
                    <a href="?mod=cart&action=deleteCart" title="" id="delete-cart">Xóa giỏ hàng</a>
                </div>
            </div>
        <?php
        } else {
        ?>
            <div class="empty_cart">
                <img src="public/images/empty_cart.png" alt="">
            </div>
            <div class="text_cart">Giỏ hàng chưa có sản phẩm nào</div>
            <a href="?mod=product" class="path">Mua sắm ngay</a>
        <?php
        }
        ?>

    </div>
</div>

<?php
get_footer();
// show_array($list_buy);
show_array($_SESSION['cart']);
?>