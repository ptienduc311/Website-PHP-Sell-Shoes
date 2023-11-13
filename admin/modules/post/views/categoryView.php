<?php
get_header();

?>

<div id="main-content-wp" class="list-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách danh mục bài viết</h3>
                    <a href="?mod=post&action=addCat" title="" id="add-new" class="fl-left">Thêm mới</a>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="table-responsive">
                        <table class="table list-table-wp">
                            <thead>
                                <tr>
                                    <td><span class="thead-text">STT</span></td>
                                    <td><span class="thead-text">Tên danh mục</span></td>
                                    <td><span class="thead-text">Thứ tự</span></td>
                                    <td><span class="thead-text">Người tạo</span></td>
                                    <td><span class="thead-text">Thời gian tạo</span></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $temp = 0;
                                foreach ($list_cat as $item) {
                                    $temp++;
                                ?>
                                    <tr>
                                        <td><span class="tbody-text"><?php echo $temp; ?></h3></span>
                                        <td class="clearfix">
                                            <div class="tb-title fl-left">
                                                <a href="" title=""><?php echo str_repeat('---', $item['level']) . $item['category_name']; ?></a>
                                            </div>
                                            <ul class="list-operation fl-right">
                                                <li><a href="<?php echo $item['btn_update']; ?>" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                <li><a href="<?php echo $item['btn_delete']; ?>" title="Xóa" class="delete"  onclick="return confirm('Bạn có chắc chắn muốn xóa không?')"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                            </ul>
                                        </td>
                                        <td><span class="tbody-text"><?php echo $item['parent_id']; ?></span></td>
                                        <td><span class="tbody-text"><?php echo $item['created_by']; ?></span></td>
                                        <td><span class="tbody-text"><?php echo $item['created_at']; ?></span></td>
                                    </tr>

                                <?php
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail clearfix">
                </div>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();
// show_array($list_cat);
?>