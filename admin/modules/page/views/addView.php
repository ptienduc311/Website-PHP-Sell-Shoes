<?php
get_header();

?>

<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Thêm trang mới</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST">
                        <label for="title">Tiêu đề</label>
                        <input type="text" name="page_title" id="title">
                        <p class="error"> <?php echo form_error('page_title'); ?></p>
                        <label for="slug">Slug ( Friendly_url )</label>
                        <input type="text" name="page_slug" id="slug">
                        <p class="error"> <?php echo form_error('page_slug'); ?></p>
                        <label for="desc">Nội dung bài viết</label>
                        <textarea name="page_content" id="desc" class="ckeditor"></textarea>
                        <p class="error"> <?php echo form_error('page_content'); ?></p>
                        <div class="cart">
                            <div class="form-group">
                                <label for="">Trạng thái</label>
                                <div class="form_check">
                                    <input type="radio" name="page_status" value="published" id="published">
                                    <label for="published" style="display: inline-block;">Công khai</label>
                                </div>
                                <div class="form_check">
                                    <input type="radio" name="page_status" value="pending" id="pending">
                                    <label for="pending" style="display: inline-block;">Chờ duyệt</label>
                                </div>
                            </div>
                        </div>
                        <p class="error"> <?php echo form_error('page_status'); ?></p>
                        <button type="submit" name="btn_add" id="btn_add">Thêm mới</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();
?>