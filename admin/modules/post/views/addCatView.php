<?php
get_header();
$list_name_category = show_data_cat_by_parent_id();
?>

<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Thêm danh mục bài viết</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST" enctype="multipart/form-data">
                        <label for="category_name">Tên danh mục bài viết</label>
                        <input type="text" name="category_name" id="category_name">
                        <p class="error"> <?php echo form_error('category_name'); ?></p>
                        <label for="desc">Mô tả ngắn danh mục</label>
                        <textarea name="category_desc" id="desc" class="ckeditor"></textarea>
                        <p class="error"> <?php echo form_error('category_desc'); ?></p>
                        <div class="card">
                            <div class="form-group">
                                <label for="">Danh mục cha <span style="font-style: italic; opacity: 0.5;">(Không chọn mặc định là danh mục cha)</span></label>
                                <select class="form-control" id="" name="parent_id">
                                    <option value="">Chọn danh mục</option>
                                    <?php
                                    foreach ($list_name_category as $item) {
                                    ?>
                                        <option value="<?php echo $item['category_id']; ?>"><?php echo $item['category_name']; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <button type="submit" name="btn_add" id="btn_add">Thêm danh mục</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();
?>