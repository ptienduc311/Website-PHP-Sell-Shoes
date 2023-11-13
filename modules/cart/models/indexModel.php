<?php

//Lấy dữ liệu từ $_SESSION['cart']
function get_data_product_cart()
{
    if (isset($_SESSION['cart'])) {
        $list_buy = $_SESSION['cart']['buy'];
        foreach ($list_buy as &$data) {
            foreach ($data as &$item) {
                $item['btn_delete'] = "?mod=cart&action=deleteCart&id={$item['id']}&size={$item['product_size']}";
                $item['url'] = "?mod=product&action=detail&id={$item['id']}";
            }
        }
        // unset($data);
        // unset($item);
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

//Xóa sản phẩm khỏi giỏ hàng theo $id và $product_size
function delete_cart($id, $size)
{
    if (isset($_SESSION['cart'])) {
        if (!empty($id) && !empty($size)) {
            if (count($_SESSION['cart']['buy']) == 1) {
                if (count($_SESSION['cart']['buy'][$id]) > 1) {
                    unset($_SESSION['cart']['buy'][$id][$size]);
                    update_info_cart();
                }
                else if (count($_SESSION['cart']['buy'][$id]) == 1) {
                    unset($_SESSION['cart']);
                }
            }
            else if (count($_SESSION['cart']['buy']) > 1) {
                if (count($_SESSION['cart']['buy'][$id]) > 1) {
                    unset($_SESSION['cart']['buy'][$id][$size]);
                    update_info_cart();
                }
                else if (count($_SESSION['cart']['buy'][$id]) == 1) {
                    unset($_SESSION['cart']['buy'][$id]);
                    update_info_cart();
                }
            }
        } else {
            unset($_SESSION['cart']);
        }
    }
}
