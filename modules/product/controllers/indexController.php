<?php
function construct()
{
    load_model('index');
    load('lib', 'validation');
}

function indexAction()
{
    global $price, $brand, $data ;
    if (isset($_POST['btn-filter'])) {
        if (empty($_POST['price'])) {
            $price = NULL;
        } else {
            if ($_POST['price'] == 1) {
                $price = "product_price <=500000";
            }
            if ($_POST['price'] == 2) {
                $price = "`product_price` BETWEEN 500000 AND 1000000";
            }
            if ($_POST['price'] == 3) {
                $price = "`product_price` BETWEEN 1000000 AND 2000000";
            }
            if ($_POST['price'] == 4) {
                $price = "`product_price` BETWEEN 2000000 AND 4000000";
            }
            if ($_POST['price'] == 5) {
                $price = "`product_price` >= 4000000";
            }
        }

        if (empty($_POST['brand'])) {
            $brand = NULL;
        } else {
            $brand = $_POST['brand'];
        }
    }
    $data = [
        "price" => $price,
        "brand" => $brand
    ];
    load_view('index', $data);
}

function productCatAction()
{
    global $key;
    if (isset($_POST['btn_filter'])) {
        // echo $select_value;
        if (empty($_POST['select'])) {
            $key = NULL;
        } else {
            if ($_POST['select'] == 1) {
                $key = "product_name ASC";
            }
            if ($_POST['select'] == 2) {
                $key = "product_name DESC";
            }
            if ($_POST['select'] == 3) {
                $key = "product_price DESC";
            }
            if ($_POST['select'] == 4) {
                $key = "product_price ASC";
            }
        }
        // echo $key;

    }
    $data['key'] = $key;
    load_view('productCat', $data);
}


function detailAction()
{
    // unset($_SESSION['cart']);
    $id = $_GET['id'];
    global $error, $num_order, $size;

    if (isset($_POST['btn_addCart'])) {
        $num_order = $_POST['num-order'];
        if (empty($_POST['size'])) {
            $error['size'] = "Bạn chưa chọn size giày";
        } else {
            $size = $_POST['size'];
        }
        // echo "$num_order - $size";
        if (empty($error)) {
            //Thêm sản phẩm vào $_SESSION['cart']
            $data_product = get_info_product_by_id($id);

            $product_quantity = $num_order;
            if (isset($_SESSION['cart']['buy']) && array_key_exists($id, $_SESSION['cart']['buy'])) {
                if (array_key_exists($size, $_SESSION['cart']['buy'][$id]))
                    $product_quantity = $_SESSION['cart']['buy'][$id][$size]['product_quantity'] + $product_quantity;
            }

            $_SESSION['cart']['buy'][$id][$size] = [
                'id' => $data_product['product_id'],
                'product_name' => $data_product['product_name'],
                'product_size' => $size,
                'product_code' => $data_product['product_code'],
                'product_thumb' => $data_product['product_thumb']['image_url'],
                'product_price' => $data_product['product_price'],
                'product_initial' => $data_product['product_initial'],
                'product_quantity' => $product_quantity,
                'sub_total' => $data_product['product_price'] * $product_quantity
            ];

            update_info_cart();
            redirect("?mod=cart&action=showCart");
        }
    }
    if (isset($_POST['btn_checkout'])) {
        $num_order = $_POST['num-order'];
        if (empty($_POST['size'])) {
            $error['size'] = "Bạn chưa chọn size giày";
        } else {
            $size = $_POST['size'];
        }
        // echo "$num_order - $size";
        if (empty($error)) {
            //Thêm sản phẩm vào $_SESSION['cart']
            $data_product = get_info_product_by_id($id);

            $product_quantity = $num_order;
            if (isset($_SESSION['cart']['buy']) && array_key_exists($id, $_SESSION['cart']['buy'])) {
                if (array_key_exists($size, $_SESSION['cart']['buy'][$id]))
                    $product_quantity = $_SESSION['cart']['buy'][$id][$size]['product_quantity'] + $product_quantity;
            }

            $_SESSION['cart']['buy'][$id][$size] = [
                'id' => $data_product['product_id'],
                'product_name' => $data_product['product_name'],
                'product_size' => $size,
                'product_code' => $data_product['product_code'],
                'product_thumb' => $data_product['product_thumb']['image_url'],
                'product_price' => $data_product['product_price'],
                'product_initial' => $data_product['product_initial'],
                'product_quantity' => $product_quantity,
                'sub_total' => $data_product['product_price'] * $product_quantity
            ];

            update_info_cart();
            redirect("?mod=checkout");
        }
    }
    load_view('detail');
}
