<?php
get_header();
$list_size = get_all_size();
?>

<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <div class="container-size-shoes">
                <h2>Quản lý Size Giày</h2>

                <form class="size-form" method="POST">
                    <input type="text" class="size-input" placeholder="Nhập size giày" name="size_name">
                    <input type="submit" class="add-button" name="btn_add" value="THÊM">
                </form>
                <p class="error"> <?php echo form_error('size_name'); ?></p>
                <ul class="size-list">
                    <?php 
                        foreach($list_size as $data){
                            ?>
                                <li class="size-list-item"><?php echo $data['size_name']; ?></li>
                            <?php
                        }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php   
get_footer();
// show_array($list_size);  
?>