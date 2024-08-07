<?php

//Lấy dữ liệu trang từ bảng page
function get_data_page($slug){
    $sql = "SELECT * FROM `page` WHERE `page_slug` = '$slug'";
    return db_fetch_row($sql);
}

// //Lấy dữ liệu trang giới thiệu từ bảng page
// function get_data_introduce(){
//     $sql = "SELECT * FROM `page` WHERE `page_id` = 2";
//     return db_fetch_row($sql);
// }

//Lấy thông tin sản phẩm bán chạy
function get_selling_products()
{
    $sql = "SELECT * FROM `products` WHERE `is_selling` = 1  AND NOT product_status = 'inactive'";
    $data_product_selling = db_fetch_array($sql);

    //Xử lý cho chuyển trang chi tiết sản phẩm bán chạy
    $result = [];
    foreach ($data_product_selling as $item) {
        $item['url'] = "?mod=product&action=detail&id={$item['product_id']}";
        $result[] = $item;
    }

    return $result;
}

//Lấy ảnh đại diện từ bảng images
function get_image_default($id)
{
    $sql = "SELECT images.image_url FROM `images` INNER JOIN `product_images` ON images.image_id = product_images.image_id WHERE product_images.product_id = $id AND product_images.pin = 1;";
    return db_fetch_row($sql);
}