<?php
$list_data_post = show_data_post();
foreach($list_data_post as &$data){
    $data['btn_update'] = "?mod=post&action=update&id={$data['post_id']}";
    $data['btn_delete'] = "?mod=post&action=delete&id={$data['post_id']}";
}
unset($data);
// show_array($list_data_post);
// show_array($_SESSION);
?>

<?php
get_header();
?>

<div id="main-content-wp" class="list-post-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách bài viết</h3>
                    <a href="?mod=post&action=add" title="" id="add-new" class="fl-left">Thêm mới</a>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="table-responsive">
                        <table class="table list-table-wp">
                            <thead>
                                <tr>
                                    <td><span class="thead-text">STT</span></td>
                                    <td><span class="thead-text">Tiêu đề</span></td>
                                    <td><span class="thead-text">Danh mục</span></td>
                                    <td><span class="thead-text">Trạng thái</span></td>
                                    <td><span class="thead-text">Người tạo</span></td>
                                    <td><span class="thead-text">Thời gian</span></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $temp = 0;
                                foreach ($list_data_post as $data) {
                                    $name_cat = get_name_cat($data['post_id']);
                                    $temp++;
                                ?>
                                    <tr>
                                        <td><span class="tbody-text"><?php echo $temp; ?></h3></span>
                                        <td class="clearfix">
                                            <div class="tb-title fl-left">
                                                <a href="" title=""><?php echo $data['post_title']; ?></a>
                                            </div>
                                            <ul class="list-operation fl-right">
                                                <li><a href="<?php echo $data['btn_update']; ?>" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                <li><a href="<?php echo $data['btn_delete']; ?>" title="Xóa" class="delete"  onclick="return confirm('Bạn có chắc chắn muốn xóa không?')"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                            </ul>
                                        </td>
                                        <td><span class="tbody-text"><?php echo $name_cat['name_cat']; ?></span></td>
                                        <td><span class="tbody-text"><?php echo $data['post_status']; ?></span></td>
                                        <td><span class="tbody-text"><?php echo $data['created_by']; ?></span></td>
                                        <td><span class="tbody-text"><?php echo $data['created_at']; ?></span></td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();
// show_array($list_data_post);
?>