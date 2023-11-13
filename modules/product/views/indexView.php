<?php
get_header();
$list_name_cat = get_name_category();
// $list_product = get_all_product();

#Phân trang
$total_row = count_rows_filter($price, $brand);
$num_per_page = 12;
//Lấy số lượng bản ghi trên 1 trang
$num_page = ceil($total_row / $num_per_page);
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $num_per_page;

$count = filter_count_product($start, $num_per_page, $price, $brand);
$list_data_product = get_number_product($start, $num_per_page, $price, $brand);


// echo $price;
// show_array($brand);
// if(isset($brand)){
//     $category_id = implode(',', $brand);
// echo $category_id;
// }

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
                        <a class="path_active" href="" title="">Sản phẩm</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section" id="list-product-wp">
                <div class="section-head clearfix">
                    <h3 class="section-title fl-left">Danh sách sản phẩm</h3>
                    <div class="filter-wp fl-right">
                        <p class="desc"><?php echo "Hiển thị $count trên $total_row sản phẩm"; ?></p>
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
                    echo get_pagging($num_page, $page, "?mod=product");
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
            <div class="section" id="filter-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Bộ lọc</h3>
                </div>
                <div class="section-detail">
                    <form method="POST" action="">
                        <table>
                            <thead>
                                <tr>
                                    <td colspan="2">Giá</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="radio" name="price" value="1"  class="filter"></td>
                                    <td>Dưới 500.000đ</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="price" value="2"  class="filter"></td>
                                    <td>500.000đ - 1.000.000đ</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="price" value="3"  class="filter"></td>
                                    <td>1.000.000đ - 2.000.000đ</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="price" value="4"  class="filter"></td>
                                    <td>2.000.000đ - 4.000.000đ</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="price" value="5"  class="filter"></td>
                                    <td>Trên 4.000.000đ</td>
                                </tr>
                            </tbody>
                        </table>
                        <table>
                            <thead>
                                <tr>
                                    <td colspan="2">Hãng giày</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($list_name_cat as $item) {
                                ?>
                                    <tr>
                                        <td><input type="checkbox" name="brand[]" value="<?php echo $item['category_id']; ?>" class="filter"></td>
                                        <td><?php echo $item['category_name']; ?></td>
                                    </tr>
                                <?php
                                }
                                ?>

                            </tbody>
                        </table>
                        <button class="btn-filter" name="btn-filter">Lọc</button>
                    </form>
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
// show_array($list_name_cat);
// show_array($list_product);
// show_array($list_data_product);
?>