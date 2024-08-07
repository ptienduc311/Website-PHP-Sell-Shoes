<?php

$id = $_GET['id'];
#------LẤY THÔNG TIN-----------
#Lấy thông tin sản phẩm
$data_product = get_info_product_by_id($id);
#Lấy thông tin bảng trung gian product_image
$data_product_images = get_data_product_image_by_product_id($data_product['product_id']);
#Lấy product_image_id
$data_product_img_id = [];
foreach ($data_product_images as  $item) {
    $data_product_img_id[] = $item['product_image_id'];
}
#Lấy image_id
$image_id = [];
foreach ($data_product_images as $item) {
    $image_id[] = $item['image_id'];
}
#Lấy dữ liệu ảnh từ image_id
$data_img = [];
foreach ($image_id as $item) {
    $data_img[] = get_all_imgs($item);
}
#Lấy image_url
$data_img_urls = [];
foreach ($data_img as $item) {
    $data_img_urls[] = $item[0]['image_url'];
}
#Lấy size sản phẩm
$data_size_id = [];
$list_data_sizes = get_sizes_by_prouduct_id($data_product['product_id']);
foreach ($list_data_sizes as $item) {
    $data_size_id[] = $item['product_size_id'];
}

#-------XÓA--------------
foreach ($data_product_img_id as $item) {
    delete_product_images($item);
}
foreach ($data_size_id as $item) {
    delete_product_size($item);
}
foreach ($image_id as $item) {
    delete_images($item);
}
foreach ($data_img_urls as $item) {
    delete_file($item);
}
delete_product($id);
redirect('?mod=product');

// show_array($data_product);
// echo "<hr>";
// show_array($data_product_images);
// echo "<hr>";
// show_array($data_product_img_id);
// echo "<hr>";
// show_array($image_id);
// echo "<hr>";
// show_array($data_img);
// echo "<hr>";
// show_array($data_img_urls);
// echo "<hr>";
// show_array($list_data_sizes);
// echo "<hr>";
// show_array($data_size_id);