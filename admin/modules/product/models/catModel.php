<?php

#--------------DANH MỤC SẢN PHẨM-----------------
//Thêm dữ liệu danh mục từ form vào database
function add_data_cat($data)
{
    return db_insert('product_categories', $data);
}

//Lấy dữ liệu danh mục cha từ database
function show_data_cat_by_parent_id()
{
    $sql = "SELECT * FROM `product_categories` WHERE `parent_id` = 0";
    $list_data_cat = db_fetch_array($sql);
    return $list_data_cat;
}

//Lấy dữ liệu danh mục sản phẩm từ database
function get_all_data_cat(){
    $sql = "SELECT * FROM `product_categories`";
    $list_data_cat = db_fetch_array($sql);
    return $list_data_cat;
}

//Hiển thị danh mục đa cấp
function data_tree($list_data, $parent_id = 0, $level = 0)
{
    $result = [];
    foreach ($list_data as $item) {
        $item['btn_delete'] = "?mod=product&controller=cat&action=deleteCat&id={$item['category_id']}";
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

#--------------SIZE GIÀY-----------------
//Thêm size giày từ database
function add_data_size($data){
    return db_insert('size',$data);
}
//Lấy danh sách size giày
function get_all_size(){
    $sql = "SELECT * FROM `size`";
    $list_size = db_fetch_array($sql);
    return $list_size;
}
