<?php
get_header();
$slug = $_GET['slug'];
$data_introduce = get_data_page($slug);
$data_product_selling = get_selling_products();
?>

<div id="main-content-wp" class="clearfix detail-blog-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a class="path_active" href="" title="">Giới thiệu</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section" id="detail-blog-wp">
                <div class="section-head clearfix">
                    <h3 class="section-title"><?php echo $data_introduce['page_title']; ?></h3>
                </div>
                <div class="section-detail">
                    <div class="detail">
                        <?php echo $data_introduce['page_content']; ?>
                    </div>
                </div>
            </div>
            <div class="section" id="social-wp">
                <div class="section-detail">
                    <div class="fb-like" data-href="" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
                    <div class="g-plusone-wp">
                        <div class="g-plusone" data-size="medium"></div>
                    </div>
                    <div class="fb-comments" id="fb-comment" data-href="" data-numposts="5"></div>
                </div>
            </div>
        </div>
        <div class="sidebar fl-left">
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
                    <a href="?page=detail_product" title="" class="thumb">
                        <img src="public/images/banner-shoes.jpg" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();
// show_array($data_introduce);
?>