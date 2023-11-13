<?php
$id=$_GET['id'];
$data= get_data_by_id($id);
// show_array($data);
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
                    <h3 id="index" class="fl-left">Cập nhật trang</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST">
                    <label for="title">Tiêu đề</label>
                        <input type="text" name="page_title" id="title" value="<?php echo $data['page_title']; ?>">
                        <p class="error"> <?php echo form_error('page_title'); ?></p>
                        <label for="desc">Nội dung bài viết</label>
                        <textarea name="page_content" id="desc" class="ckeditor"><?php echo $data['page_content']; ?></textarea>
                        <p class="error"> <?php echo form_error('page_content'); ?></p>
                        <div class="cart">
                            <div class="form-group">
                                <label for="">Trạng thái</label>
                                <div class="form_check">
                                    <input type="radio" name="page_status" value="published" id="published" <?php if(isset($data['page_status']) && $data['page_status']=='published') echo "checked"; ?>>
                                    <label for="published" style="display: inline-block;">Công khai</label>
                                </div>
                                <div class="form_check">
                                    <input type="radio" name="page_status" value="pending" id="pending" <?php if(isset($data['page_status']) && $data['page_status']=='pending') echo "checked"; ?>>
                                    <label for="pending" style="display: inline-block;">Chờ duyệt</label>
                                </div>
                            </div>
                        </div>
                        <p class="error"> <?php echo form_error('page_status'); ?></p>
                        <button type="submit" name="btn_update" id="btn_update">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();
?>