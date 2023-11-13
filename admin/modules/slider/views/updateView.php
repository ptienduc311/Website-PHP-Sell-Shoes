<?php
get_header();
$id=$_GET['id'];
$data_slider = get_data_slider_by_id($id);
?>

<div id="main-content-wp" class="add-cat-page slider-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Thêm Slider</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST" enctype="multipart/form-data" id="form-upload-single" >
                        <label for="slider_title">Tiêu đề slider</label>
                        <input type="text" name="slider_title" id="slider_title" value="<?php echo $data_slider['slider_title']; ?>">

                        <label for="slider_url">Link</label>
                        <input type="text" name="slider_url" id="slider_url" value="<?php echo $data_slider['slider_url']; ?>">
                        
                        <label for="display_order">Thứ tự</label>
                        <input type="text" name="display_order" id="display_order" value="<?php echo $data_slider['display_order']; ?>">
                        <p class="error"> <?php echo form_error('display_order'); ?></p>

                        <label>Hình ảnh</label>
                        <div id="uploadFile">
                            <input type="file" name="file" id="file" data-uri="?mod=image&action=upload">
                            <input id="thumbnail_id" type="hidden" name="thumbnail_id" value="" />
                            <input type="submit" name="Upload" value="Upload" id="upload_single_bt">
                            <div id="show_list_file">
                                <img src="<?php echo $data_slider['slider_image']['image_url']; ?>" alt="">
                            </div>
                        </div>
                        <div class="cart">
                            <div class="form-group">
                                <label for="">Trạng thái</label>
                                <div class="form_check">
                                    <input type="radio" name="slider_status" value="active" id="active" <?php if(isset($data_slider['slider_status']) && $data_slider['slider_status']=='active') echo "checked"; ?>>
                                    <label for="active" style="display: inline-block;">Công khai</label>
                                </div>
                                <div class="form_check">
                                    <input type="radio" name="slider_status" value="inactive" id="inactive" <?php if(isset($data_slider['slider_status']) && $data_slider['slider_status']=='inactive') echo "checked"; ?>>
                                    <label for="inactive" style="display: inline-block;">Chờ duyệt</label>
                                </div>
                            </div>
                        </div>
                        <p class="error"> <?php echo form_error('slider_status'); ?></p>
                        <button type="submit" name="btn_add" id="btn_add">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();
// show_array($data_slider);
?>