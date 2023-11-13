<?php


//Lấy tổng số lượng sản phẩm đặt theo $customer_id
function count_product_order($customer_id)
{
    $sql = "SELECT orders.product_quantity FROM `orders` INNER JOIN customers ON orders.customer_id = customers.customer_id WHERE orders.customer_id = '$customer_id'";
    return db_fetch_row($sql);
}

//Lấy danh sách khách hàng ở table customers
function get_data_customers()
{
    $sql = "SELECT * FROM `customers`";
    $data_customers = db_fetch_array($sql);
    foreach ($data_customers as &$item) {
        $item['num_product'] = count_product_order($item['customer_id']);
    }
    return $data_customers;
}

//Lấy họ tên khách hàng có customer_id = $id
function get_data_customer_by_id($id)
{
    $sql = "SELECT fullname FROM `customers` WHERE `customer_id`='$id'";
    return db_fetch_row($sql);
}

//Lấy thông tin orders
function get_data_orders($product_status = "")
{
    if (empty($product_status)) {
        $sql = "SELECT * FROM `orders`";
    } else {
        if ($product_status == "different") {
            $sql = "SELECT * FROM `orders` WHERE `status` != 'canceled' AND `status` != 'delivered'";
        } else {
            $sql = "SELECT * FROM `orders` WHERE `status` = '$product_status'";
        }
    }
    $data_orders = db_fetch_array($sql);
    foreach ($data_orders as &$item) {
        $item['fullname'] = get_data_customer_by_id($item['customer_id'])['fullname'];
        $item['url'] = "?mod=sell&action=detailOrder&id={$item['order_id']}";
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
    return $data_orders;
}

#--------CHI TIẾT ĐƠN HÀNG--------------
//Lấy thông tin khách hàng theo customer_id
function get_info_customer($customer_id)
{
    $sql = "SELECT * FROM `customers` WHERE `customer_id`=$customer_id";
    return db_fetch_row($sql);
}

//Lấy chi tiết đơn hàng qua $order_id
function get_order_detail($order_id)
{
    $sql = "SELECT * FROM `order_items` WHERE `order_id`=$order_id";
    $data_order = db_fetch_array($sql);
    return $data_order;
}
//Lấy thông tin orders qua order_id
function get_info_order($order_id)
{
    $sql = "SELECT * FROM `orders` WHERE `order_id` = $order_id";
    $data_order = db_fetch_row($sql);
    $data_order['url_bill'] = "?mod=sell&action=printBill&id={$data_order['order_id']}";
    return $data_order;
}

//Cập nhật trạng thái đơn hàng theo order_id
function update_order_status($order_id, $status)
{
    $sql = "UPDATE orders SET status = '$status' WHERE order_id = '$order_id'";
    db_query($sql);
}


#-----------Đếm số lượng---------------
//Đếm tổng số lượng đơn hàng
function count_all_orders()
{
    $sql = "SELECT * FROM `orders`";
    return db_num_rows($sql);
}
//Đếm số lượng đơn hàng đã hoàn thành
function count_finish_orders()
{
    $sql = "SELECT * FROM `orders` WHERE status = 'delivered'";
    return db_num_rows($sql);
}
//Đếm số lượng đơn hàng hủy
function count_cancelled_orders()
{
    $sql = "SELECT * FROM `orders` WHERE status = 'canceled'";
    return db_num_rows($sql);
}
//Đếm số lượng đơn hàng còn lại
function count_remain_orders()
{
    $sql = "SELECT * FROM `orders` WHERE status != 'canceled' AND status != 'delivered'";
    return db_num_rows($sql);
}

//Đếm số lượng khách hàng mua hàng
function count_customers()
{
    $sql = "SELECT * FROM `customers`";
    return db_num_rows($sql);
}
