<?php
get_header();
$data_product_cat = get_data_product_cat();
$data_product_selling = get_selling_products();

$data_cat_post = get_category_post();
?>

<div id="main-content-wp" class="home-page clearfix">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a class="path_active" href="" title="">Blog</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section" id="list-blog-wp">
                <?php
                foreach ($data_cat_post as $data) {
                    $data_post = get_data_post_by_category_id($data['category_id']);
                ?>
                    <div class="section-head clearfix">
                        <h3 class="section-title"><?php echo $data['category_name']; ?></h3>
                    </div>
                    <div class="section-detail">
                        <ul class="list-item">
                            <?php
                            foreach ($data_post as $item) {
                            ?>
                                <li class="clearfix">
                                    <!-- <a href="<?php echo $item['url']; ?>" title="" class="thumb fl-left">
                                        <img src="<?php echo base_url(); ?>/admin/<?php echo $item['product_thumb']['image_url']; ?>" alt="">
                                    </a>
                                    <div class="info fl-right">
                                        <a href="<?php echo $item['url']; ?>" title="" class="title"><?php echo $item['post_title']; ?></a>
                                        <span class="create-date"><?php echo $item['created_at']; ?></span>
                                        <p class="desc"><?php echo $item['post_excerpt'] ?></p>
                                    </div> -->
                                    <a href="bai-viet/<?php echo create_slug($item['post_slug']); ?>.html" title="" class="thumb fl-left">
                                        <img src="<?php echo base_url(); ?>admin/<?php echo $item['product_thumb']['image_url']; ?>" alt="">
                                    </a>
                                    <div class="info fl-right">
                                        <a href="bai-viet/<?php echo $item['post_slug']; ?>.html" title="" class="title"><?php echo $item['post_title']; ?></a>
                                        <span class="create-date"><?php echo $item['created_at']; ?></span>
                                        <p class="desc"><?php echo $item['post_excerpt'] ?></p>
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
// show_array($data_cat_post);
// show_array(get_data_post_by_category_id(1));
?>