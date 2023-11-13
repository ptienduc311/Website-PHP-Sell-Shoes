<?php

//Lấy danh mục sản phẩm từ bảng product_categories
function get_data_product_cat()
{
    $sql = "SELECT * FROM `product_categories`";
    $data_product_cat = db_fetch_array($sql);
    return $data_product_cat;
}

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

//Lấy ảnh theo $id
function get_image_by_id($id)
{
    $sql = "SELECT `image_url` FROM `images` WHERE `image_id` = $id";
    return db_fetch_row($sql);
}

//Lấy thông tin từ bảng post theo $category_id
function get_data_post_by_category_id($category_id)
{
    $sql = "SELECT * FROM `post` WHERE `category_id` = $category_id";
    $data_post = db_fetch_array($sql);
    foreach ($data_post as &$item) {
        $item['product_thumb'] = get_image_by_id($item['image_id']);
        $item['url'] = "?mod=post&action=detail&id={$item['post_id']}";
    }
    return $data_post;
}

//Lấy nhiều thông tin danh mục post
function get_category_post()
{
    $sql = "SELECT * FROM `post_category`";
    return db_fetch_array($sql);
}

//Lấy 1 thông tin danh mục post
function get_category_post_once()
{
    $sql = "SELECT category_name FROM `post_category`";
    return db_fetch_row($sql);
}

//Lấy thông tin từ bảng post theo $id
function get_data_post_by_id($id)
{
    $sql = "SELECT * FROM `post` WHERE `post_id` = $id";
    $data_post = db_fetch_row($sql);
    $data_post['name_category'] = get_category_post_once($data_post['category_id']);
    return $data_post;
}
