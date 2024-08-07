<?php
$list_cat_data = show_data_cat();
$list_cat = data_tree($list_cat_data, 0);
?>

<?php
get_header();
?>

<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Thêm bài viết mới</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST" enctype="multipart/form-data" id="form-upload-single">
                        <label for="title">Tiêu đề</label>
                        <input type="text" name="post_title" id="title">
                        <p class="error"> <?php echo form_error('post_title'); ?></p>
                        <label for="slug">Slug ( Friendly_url )</label>
                        <input type="text" name="post_slug" id="slug">
                        <p class="error"> <?php echo form_error('post_slug'); ?></p>
                        <label for="post_excerpt">Mô tả ngắn</label>
                        <input type="text" name="post_excerpt" id="post_excerpt">
                        <label for="desc">Nội dung bài viết</label>
                        <textarea name="post_content" id="desc" class="ckeditor"></textarea>
                        <p class="error"> <?php echo form_error('post_content'); ?></p>
                        <label>Hình ảnh</label>
                        <div id="uploadFile">
                            <input type="file" name="file" id="file" data-uri="?mod=image&action=upload">
                            <input id="thumbnail_id" type="hidden" name="thumbnail_id" value="" />
                            <input type="submit" name="Upload" value="Upload" id="upload_single_bt">
                            <div id="show_list_file"></div>
                        </div>
                        <p class="error"> <?php echo form_error('file'); ?></p>
                        <div class="card">
                            <div class="form-group">
                                <label for="">Danh mục bài viết</label>
                                <select class="form-control" id="" name="category_id">
                                    <option value="">Chọn danh mục</option>
                                    <?php
                                    foreach ($list_cat as $item) {
                                    ?>
                                        <option value="<?php echo $item['category_id']; ?>"><?php echo str_repeat('---', $item['level']) . $item['category_name']; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <p class="error"> <?php echo form_error('category_id'); ?></p>
                            <div class="cart">
                                <div class="form-group">
                                    <label for="">Trạng thái</label>
                                    <div class="form_check">
                                        <input type="radio" name="post_status" value="published" id="published">
                                        <label for="published" style="display: inline-block;">Công khai</label>
                                    </div>
                                    <div class="form_check">
                                        <input type="radio" name="post_status" value="pending" id="pending">
                                        <label for="pending" style="display: inline-block;">Chờ duyệt</label>
                                    </div>
                                </div>
                            </div>
                            <p class="error"> <?php echo form_error('post_status'); ?></p>
                        </div>

                        <button type="submit" name="btn-submit" id="btn-submit">Thêm mới</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<?php
get_footer();
?>