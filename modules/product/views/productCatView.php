<?php
get_header();
$id = $_GET['id'];
// $list_data_product = get_data_by_id($id);

$data_product_selling = get_selling_products(); 
$name_cat = get_name_category_by_id($id);
$list_name_cat = get_name_category();

#Phân trang
$total_row = count_rows($id);
$num_per_page = 8;
//Lấy số lượng bản ghi trên 1 trang
$num_page = ceil($total_row / $num_per_page);
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $num_per_page;

$count = get_count_product($start, $num_per_page, $id);
$list_data_product = get_number_product_by_id($start, $num_per_page, $id, $key);
?>

<div id="main-content-wp" class="clearfix category-product-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a class="path_active" href="" title=""><?php echo $name_cat['category_name']; ?></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section" id="list-product-wp">
                <div class="section-head clearfix">
                    <h3 class="section-title fl-left"><?php echo $name_cat['category_name']; ?></h3>
                    <div class="filter-wp fl-right">
                        <p class="desc"><?php echo "Hiển thị $count trên $total_row sản phẩm"; ?></p>
                        <div class="form-filter">
                            <form method="POST" action="">
                                <select name="select">
                                    <option value="">Sắp xếp</option>
                                    <option value="1">Từ A-Z</option>
                                    <option value="2">Từ Z-A</option>
                                    <option value="3">Giá cao xuống thấp</option>
                                    <option value="4">Giá thấp lên cao</option>
                                </select>
                                <button type="submit" name="btn_filter">Lọc</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <?php
                        foreach ($list_data_product as $item) {
                            $featured_img = get_image_default($item['product_id']);
                        ?>
                            <li>
                                <a href="?page=detail_product" title="" class="thumbnail">
                                    <img src="<?php echo base_url(); ?>/admin/<?php echo $featured_img['image_url']; ?>">
                                </a>
                                <a href="?page=detail_product" title="" class="product-name"><?php echo $item['product_name']; ?></a>
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
            <div class="section" id="paging-wp">
                <div class="section-detail">
                    <?php
                    echo get_pagging($num_page, $page, "?mod=product&action=productCat&id=$id");
                    ?>
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
// show_array($data_product_selling);
// show_array($list_data_product);
// echo "$total_row - $num_page";
// show_array($list_name_cat);
// echo $key;
?>