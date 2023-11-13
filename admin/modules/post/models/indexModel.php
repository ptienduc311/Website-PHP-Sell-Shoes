<?php

//Lấy thông tin user qua username
function get_user_by_username($username)
{
    $item = db_fetch_row("select * from `users` where `username`='$username'");
    if (!empty($item)) {
        return $item;
    }
}

//Thêm dữ liệu từ form vào database
function add_data_post($data)
{
    return db_insert('post', $data);
}

//Lấy dữ liệu từ database
function show_data_post()
{
    $sql = "SELECT * FROM `post`";
    $list_data_page = db_fetch_array($sql);
    return $list_data_page;
}

//Lấy dữ liệu từ database với id
function get_data_by_id($id)
{
    $sql = "SELECT * FROM `post` WHERE `post_id` = '$id'";
    $list_data_post = db_fetch_row($sql);
    return $list_data_post;
}

//Lấy tên danh mục từ 2 bảng post và post_category theo $id
function get_name_cat($id)
{
    $sql = "SELECT post_category.category_name AS name_cat FROM post_category INNER JOIN post ON post_category.category_id = post.category_id WHERE post_id=$id";
    $name_cat = db_fetch_row($sql);
    return $name_cat;
}

//Cập nhật dữ liệu
function update_data_by_id($data, $id)
{
    $where = "`post_id`='$id'";
    db_update("post", $data, $where);
}



#----------------CATEGORY----------------
//Lấy dữ liệu từ post_category
function get_info_category(){
    $sql = "SELECT * FROM `post_category`";
    $name_cat =  db_fetch_array($sql);
    return $name_cat;
}

//Lấy dữ liệu từ post_category qua $category_id
function get_data_cat_by_id($category_id){
    $sql = "SELECT * FROM `post_category` WHERE `category_id` = $category_id";
    $data_cat =  db_fetch_row($sql);
    return $data_cat;
}

//Mảng này chủ yếu lấy dữ liệu level show lên danh mục sản phẩm
function data_category($list_data, $parent_id = 0, $level = 0)
{
    $result = [];
    foreach ($list_data as  $item) {
        if ($item['parent_id'] == $parent_id) {
            $item['level'] = $level;
            $result[] = $item;
            // unset($list_data[$item['id']]);
            $child = data_tree($list_data, $item['category_id'], $level + 1);
            $result = array_merge($result, $child);
        }
    }
    return $result;
}

#----------------ẢNH----------------
//Lấy ảnh từ bảng images qua image_id từ bảng post
function get_image($id){
    $sql = "SELECT image_url FROM `images` WHERE image_id = '$id'";
    return db_fetch_row($sql);
}

//Hiện ảnh lên giao diện
function show_img($url){
    return "<img src='$url'>";
}
