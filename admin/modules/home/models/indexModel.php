<?php
//'pending','processing','shipped','delivered','canceled'

//Lấy thông tin user qua username
function get_user_by_username($username)
{
    $item = db_fetch_row("select * from `users` where `username`='$username'");
    if (!empty($item)) {
        return $item;
    }
}

//Lấy số lượng đơn hàng đã giao thành công ở orders
function get_count_deliver()
{
    $sql = "SELECT * FROM `orders` WHERE `status` = 'delivered'";
    return db_num_rows($sql);
}

//Lấy số lượng đơn hàng đang xử lý ở `orders`
function get_count_processing()
{
    $sql = "SELECT * FROM `orders` WHERE status NOT IN ('canceled', 'delivered')";
    return db_num_rows($sql);
}

//Lấy số lượng đơn hàng hủy ở `orders`
function get_count_cancel()
{
    $sql = "SELECT * FROM `orders` WHERE `status` = 'canceled'";
    return db_num_rows($sql);
}

//Lấy tổng số sản phẩm trong kho
function count_product()
{
    $sql = "SELECT SUM(stock_quantity) AS total_stock FROM products";
    return db_fetch_row($sql);
}

#-----Đổ dữ liệu table--------
//Lấy tên khách hàng từ bảng customers
function get_customer_name($customer_id)
{
    $sql = "SELECT `fullname` FROM customers WHERE `customer_id`=$customer_id";
    return db_fetch_row($sql);
}
//Lấy thông tin đơn hàng từ bảng orders
function get_order_info()
{
    $sql = "SELECT * FROM orders ORDER BY order_date DESC LIMIT 5";
    $data_order = db_fetch_array($sql);
    foreach ($data_order as &$item) {
        $item['url']  = "?mod=sell&action=detailOrder&id={$item['order_id']}";
        $item['name_customer'] = get_customer_name($item['customer_id'])['fullname'];
        if ($item['status'] == "pending") {
            $item['name_status'] = "Chưa xử lý";
        }
        if ($item['status'] == "processing") {
            $item['name_status'] = "Đang xử lý";
        }
        if ($item['status'] == "shipped") {
            $item['name_status'] = "Đang vận chuyển";
        }
        if ($item['status'] == "delivered") {
            $item['name_status'] = "Hoàn thành";
        }
        if ($item['status'] == "canceled") {
            $item['name_status'] = "Đã bị hủy";
        }
    }
    return $data_order;
}
