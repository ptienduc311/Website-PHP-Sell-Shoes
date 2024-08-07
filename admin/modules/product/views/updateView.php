<?php
get_header();
$id = $_GET['id'];
//Hiển thị danh mục sản phẩm đa cấp
$data_cat = get_all_data_cat();
$data_tree_cat = data_tree($data_cat);

//Lấy tất cả giá trị size
$data_size = get_all_size();

//Lấy thông tin sản phẩm theo $id
$info_product = get_info_product_by_id($id);

//Lấy thông tin size theo $id
$list_size = get_data_product_size_by_id($id);
?>

<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Thêm sản phẩm mới</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST" enctype="multipart/form-data" action="">
                        <label for="product-name">Tên sản phẩm</label>
                        <input type="text" name="product_name" id="product-name" value="<?php echo $info_product['product_name']; ?>">
                        <p class="error"> <?php echo form_error('product_name'); ?></p>

                        <label for="product_code">Mã sản phẩm</label>
                        <input type="text" name="product_code" id="product_code" value="<?php echo $info_product['product_code']; ?>">
                        <p class="error"> <?php echo form_error('product_code'); ?></p>

                        <label for="product_slug">Slug sản phẩm</label>
                        <input type="text" name="product_slug" id="product_slug" value="<?php echo $info_product['product_slug']; ?>">
                        <p class="error"> <?php echo form_error('product_slug'); ?></p>

                        <label for="product_initial">Giá gốc sản phẩm</label>
                        <input type="text" name="product_initial" id="product_initial" value="<?php echo $info_product['product_initial']; ?>">
                        <p class="error"> <?php echo form_error('product_initial'); ?></p>

                        <label for="product_price">Giá bán sản phẩm</label>
                        <input type="text" name="product_price" id="product_price" value="<?php echo $info_product['product_price']; ?>">
                        <p class="error"> <?php echo form_error('product_price'); ?></p>

                        <label style="display: block;">Size giày</label>
                        <?php
                        foreach ($data_size as $item) {
                        ?>
                            <label style="display: inline-block; margin-right: 10px;">
                                <input type="checkbox" name="size[]" value="<?php echo $item['size_id']; ?>" style="margin-right: 5px;"> <?php echo $item['size_name']; ?>
                            </label>
                        <?php
                        }
                        ?>
                        <p class="error"> <?php echo form_error('size'); ?></p>

                        <label for="product_parameter">Thông số sản phẩm</label>
                        <textarea name="product_parameter" id="desc" class="ckeditor"><?php echo $info_product['product_parameter']; ?></textarea>
                        <p class="error"> <?php echo form_error('product_parameter'); ?></p>

                        <label for="product_detail">Chi tiết sản phẩm</label>
                        <textarea name="product_detail" id="product_detail" class="ckeditor"><?php echo $info_product['product_detail']; ?></textarea>
                        <p class="error"> <?php echo form_error('product_detail'); ?></p>

                        <label for="stock_quantity">Số lượng sản phẩm</label>
                        <input type="text" name="stock_quantity" id="stock_quantity" value="<?php echo $info_product['stock_quantity']; ?>">
                        <p class="error"> <?php echo form_error('stock_quantity'); ?></p>

                        <label>Ảnh sản phẩm</label>
                        <div id="uploadFile">
                            <input type="file" name="images[]" id="file" multiple="">
                            <input id="thumbnail_id" type="hidden" name="thumbnail_id" value="" />
                            <input type="submit" name="Upload" value="Upload" id="upload_more_bt">
                            <div id="show_list_file"></div>
                        </div>

                        <label>Danh mục sản phẩm</label>
                        <select name="category_id">
                            <option value="">-- Chọn danh mục --</option>
                            <?php
                            foreach ($data_tree_cat as $item) {
                            ?>
                                <option value="<?php echo $item['category_id']; ?>" <?php if (isset($info_product['category_id']) && $info_product['category_id'] == $item['category_id']) echo "selected = 'selected'"; ?>><?php echo str_repeat('---', $item['level']) . $item['category_name']; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                        <p class="error"> <?php echo form_error('category_id'); ?></p>

                        <div class="form-group">
                            <label for="">Đánh dấu nổi bật</label>
                            <div class="form_check">
                                <input type="radio" name="is_featured" value="1" id="yes" <?php if (isset($info_product['is_featured']) && $info_product['is_featured'] == '1') echo "checked = 'checked'"; ?>>
                                <label for="yes" style="display: inline-block;">Có</label>
                            </div>
                            <div class="form_check">
                                <input type="radio" name="is_featured" value="2" id="no" <?php if (isset($info_product['is_featured']) && $info_product['is_featured'] == '2') echo "checked = 'checked'"; ?>>
                                <label for="no" style="display: inline-block;">Không</label>
                            </div>
                        </div>
                        <p class="error"> <?php echo form_error('is_featured'); ?></p>

                        <div class="form-group">
                            <label for="">Trạng thái</label>
                            <div class="form_check">
                                <input type="radio" name="product_status" value="active" id="active" <?php if (isset($info_product['product_status']) && $info_product['product_status'] == 'active') echo "checked = 'checked'"; ?>>
                                <label for="active" style="display: inline-block;">Hoạt động</label>
                            </div>
                            <div class="form_check">
                                <input type="radio" name="product_status" value="inactive" id="inactive" <?php if (isset($info_product['product_status']) && $info_product['product_status'] == 'inactive') echo "checked = 'checked'"; ?>>
                                <label for="inactive" style="display: inline-block;">Tạm ngưng</label>
                            </div>
                            <div class="form_check">
                                <input type="radio" name="product_status" value="out_of_stock" id="out_of_stock" <?php if (isset($info_product['product_status']) && $info_product['product_status'] == 'out_of_stock') echo "checked = 'checked'"; ?>>
                                <label for="out_of_stock" style="display: inline-block;">Hết hàng</label>
                            </div>
                        </div>
                        <p class="error"> <?php echo form_error('product_status'); ?></p>
                        <button type="submit" name="btn_update" id="btn_update">Cập nhật sản phẩm</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();
// show_array($info_product);
// show_array($data_tree_cat);
// show_array($list_size);
?>