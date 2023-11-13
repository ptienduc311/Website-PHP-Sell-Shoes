<?php
get_header();
$id = $_GET['id'];
$list_name_category = show_data_cat_by_parent_id();
$data = show_data_cat_by_id($id);
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
                        <label for="category_name">Tên danh mục</label>
                        <input type="text" name="category_name" id="category_name" value="<?php echo $data['category_name']; ?>">
                        <label for="desc">Mô tả ngắn danh mục</label>
                        <textarea name="category_desc" id="desc" class="ckeditor"><?php echo $data['category_desc']; ?></textarea>
                        <div class="card">
                            <div class="form-group">
                                <label for="">Danh mục cha <span style="font-style: italic; opacity: 0.5;">(Không chọn mặc định là danh mục cha)</span></label>
                                <select class="form-control" id="" name="parent_id">
                                    <option value="">Chọn danh mục</option>
                                    <?php
                                    echo $parent_id;
                                    foreach ($list_name_category as $item) {
                                    ?>
                                        <option value="<?php echo $item['category_id']; ?>" <?php if (isset($item['category_id'])) {
                                                                                                if ($data['parent_id'] != 0) {
                                                                                                    if ($item['category_id'] == $data['parent_id']) {
                                                                                                        echo "selected='selected'";
                                                                                                    }
                                                                                                } else {
                                                                                                    if ($item['category_id'] == $data['category_id']) {
                                                                                                        echo "selected='selected'";
                                                                                                    }
                                                                                                }
                                                                                            } ?>>
                                            <?php echo $item['category_name']; ?>
                                        </option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <button type="submit" name="btn_update" id="btn-submit">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();

?>