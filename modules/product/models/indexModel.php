<?php
#Lấy tất cả danh sách sản phẩm có category_id = $id từ bảng products
// function get_data_by_id($id){
//     $sql = "SELECT * FROM `products` WHERE `category_id` = '$id'";
//     $data_product = db_fetch_array($sql);
//     foreach ($data_product as &$item) {
//         $item['url'] = "?mod=product&action=detail&id={$item['product_id']}";
//     }
//     return $data_product;
// }

#Lấy danh sách sản phẩm
// function get_all_product()
// {
//     $sql = "SELECT * FROM `products`";
//     return db_fetch_array($sql);
// }

//Lấy ảnh đại diện từ bảng images theo $id
function get_image_default($id)
{
    $sql = "SELECT images.image_url FROM `images` INNER JOIN `product_images` ON images.image_id = product_images.image_id WHERE product_images.product_id = $id AND product_images.pin = 1";
    return db_fetch_row($sql);
}

#-----------SẢN PHẨM THEO ID DANH MỤC-----------
//Lấy số lượng bản ghi theo điều kiện category_id = $id OK
function count_rows($id)
{
    $sql = "SELECT * FROM `products` WHERE `category_id` = '$id' AND NOT product_status = 'inactive'";
    return db_num_rows($sql);
}

//Lấy dữ liệu theo số bản ghi có category_id = $id từ bảng products theo lọc sắp xếp $key <productCat>
function get_number_product_by_id($start, $num_per_page, $id, $key = "")
{
    if (empty($key)) {
        $sql = "SELECT * FROM `products` WHERE `category_id` = '$id' AND NOT product_status = 'inactive' LIMIT {$start}, {$num_per_page}";
    } else {
        $sql = "SELECT * FROM `products` WHERE `category_id` = '$id' AND NOT product_status = 'inactive' ORDER BY $key  LIMIT {$start}, {$num_per_page}";
    }

    $data_product = db_fetch_array($sql);
    foreach ($data_product as &$item) {
        $item['url'] = "?mod=product&action=detail&id={$item['product_id']}";
    }
    return $data_product;
}
//Lấy tên danh mục theo $id từ bảng product_categories
function get_name_category_by_id($id)
{
    $sql = "SELECT `category_name` FROM `product_categories` WHERE `category_id` = $id";
    $name_cat = db_fetch_row($sql);
    return $name_cat;
}
//Lấy số lượng bản ghi lấy ra theo category_id
function get_count_product($start, $num_per_page, $id)
{
    $sql = "SELECT * FROM `products` WHERE `category_id` = '$id' AND NOT product_status = 'inactive' LIMIT {$start}, {$num_per_page}";

    return db_num_rows($sql);
}

#-----------SẢN PHẨM VÀ LỌC THEO GIÁ VÀ HÃNG-----------
//Lấy số lượng bản ghi theo điều kiện lọc giá và hãng
function count_rows_filter($price, $brand)
{
    #Nếu không có giá và hãng giày
    if (empty($price) && empty($brand)) {
        $sql = "SELECT * FROM `products`  WHERE NOT product_status = 'inactive' ";
    }
    #Nếu có giá, không hãng giày
    if (isset($price) && empty($brand)) {
        $sql = "SELECT * FROM `products` WHERE $price AND NOT product_status = 'inactive'";
    }
    #Nếu có hãng giày, không giá
    if (isset($brand) && empty($price)) {
        $category_id = implode(',', $brand);
        $sql = "SELECT * FROM `products` WHERE `category_id` in ($category_id) AND NOT product_status = 'inactive'";
    }
    #Nếu có giá và hãng giày
    if (!empty($price) && !empty($brand)) {
        $category_id = implode(',', $brand);
        $sql = "SELECT * FROM `products` WHERE $price AND `category_id` IN ($category_id) AND NOT product_status = 'inactive'";
    }

    return db_num_rows($sql);
}

