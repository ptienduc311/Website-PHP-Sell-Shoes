<?php
get_header();
$data_cat = get_all_data_cat();
$data_tree_cat = data_tree($data_cat);
$data_size = get_all_size();
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
                        <input type="text" name="product_name" id="product-name">
                        <p class="error"> <?php echo form_error('product_name'); ?></p>

                        <label for="product_code">Mã sản phẩm</label>
                        <input type="text" name="product_code" id="product_code">
                        <p class="error"> <?php echo form_error('product_code'); ?></p>

                        <label for="product_slug">Slug sản phẩm</label>
                        <input type="text" name="product_slug" id="product_slug">
                        <p class="error"> <?php echo form_error('product_slug'); ?></p>

                        <label for="product_initial">Giá ban đầu của sản phẩm</label>
                        <input type="text" name="product_initial" id="product_initial">
                        <p class="error"> <?php echo form_error('product_initial'); ?></p>

                        <label for="product_price">Giá bán sản phẩm</label>
                        <input type="text" name="product_price" id="product_price">
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
                        <textarea name="product_parameter" id="desc" class="ckeditor"></textarea>
                        <p class="error"> <?php echo form_error('product_parameter'); ?></p>

                        <label for="product_detail">Chi tiết sản phẩm</label>
                        <textarea name="product_detail" id="product_detail" class="ckeditor"></textarea>
                        <p class="error"> <?php echo form_error('product_detail'); ?></p>

                        <label for="stock_quantity">Số lượng sản phẩm</label>
                        <input type="text" name="stock_quantity" id="stock_quantity">
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
                                <option value="<?php echo $item['category_id']; ?>"><?php echo str_repeat('---', $item['level']) . $item['category_name']; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                        <p class="error"> <?php echo form_error('category_id'); ?></p>

                        <div style="display:flex;">
                            <div class="form-group" style="width: 30%;">
                                <label for="">Đánh dấu nổi bật</label>
                                <div class="form_check">
                                    <input type="radio" name="is_featured" value="1" id="yes_featured">
                                    <label for="yes_featured" style="display: inline-block;">Có</label>
                                </div>
                                <div class="form_check">
                                    <input type="radio" name="is_featured" value="2" id="no_featured">
                                    <label for="no_featured" style="display: inline-block;">Không</label>
                                </div>
                            <p class="error"> <?php echo form_error('is_featured'); ?></p>
                            </div>
                            <div class="form-group">
                                <label for="">Đánh dấu bán chạy</label>
                                <div class="form_check">
                                    <input type="radio" name="is_selling" value="1" id="yes_selling">
                                    <label for="yes_selling" style="display: inline-block;">Có</label>
                                </div>
                                <div class="form_check">
                                    <input type="radio" name="is_selling" value="2" id="no_selling">
                                    <label for="no_selling" style="display: inline-block;">Không</label>
                                </div>
                            <p class="error"> <?php echo form_error('is_selling'); ?></p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="">Trạng thái</label>
                            <div class="form_check">
                                <input type="radio" name="product_status" value="active" id="active">
                                <label for="active" style="display: inline-block;">Hoạt động</label>
                            </div>
                            <div class="form_check">
                                <input type="radio" name="product_status" value="inactive" id="inactive">
                                <label for="inactive" style="display: inline-block;">Tạm ngưng</label>
                            </div>
                            <div class="form_check">
                                <input type="radio" name="product_status" value="out_of_stock" id="out_of_stock">
                                <label for="out_of_stock" style="display: inline-block;">Hết hàng</label>
                            </div>
                        </div>
                        <p class="error"> <?php echo form_error('product_status'); ?></p>
                        <button type="submit" name="btn_add" id="btn_add">Thêm sản phẩm</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();
// show_array($_FILES);
// show_array($data_tree_cat);
?>