<?php
if($_SESSION['role'] != 'member'){
    redirect("?mod=users&action=login");
}
get_header("member");
$data_product_cat = get_data_product_cat();

$data_product_selling = get_selling_products();
// $data_products = get_products_by_category_id(1);
// $data2 = get_image_default(1);
$data_sliders = get_all_sliders();
// show_array($_SESSION);

?>

<div id="main-content-wp" class="home-page clearfix">
    <div class="wp-inner">
        <div class="main-content fl-right">
            <div class="section" id="slider-wp">
                <div class="section-detail">
                    <?php
                    foreach ($data_sliders as $item) {
                    ?>
                        <div class="item">
                            <img src="<?php echo base_url(); ?>/admin/<?php echo $item['slider_image']['image_url']; ?>" alt="">
                        </div>
                    <?php
                    }
                    ?>

                </div>
            </div>
            <div class="section" id="support-wp">
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-1.png">
                            </div>
                            <h3 class="title">Miễn phí vận chuyển</h3>
                            <p class="desc">Tới tận tay khách hàng</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-2.png">
                            </div>
                            <h3 class="title">Tư vấn 24/7</h3>
                            <p class="desc">1900.9999</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-3.png">
                            </div>
                            <h3 class="title">Tiết kiệm hơn</h3>
                            <p class="desc">Với nhiều ưu đãi cực lớn</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-4.png">
                            </div>
                            <h3 class="title">Thanh toán nhanh</h3>
                            <p class="desc">Hỗ trợ nhiều hình thức</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-5.png">
                            </div>
                            <h3 class="title">Đặt hàng online</h3>
                            <p class="desc">Thao tác đơn giản</p>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="section" id="feature-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Sản phẩm nổi bật</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item">
                        <?php
                        foreach ($data_product_selling as $item) {
                            $featured_img = get_image_default($item['product_id']);
                        ?>
                            <li>
                                <a href="?page=detail_product" title="" class="thumbnail">
                                    <img src="<?php echo base_url(); ?>/admin/<?php echo $featured_img['image_url']; ?>">
                                </a>
                                <a href="?page=detail_product" title="" class="product-name"><?php echo $item['product_name'] ?></a>
                                <div class="price">
                                    <span class="new"><?php echo currency_format($item['product_price']); ?></span>
                                    <span class="old"><?php echo currency_format($item['product_initial']); ?></span>
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
            <div class="section" id="list-product-wp">
                <?php
                foreach ($data_product_cat as $item) {
                ?>
                    <div class="section-head">
                        <h3 class="section-title"><?php echo $item['category_name']; ?></h3>
                    </div>
                    <div class="section-detail">
                        <ul class="list-item clearfix">
                            <?php
                            $list_data_product = get_products_by_category_id($item['category_id']);
                            foreach ($list_data_product as $data) {
                                $featured_img = get_image_default($data['product_id']);

                            ?>
                                <li>
                                    <a href="?page=detail_product" title="" class="thumbnail">
                                        <img src="<?php echo base_url(); ?>/admin/<?php echo $featured_img['image_url']; ?>">
                                    </a>
                                    <a href="?page=detail_product" title="" class="product-name"><?php echo $data['product_name']; ?></a>
                                    <div class="price">
                                        <span class="new"><?php echo currency_format($data['product_price']); ?></span>
                                        <span class="old"><?php echo currency_format($data['product_initial']); ?></span>
                                    </div>
                                    <div class="action clearfix">
                                        <a href="<?php echo $data['url']; ?>" title="" class="buy-now">Mua ngay</a>
                                    </div>
                                </li>
                            <?php
                            }
                            ?>

                        </ul>
                    </div>
                <?php
                }
                ?>

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
                        foreach ($data_product_cat as $item) {
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
            <div class="section" id="selling-wp">
                <div class="section-head">
                    <h3 class="section-title">Sản phẩm bán chạy</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item">
                        <?php
                        foreach ($data_product_selling as $item) {
                            $featured_img = get_image_default($item['product_id']);
                        ?>
                            <li class="clearfix">
                                <a href="?page=detail_product" title="" class="thumb fl-left">
                                    <img src="<?php echo base_url(); ?>/admin/<?php echo $featured_img['image_url']; ?>" alt="">
                                </a>
                                <div class="info fl-right">
                                    <a href="?page=detail_product" title="" class="product-name"><?php echo $item['product_name']; ?></a>
                                    <div class="price">
                                        <span class="new"><?php echo currency_format($item['product_price']); ?></span>
                                        <span class="old"><?php echo currency_format($item['product_initial']); ?></span>
                                    </div>
                                    <a href="<?php echo $item['url']; ?>" title="" class="buy-now">Mua ngay</a>
                                </div>
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
// show_array($data_product_cat);
// show_array($data_products);
// show_array($data2);
// show_array($data_product_selling);
// show_array($data_sliders);
?>