//Lọc dữ liệu theo số bản ghi theo điều kiện giá và hãng từ bảng products
function get_number_product($start, $num_per_page, $price, $brand)
{
    #Nếu không có giá và hãng giày
    if (empty($price) && empty($brand)) {
        $sql = "SELECT * FROM `products`  WHERE NOT product_status = 'inactive' LIMIT {$start}, {$num_per_page}";
    }
    #Nếu có giá, không hãng giày
    if (isset($price) && empty($brand)) {
        $sql = "SELECT * FROM `products` WHERE $price AND NOT product_status = 'inactive' LIMIT {$start}, {$num_per_page}";
    }
    #Nếu có hãng giày, không giá
    if (isset($brand) && empty($price)) {
        $category_id = implode(',', $brand);
        $sql = "SELECT * FROM `products` WHERE `category_id` in ($category_id) AND NOT product_status = 'inactive' LIMIT {$start}, {$num_per_page}";
    }
    #Nếu có giá và hãng giày
    if (!empty($price) && !empty($brand)) {
        $category_id = implode(',', $brand);
        $sql = "SELECT * FROM `products` WHERE $price AND `category_id` IN ($category_id) AND NOT product_status = 'inactive' LIMIT {$start}, {$num_per_page}";
    }

    $data_product = db_fetch_array($sql);
    $result = [];
    foreach ($data_product as $item) {
        $item['url'] = "?mod=product&action=detail&id={$item['product_id']}";
        $result[] = $item;
    }
    return $result;
}

#Lọc số lượng bản ghi lấy ra theo điều kiện giá và hãng
function filter_count_product($start, $num_per_page, $price, $brand)
{
    #Nếu không có giá và hãng giày
    if (empty($price) && empty($brand)) {
        $sql = "SELECT * FROM `products`  WHERE NOT product_status = 'inactive' LIMIT {$start}, {$num_per_page}";
    }
    #Nếu có giá, không hãng giày
    if (isset($price) && empty($brand)) {
        $sql = "SELECT * FROM `products` WHERE $price AND NOT product_status = 'inactive' LIMIT {$start}, {$num_per_page}";
    }
    #Nếu có hãng giày, không giá
    if (isset($brand) && empty($price)) {
        $category_id = implode(',', $brand);
        $sql = "SELECT * FROM `products` WHERE `category_id` in ($category_id) AND NOT product_status = 'inactive' LIMIT {$start}, {$num_per_page}";
    }
    #Nếu có giá và hãng giày
    if (!empty($price) && !empty($brand)) {
        $category_id = implode(',', $brand);
        $sql = "SELECT * FROM `products` WHERE $price AND `category_id` IN ($category_id) AND NOT product_status = 'inactive' LIMIT {$start}, {$num_per_page}";
    }
    return db_num_rows($sql);
}

#------------SIZEBAR--------
//Lấy tất cả tên danh mục
function get_name_category()
{
    $sql = "SELECT * FROM `product_categories`";
    $name_cat = db_fetch_array($sql);
    return $name_cat;
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


//Lấy size theo từng sản phẩm
function get_size_product_by_id($id)
{
    $sql = "SELECT * FROM `size` INNER JOIN `product_size` ON `size`.size_id = `product_size`.size_id where `product_size`.product_id = $id";
    return db_fetch_array($sql);
}

//Cập nhật số lượng, tổng tiền giỏ hàng
function update_info_cart()
{
    $num_order = 0;
    $total = 0;

    foreach ($_SESSION['cart']['buy'] as $data) {
        foreach ($data as $item) {
            $num_order += $item['product_quantity'];
            $total += $item['sub_total'];
        }
    }
    $_SESSION['cart']['info'] = [
        'num_order' => $num_order,
        'total' => $total,
    ];
}


#-----CHI TIẾT SẢN PHẨM----------
//Lấy tất cả ảnh liên quan theo $id
function get_image_by_id($id)
{
    $sql = "SELECT images.image_url FROM `images` INNER JOIN `product_images` ON images.image_id = product_images.image_id WHERE product_images.product_id = $id";
    return db_fetch_array($sql);
}

//Lấy thông tin sản phẩm theo $id
function get_info_product_by_id($id)
{
    $sql = "SELECT * FROM `products` WHERE `product_id` = $id";
    $data_product = db_fetch_row($sql);
    $data_product['product_thumb'] = get_image_default($data_product['product_id']);
    return $data_product;
}

//Lấy thông tin sản phẩm có cùng category_id và trừ sản phẩm có product_ id bằng $id
function get_data_product_by_category_id($category_id, $id)
{
    $sql = "SELECT * FROM `products` WHERE `category_id` = $category_id AND  product_id != $id";
    $data_product_same_cat = db_fetch_array($sql);
    foreach ($data_product_same_cat as &$item) {
        $item['product_thumb'] = get_image_default($item['product_id']);
        $item['url'] = "?mod=product&action=detail&id={$item['product_id']}";
    }
    return $data_product_same_cat;
}