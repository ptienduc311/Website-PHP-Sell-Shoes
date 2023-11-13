<?php
//Lấy dữ liệu từ database
function show_data_cat()
{
    $sql = "SELECT * FROM `post_category`";
    $list_data_page = db_fetch_array($sql);
    return $list_data_page;
}

//Thêm dữ liệu từ form vào database
function add_data_cat($data)
{
    return db_insert('post_category', $data);
}

//Cập nhật dữ liệu cat vào database
function update_data_cat($id, $data)
{ 
    return db_update('post_category', $data, "`category_id` = '$id'");
}

//Lấy dữ liệu theo category_id từ database
function show_data_cat_by_id($id)
{
    $sql = "SELECT * FROM `post_category` WHERE `category_id` = $id";
    $data = db_fetch_row($sql);
    return $data;
}

//Lấy dữ liệu danh mục cha từ database
function show_data_cat_by_parent_id()
{
    $sql = "SELECT * FROM `post_category` WHERE `parent_id` = 0";
    $list_data_page = db_fetch_array($sql);
    return $list_data_page;
}

//Hiển thị danh mục đa cấp
function data_tree($list_data, $parent_id = 0, $level = 0)
{
    $result = [];
    foreach ($list_data as  $item) {
        // $item['btn_delete'] = "?mod=post&action=deleteNameCat&id={$item['post_id']}";
        $item['btn_update'] = "?mod=post&action=updateCat&id={$item['category_id']}";
        $item['btn_delete'] = "?mod=post&action=deleteCat&id={$item['category_id']}";
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

//Thay đổi parent_id con 
function update_parent_id($id)
{
    global $conn;
    $sql = "UPDATE post_category SET parent_id = 0 WHERE parent_id = '$id'";
    if (mysqli_query($conn, $sql)) {
        return true;
    }
    return false;
}


//Kiểm tra xem có bài viết nào thuộc danh mục category_id không
function check_post_in_category($category_id)
{
    $sql = "SELECT * FROM `post` WHERE `category_id`=$category_id";
    if(db_num_rows($sql) > 0){
        return true;
    }
    return false;
}

//Xóa theo id
function delete_cat_by_id($id)
{
    global $conn;
    $sql = "DELETE FROM post_category WHERE category_id = '$id'";
    if (mysqli_query($conn, $sql)) {
        redirect("?mod=post&action=category");
    }
    return false;
}

//Cập nhật tất cả bài viết có $category_id = 3 (Danh mục khác)
function update_cateory_id_post($category_id)
{
    $sql = "UPDATE `post` SET `category_id` = 3 WHERE `category_id` = '$category_id'";
    db_query($sql);
}