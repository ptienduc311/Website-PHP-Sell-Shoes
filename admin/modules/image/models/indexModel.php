<?php
//Thêm dữ liệu ảnh lên bảng images
function add_info_image($data)
{
    return db_insert('images', $data);
}

//Lấy id của ảnh qua điều kiện image_url
function get_id_image($data)
{
    $sql = "SELECT image_id FROM `images` WHERE image_url = '$data'";
    return db_fetch_row($sql);
}


