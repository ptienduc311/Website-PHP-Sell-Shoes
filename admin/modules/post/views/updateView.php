<?php
$id = $_GET['id'];
//Lấy dữ liệu từ tbl_post theo $id để đổ dữ liệu lên html
$data = get_data_by_id($id);
//Lấy dữ liệu danh sách bảng post_category
$list_data_cat = get_info_category();
//Cũng lấy dữ liệu từ bảng post_category nhưng thêm level đổ lên danh mục sản phẩm
$data_category = data_category($list_data_cat, 0);
$url_img = get_image($data['image_id']);
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
                    <h3 id="index" class="fl-left">Cập nhật bài viết</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST" enctype="multipart/form-data" id="form-upload-single">
                        <label for="title">Tiêu đề</label>
                        <input type="text" name="post_title" id="title" value="<?php echo $data['post_title']; ?>">
                        <p class="error"> <?php echo form_error('post_title'); ?></p>
                        <label for="slug">Slug ( Friendly_url )</label>
                        <input type="text" name="post_slug" id="slug" value="<?php echo $data['post_slug']; ?>">
                        <p class="error"> <?php echo form_error('post_slug'); ?></p>
                        <label for="post_excerpt">Mô tả ngắn</label>
                        <input type="text" name="post_excerpt" id="post_excerpt" value="<?php echo $data['post_excerpt']; ?>">
                        <p class="error"> <?php echo form_error('post_excerpt'); ?></p>
                        <label for="desc">Nội dung bài viết</label>
                        <textarea name="post_content" id="desc" class="ckeditor"><?php echo $data['post_content']; ?></textarea>
                        <p class="error"> <?php echo form_error('post_content'); ?></p>
                        <label>Hình ảnh</label>
                        <div id="uploadFile">
                            <input type="file" name="file" id="file" data-uri="?mod=image&action=upload">
                            <input id="thumbnail_url" type="hidden" name="thumbnail_url" value="" />
                            <input type="submit" name="Upload" value="Upload" id="upload_single_bt">
                            <div id="show_list_file"><?php echo show_img($url_img['image_url']); ?></div>

                        </div>
                        <!-- <img src="" title="" id="img_upload"> -->
                </div>
                <p class="error"> <?php echo form_error('thumbnail'); ?></p>
                <div class="card">

                    <div class="form-group">
                        <label for="">Danh mục bài viết</label>
                        <select class="form-control" id="" name="category_id">
                            <option value="">Chọn danh mục</option>
                            <?php
                            foreach ($data_category as $item) {
                            ?>
                                <option value="<?php echo $item['category_id']; ?>" <?php if (isset($data['category_id']) && $data['category_id'] == $item['category_id']) echo "selected = 'selected'"; ?>><?php echo str_repeat('---', $item['level']) . $item['category_name']; ?></option>
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
                                <input type="radio" name="post_status" value="published" id="published" <?php if (isset($data['post_status']) &&  $data['post_status'] == 'published') echo "checked = 'checked'"; ?>>
                                <label for="published" style="display: inline-block;">Công khai</label>
                            </div>
                            <div class="form_check">
                                <input type="radio" name="post_status" value="pending" id="pending" <?php if (isset($data['post_status']) &&  $data['post_status'] == 'pending') echo "checked = 'checked'"; ?>>
                                <label for="pending" style="display: inline-block;">Chờ duyệt</label>
                            </div>
                        </div>
                    </div>
                    <p class="error"> <?php echo form_error('post_status'); ?></p>
                </div>

                <button type="submit" name="btn_add" id="btn_add">Cập nhật</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

<?php
get_footer();
// show_array($data);
// show_array($list_data_cat);
// show_array($data_category);
?>