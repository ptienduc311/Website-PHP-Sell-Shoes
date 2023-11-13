<?php
#-------------PRODUCT_CATEGORIES-----------------
//Lấy danh mục sản phẩm từ bảng product_categories
function get_data_product_cat()
{
    $sql = "SELECT * FROM `product_categories`";
    $data_product_cat = db_fetch_array($sql);
    return $data_product_cat;
}

//Lấy ảnh đại diện từ bảng images
function get_image_default($id)
{
    $sql = "SELECT images.image_url FROM `images` INNER JOIN `product_images` ON images.image_id = product_images.image_id WHERE product_images.product_id = $id AND product_images.pin = 1;";
    return db_fetch_row($sql);
}

#-------------PRODUCTS-----------------
//Lấy thông tin sản phẩm theo category_id
function get_products_by_category_id($category_id)
{
    $sql = "SELECT * FROM `products` WHERE `category_id` = $category_id";
    $data_product = db_fetch_array($sql);
    $result=[];
    foreach ($data_product as $item) {
        $item['url'] = "?mod=product&action=detail&id={$item['product_id']}";
        $result[] = $item;
    }
    return $result;
}

//Lấy thông tin sản phẩm bán chạy
function get_selling_products()
{
    $sql = "SELECT * FROM `products` WHERE `is_featured` = 1";
    $data_product_selling = db_fetch_array($sql);

    //Xử lý cho chuyển trang chi tiết sản phẩm bán chạy
    $result = [];
    foreach ($data_product_selling as $item) {
        $item['url'] = "?mod=product&action=detail&id={$item['product_id']}";
        $result[] = $item;
    }

    return $result;
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
    }
    unset($item);
    return $data_sliders;
}
