<?php
get_header();
$data_product_cat = get_data_product_cat();
$data_product_selling = get_selling_products();

$id=$_GET['id'];
$data_post = get_data_post_by_id($id);
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
                        <a href="?mod=post" title="">Blog</a>
                    </li>
                    <li>
                        <a  class="path_active" href="" title=""><?php echo $data_post['name_category']['category_name']; ?></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section" id="list-blog-wp">
                <h2 class="section-title"><?php echo $data_post['post_title']; ?></h2>
                <p><?php echo $data_post['post_content']; ?></p>
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
// show_array($data_post);
?>