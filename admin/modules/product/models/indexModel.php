<?php

//Thêm dữ liệu từ form vào database của bảng products
function add_data_products($data)
{
    return db_insert('products', $data);
}

//Lấy dữ liệu từ bảng products
function get_all_product()
{
    $sql = "SELECT * FROM `products`";
    $list_data_products = db_fetch_array($sql);
    return $list_data_products;
}

//Thêm dữ liệu từ form vào database của bảng product_images
function add_data_product_images($data)
{
    return db_insert('product_images', $data);
}

//Lấy thông tin sản phẩm từ bảng products qua id
function get_info_product_by_id($id)
{
    $sql = "SELECT * FROM `products` WHERE `product_id` = '$id'";
    $info_product = db_fetch_row($sql);
    return $info_product;
}

//Lấy tên danh mục sản phẩm theo $category_id
function get_name_category_by_id($category_id)
{
    $sql = "SELECT `category_name` FROM `product_categories` WHERE `category_id` = '$category_id'";
    $name_category = db_fetch_row($sql);
    return $name_category;
}

//Cập nhật dữ liệu
function update_data_by_id($data, $id)
{
    $where = "`product_id`='$id'";
    db_update("products", $data, $where);
}

#----------Product_size-------------
//Thêm dữ liệu vào bảng product_size
function add_data_product_size($data)
{
    return db_insert('product_size', $data);
}

//Lấy dữ liệu theo product_id từ bảng product_size
function get_data_product_size_by_id($id)
{
    $sql = "SELECT * FROM `product_size` WHERE `product_id` = '$id'";
    $list_size[] = db_fetch_array($sql);
    return $list_size;
}

//Cập nhật dữ liệu vào bảng product_size
function update_data_product_size($data, $id)
{
    // UPDATE `product_size` SET `size_id` = '2' WHERE `product_size`.`product_size_id` = 1;
    $where = "`product_size`.`product_id` = $id";
    db_update("product_size", $data, $where);
}


#----------ẢNH----------
//Lấy ảnh đại diện từ bảng images
function get_image_default($id)
{
    $sql = "SELECT images.image_url FROM images INNER JOIN product_images ON images.image_id = product_images.image_id WHERE product_images.product_id =$id AND product_images.pin=1";
    return db_fetch_row($sql);
}

//Lấy số lượng bản ghi
function count_rows($key="", $product_status="")
{
    if(empty($key) && empty($product_status)){
        $sql = "SELECT * FROM `products`";
    }
    else if (isset($product_status) && empty($key)) {
        $sql = "SELECT * FROM `products` WHERE `product_status` = '$product_status'";
    } 
    else if (isset($key) && empty($product_status)) {
        $sql = "SELECT * FROM `products` WHERE product_name LIKE '%$key%'";
    }
    return db_num_rows($sql);
}
//Lấy số lượng bản ghi lấy ra
function get_count_product($start, $num_per_page, $key = "", $product_status="")
{
    if(empty($key) && empty($product_status)){
        $sql = "SELECT * FROM `products`  LIMIT {$start}, {$num_per_page}";
    }
    else if (isset($product_status) && empty($key)) {
        $sql = "SELECT * FROM `products` WHERE `product_status` = '$product_status'  LIMIT {$start}, {$num_per_page}";
    } 
    else if (isset($key) && empty($product_status)) {
        $sql = "SELECT * FROM `products` WHERE product_name LIKE '%$key%'  LIMIT {$start}, {$num_per_page}";
    }
    return db_num_rows($sql);
}

//Lọc sản phẩm có product_name theo where like
function get_number_product($start, $num_per_page, $key = "", $product_status="")
{
    if(empty($key) && empty($product_status)){
        $sql = "SELECT * FROM `products` LIMIT {$start}, {$num_per_page}";
    }
    else if (isset($product_status) && empty($key)) {
        $sql = "SELECT * FROM `products` WHERE `product_status` = '$product_status'  LIMIT {$start}, {$num_per_page}";
    } 
    else if (isset($key) && empty($product_status)) {
        $sql = "SELECT * FROM `products` WHERE product_name LIKE '%$key%'  LIMIT {$start}, {$num_per_page}";
    }
    

    $data_product = db_fetch_array($sql);
    foreach($data_product as &$item){
        $item['name_product'] = get_name_category_by_id($item['category_id']);
    }
    // unset($item);
    return $data_product;
}

#-----------Xóa 1 Sản Phẩm (Xóa bảng trung gian đầu tiên)---------------
//B1: Lấy được product_image_id ở bảng product_images
function get_data_product_image_by_product_id($product_id){
    $sql = "SELECT * FROM `product_images` WHERE product_id={$product_id}";
    return db_fetch_array($sql);
}

//B2: Lấy tất cả ảnh có điều kiện là image_id
function get_all_imgs($image_id){
    $sql = "SELECT * FROM `images` WHERE `image_id` = $image_id";
    return db_fetch_array($sql);
}

//B3: Lấy thông tin tất cả size của sản phẩm từ bảng product_size by product_id
function get_sizes_by_prouduct_id($product_id){
    $sql = "SELECT * FROM `product_size` WHERE `product_id` = '$product_id'";
    return db_fetch_array($sql);
}

//Xóa bảng product_images theo product_image_id
function delete_product_images($product_image_id){
    $where = "`product_image_id` = $product_image_id";
    db_delete('product_images', $where);
}

//Xóa bảng product_size theo product_size_id
function delete_product_size($product_size_id){
    $where = "`product_size_id` = $product_size_id";
    db_delete('product_size', $where);
}

//Xóa bảng images theo image_id
function delete_images($image_id){
    $where = "`image_id` = $image_id";
    db_delete('images', $where);
}

//Xóa bảng products theo product_id
function delete_product($product_id){
    $where = "`product_id` = '$product_id'";
    db_delete('products', $where);
}

//Xóa file trong uploads
function delete_file($path){
    unlink($path);
}