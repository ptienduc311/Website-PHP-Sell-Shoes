<?php

//Thêm dữ liệu vào database
function add_data_page($data){
    return db_insert('page', $data);
}

//Lấy dữ liệu từ database
function show_data_page(){
    $sql = "SELECT * FROM `page`";
    $list_data_page = db_fetch_array($sql);
    return $list_data_page;
}

//Lấy dữ liệu từ database với id
function get_data_by_id($id){
    $sql = "SELECT * FROM `page` WHERE `page_id` = '$id'";
    $list_data_page = db_fetch_row($sql);
    return $list_data_page;
}

//Cập nhật dữ liệu vào database với id
function update_data_by_id($data,$id){
    $where = "`page_id`='$id'";
    db_update("page", $data, $where);
}


