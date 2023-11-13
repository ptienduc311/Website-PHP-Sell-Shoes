<?php
get_header();
$id = $_GET['id'];
$list_name_cat = get_name_category();
$data_product = get_info_product_by_id($id);
$list_size = get_size_product_by_id($id);
$image_default = get_image_default($id);
$list_image = get_image_by_id($id);
$data_product_same_cat = get_data_product_by_category_id($data_product['category_id'], $id);
?>

<div id="main-content-wp" class="clearfix detail-product-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Chi tiết sản phẩm</a>
                    </li>
                    <li>
                        <a class="path_active" href="" title=""><?php echo $data_product['product_name']; ?></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section" id="detail-product-wp">
                <div class="section-detail clearfix">
                    <div class="thumb-wp fl-left">
                        <div class="img_show">
                            <a href="" title="" id="main-thumb">
                                <!-- <img id="zoom" src="https://media3.scdn.vn/img2/2017/10_30/sxlpFs_simg_ab1f47_350x350_maxb.jpg" data-zoom-image="https://media3.scdn.vn/img2/2017/10_30/sxlpFs_simg_70aaf2_700x700_maxb.jpg" /> -->
                                <img id="zoom" src="<?php echo base_url(); ?>/admin/<?php echo $image_default['image_url']; ?>" data-zoom-image="<?php echo base_url(); ?>/admin/<?php echo $image_default['image_url']; ?>" />
                            </a>
                        </div>

                        <div id="list-thumb">
                            <?php
                            foreach ($list_image as $item) {
                            ?>
                                <a href="" data-image="<?php echo base_url(); ?>/admin/<?php echo $item['image_url']; ?>" data-zoom-image="<?php echo base_url(); ?>/admin/<?php echo $item['image_url']; ?>">
                                    <img id="zoom" src="<?php echo base_url(); ?>/admin/<?php echo $item['image_url']; ?>" />
                                </a>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="thumb-respon-wp fl-left">
                        <img src="public/images/img-pro-01.png" alt="">
                    </div>
                    <form action="" method="post">
                        <div class="info fl-right">
                            <h3 class="product-name"><?php echo $data_product['product_name']; ?></h3>
                            <div class="desc">
                                <p>Mã sản phẩm : <span style="font-weight: bold; color: #fa3a3a;"><?php echo $data_product['product_code']; ?></span></p>
                            </div>
                            <div class="num-product">
                                <span class="title">Sản phẩm: </span>
                                <?php
                                if ($data_product['product_status'] == "out_of_stock" || $data_product['stock_quantity'] == 0) {
                                ?>
                                    <span class="status">Hết hàng</span>
                                <?php
                                } else {
                                ?>
                                    <span class="status">Còn hàng</span>
                                <?php
                                }
                                ?>
                            </div>
                            <p class="price"><span style="font-size: 15px; color: #8b8282; text-decoration: line-through;"><?php echo currency_format($data_product['product_initial']); ?> </span><?php echo currency_format($data_product['product_price']); ?></p>
                            <div id="num-order-wp">
                                <p style="display: inline-block; color: #666;">Chọn số lượng: </p>
                                <a title="" id="minus"><i class="fa fa-minus"></i></a>
                                <input type="number" name="num-order" value="1" min="1" max="<?php echo $data_product['stock_quantity']; ?>" id="num-order">
                                <a title="" id="plus"><i class="fa fa-plus"></i></a>
                            </div>
                            <div class="size-container">
                                <?php foreach ($list_size as $item) { ?>
                                    <input type="radio" class="size" name="size" id="<?php echo $item['size_id'] ?>" value="<?php echo $item['size_name'] ?>">
                                    <label for="<?php echo $item['size_id'] ?>"><?php echo $item['size_name'] ?></label>
                                <?php } ?>
                                <p class="error"> <?php echo form_error('size'); ?></p>
                            </div>
                            <?php
                            if ($data_product['product_status'] == "out_of_stock" || $data_product['stock_quantity'] == 0) {
                            ?>
                                <input type="submit" class="add-cart" name="btn_addCart" value="Thêm giỏ hàng" disabled>
                                <input type="submit" class="checkout" name="btn_checkout" value="Thanh toán" disabled>
                            <?php
                            } else {
                            ?>
                                <input type="submit" class="add-cart" name="btn_addCart" value="Thêm giỏ hàng">
                                <input type="submit" class="checkout" name="btn_checkout" value="Thanh toán">
                            <?php
                            }
                            ?>
                        </div>
                    </form>

                </div>
            </div>
            <div class="section" id="post-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Mô tả sản phẩm</h3>
                </div>
                <div class="section-detail">
                    <p><?php echo $data_product['product_detail']; ?></p>

                </div>
                <div class="section-head">
                    <h3 class="section-title">Thông số sản phẩm</h3>
                </div>
                <div class="section-detail">
                    <p><?php echo $data_product['product_parameter']; ?></p>

                </div>
            </div>
            <div class="section" id="same-category-wp">
                <div class="section-head">
                    <h3 class="section-title">Cùng chuyên mục</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item">
                        <?php
                        foreach ($data_product_same_cat as $item) {
                        ?>
                            <li>
                                <a href="" title="" class="thumbnail">
                                    <img src="<?php echo base_url(); ?>/admin/<?php echo $item['product_thumb']['image_url']; ?>">
                                </a>
                                <a href="" title="" class="product-name"><?php echo $item['product_name']; ?></a>
                                <div class="price">
                                    <span class="new"><?php echo currency_format($item['product_price']); ?></span>
                                    <span class="old"><?php echo currency_format($item['product_initial']) ?></span>
                                </div>
                                <div class="action clearfix">
                                    <a href="<?php echo $item['url']; ?>" title="" class="buy-now">Mua ngay</a>
                                </div>
                            </li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="sidebar fl-left">
            <div class="section" id="category-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Danh mục sản phẩm</h3>
                </div>
                <div class="secion-detail">
                    <ul class="list-item">
                        <?php
                        foreach ($list_name_cat as $item) {
                        ?>
                            <li>
                                <a href="?mod=product&action=productCat&id=<?php echo $item['category_id']; ?>" title=""><?php echo $item['category_name']; ?></a>
                            </li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <div class="section" id="banner-wp">
                <div class="section-detail">
                    <a href="" title="" class="thumb">
                        <img src="public/images/banner-shoes.jpg" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();
show_array($data_product);
// show_array($image_default);
// show_array($list_image);
// show_array($list_size);
// show_array($_SESSION['cart']);
// show_array($data_product_same_cat);
?>