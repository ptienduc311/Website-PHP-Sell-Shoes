<?php

//Lấy dữ liệu từ $_SESSION['cart']
function get_data_product_cart()
{
    if (isset($_SESSION['cart'])) {
        $list_buy = $_SESSION['cart']['buy'];
        foreach ($list_buy as &$data) {
            foreach ($data as &$item) {
                $item['url'] = "?mod=product&action=detail&id={$item['id']}";
            }
        }
        return $list_buy;
    }
}

//Trả về giá trị tổng tiền giỏ hàng
function get_total_cart()
{
    if (isset($_SESSION['cart'])) {
        return $_SESSION['cart']['info']['total'];
    }
}

//Trả về giá trị số lượng sản phẩm trong giỏ hàng
function get_num_order_cart()
{
    if (isset($_SESSION['cart'])) {
        return $_SESSION['cart']['info']['num_order'];
    }
}

//Thêm thông tin khách hàng vào bảng customers
function addCustomer($data){
    return db_insert('customers', $data);
}

//Thêm thông tin đặt hàng vào bảng orders
function addOrders($data){
    return db_insert('orders', $data);
}

//Thêm thông tin chi tiết về sản phẩm đặt vào bảng order_items
function addOrderItems($data){
    return db_insert('order_items', $data);
}

//Trừ số lượng sản phẩm trong giỏ hàng
function minus_product_by_id($stock_quantity, $product_id){
    $sql = "UPDATE products SET stock_quantity = stock_quantity - $stock_quantity WHERE product_id = '$product_id'";
    db_query($sql);
}