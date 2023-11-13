<?php
get_header();
// $list_data_products = get_all_product();
$total_row = count_rows($key, $product_status);
$num_per_page = 6;
//Lấy số lượng bản ghi trên 1 trang
$num_page = ceil($total_row / $num_per_page);
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $num_per_page;
$count = get_count_product($start, $num_per_page, $key, $product_status);
$list_data_products = get_number_product($start, $num_per_page, $key, $product_status);
foreach ($list_data_products as &$data) {
    $data['btn_update'] = "?mod=product&action=update&id={$data['product_id']}";
    $data['btn_delete'] = "?mod=product&action=delete&id={$data['product_id']}";
}
unset($data);

?>

<div id="main-content-wp" class="list-product-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách sản phẩm</h3>
                    <a href="?mod=product&action=add" title="" id="add-new" class="fl-left">Thêm mới</a>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <ul class="post-status fl-left">
                            <li class="all">Hiển thị <span><?php echo $count; ?></span> trên <span><?php echo $total_row; ?><span> sản phẩm</li>
                        </ul>
                        <form method="POST" class="form-s fl-right">
                            <input type="text" name="content-search" id="s">
                            <input type="submit" name="btn-search" value="Tìm kiếm">
                        </form>
                    </div>
                    <div class="actions">
                        <form method="POST" action="" class="form-actions">
                            <select name="status">
                                <option value="">Tác vụ</option>
                                <option value="active">Công khai</option>
                                <option value="inactive">Không công khai</option>
                                <option value="out_of_stock">Hết hàng</option>
                            </select>
                            <input type="submit" name="sm_action" value="Lọc">
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table class="table list-table-wp">
                            <thead>
                                <tr>
                                    <td><span class="thead-text">STT</span></td>
                                    <td><span class="thead-text">Mã sản phẩm</span></td>
                                    <td><span class="thead-text">Hình ảnh</span></td>
                                    <td><span class="thead-text">Tên sản phẩm</span></td>
                                    <td><span class="thead-text">Giá</span></td>
                                    <td><span class="thead-text">Danh mục</span></td>
                                    <td><span class="thead-text">Trạng thái</span></td>
                                    <td><span class="thead-text">Người tạo</span></td>
                                    <td><span class="thead-text">Thời gian</span></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $temp = 0;
                                foreach ($list_data_products as $item) {
                                    $featured_img = get_image_default($item['product_id']);
                                    $temp++;
                                ?>
                                    <tr>
                                        <td><span class="tbody-text"><?php echo $temp; ?></h3></span>
                                        <td><span class="tbody-text"><?php echo $item['product_code']; ?></h3></span>
                                        <td>
                                            <div class="tbody-thumb">
                                                <img src="<?php echo $featured_img['image_url']; ?>" alt="">
                                            </div>
                                        </td>
                                        <td class="clearfix">
                                            <div class="tb-title fl-left">
                                                <a href="" title=""><?php echo $item['product_name']; ?></a>
                                            </div>
                                            <ul class="list-operation fl-right">
                                                <li><a href="<?php echo $item['btn_update']; ?>" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                <li><a href="<?php echo $item['btn_delete']; ?>" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                            </ul>
                                        </td>
                                        <td><span class="tbody-text"><?php echo currency_format($item['product_price']); ?></span></td>
                                        <td><span class="tbody-text"><?php echo $item['name_product']['category_name']; ?></span></td>
                                        <td><span class="tbody-text"><?php echo $item['product_status']; ?></span></td>
                                        <td><span class="tbody-text"><?php echo $item['created_by']; ?></span></td>
                                        <td><span class="tbody-text"><?php echo $item['created_at']; ?></span></td>
                                    </tr>
                                <?php
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>
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
    </div>
</div>

<?php
get_footer();
// show_array($list_data_products);
// show_array($featured_img);
?>