<?php

//Thêm thông tin slider vào trang database
function add_data_slider($data)
{
    return db_insert('sliders', $data);
}

//Lấy ảnh slider từ bảng images
function get_image_slider($id){
    $sql = "SELECT `images`.`image_url` FROM `images` WHERE `images`.`image_id` = $id";
    return db_fetch_row($sql);
}

//Lấy thông tin tất cả slider
function get_all_sliders()
{
    $sql = "SELECT* FROM `sliders`";
    $data_sliders = db_fetch_array($sql);
    foreach($data_sliders as &$item){
        $item['slider_image'] = get_image_slider($item['image_id']);
        $item['btn_update'] = "?mod=slider&action=update&id={$item['slider_id']}";
        $item['btn_delete'] = "?mod=slider&action=delete&id={$item['slider_id']}";
    }
    unset($item);
    return $data_sliders;
}

//Lấy thông tin slider theo $id
function get_data_slider_by_id($id){
    $sql = "SELECT * FROM `sliders` WHERE `slider_id`=$id";
    $data_slider =  db_fetch_row($sql);
    $data_slider['slider_image'] = get_image_slider($data_slider['image_id']);
    return $data_slider;
}

//Cập nhật thông tin slider theo id
function update_data_slider($data, $id){
    return db_update('sliders', $data, "`slider_id` = $id");
}

