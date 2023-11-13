<?php

function construct()
{
    load_model('index');
    load_model('cat');
    load('lib', 'validation');
}

function indexAction()
{
    global $key, $data, $product_status;
    if (isset($_POST['btn-search'])) {
        if (empty($_POST['content-search'])) {
            $key = NULL;
        } else {
            $key = $_POST['content-search'];
        }
    }
    if (isset($_POST['sm_action'])) {
        if (empty($_POST['status'])) {
            $product_status = NULL;
        } else {
            $product_status = $_POST['status'];
        }
    }
    $data = [
        'key'=>$key,
        'product_status'=>$product_status,
    ];
    load_view('index', $data);
}
function addAction()
{
    global $error, $product_id, $product_name, $product_code, $product_initial, $product_price, $size, $product_parameter, $product_detail, $stock_quantity, $is_featured, $is_selling, $category_id, $product_status;
    if (isset($_POST['btn_add'])) {
        #Valdation tên sản phẩm
        if (empty($_POST['product_name'])) {
            $error['product_name'] = "Vui lòng nhập tên sản phẩm";
        } else {
            $product_name = $_POST['product_name'];
        }
        #Validation mã sản phẩm
        if (empty($_POST['product_code'])) {
            $error['product_code'] = "Mã sản phẩm không được để trống";
        } else {
            $product_code = $_POST['product_code'];
        }
        #Validation giá ban đầu của sản phẩm
        if (empty($_POST['product_initial'])) {
            $error['product_initial'] = "Vui lòng nhập giá ban đầu của sản phẩm";
        } else {
            $product_initial = $_POST['product_initial'];
        }
        #Validation giá bán sản phẩm
        if (empty($_POST['product_price'])) {
            $error['product_price'] = "Vui lòng nhập giá bán của sản phẩm";
        } else {
            $product_price = $_POST['product_price'];
        }
        #Validation size giày
        if (empty($_POST['size'])) {
            $error['size'] = "Vui lòng chọn size giày";
        } else {
            $size = $_POST['size'];
        }
        #Validation mô tả sản phẩm
        if (empty($_POST['product_parameter'])) {
            $error['product_parameter'] = "Thông số sản phẩm không được để trống";
        } else {
            $product_parameter = $_POST['product_parameter'];
        }
        #Validation chi tiết sản phẩm
        if (empty($_POST['product_detail'])) {
            $error['product_detail'] = "Chi tiết sản phẩm không được để trống";
        } else {
            $product_detail = $_POST['product_detail'];
        }
        #Validation số lượng sản phẩm
        if (empty($_POST['stock_quantity'])) {
            $error['stock_quantity'] = "Vui lòng nhập số lượng sản phẩm trong kho";
        } else {
            $stock_quantity = $_POST['stock_quantity'];
        }
        #Validation danh mục sản phẩm
        if (empty($_POST['category_id'])) {
            $error['category_id'] = "Vui lòng chọn danh mục sản phẩm";
        } else {
            $category_id = $_POST['category_id'];
        }
        #Validation đánh dấu nổi bật
        if (empty($_POST['is_featured'])) {
            $error['is_featured'] = "Vui lòng chọn 1 trong 2";
        } else {
            $is_featured = $_POST['is_featured'];
        }
        #Validation đánh dấu bán chạy
        if (empty($_POST['is_selling'])) {
            $error['is_selling'] = "Vui lòng chọn 1 trong 2";
        } else {
            $is_selling = $_POST['is_selling'];
        }
        #Validation trạng thái
        if (empty($_POST['product_status'])) {
            $error['product_status'] = "Vui lòng chọn trạng thái";
        } else {
            $product_status = $_POST['product_status'];
        }

        if (empty($error)) {
            $data_product = [
                'product_name' => $product_name,
                'product_code' => $product_code,
                'product_initial' => $product_initial,
                'product_price' => $product_price,
                'product_parameter' => $product_parameter,
                'product_detail' => $product_detail,
                'stock_quantity' => $stock_quantity,
                'category_id' => $category_id,
                'is_featured' => $is_featured,
                'is_selling' => $is_selling,
                'product_status' => $product_status,
                'created_by' => $_SESSION['username']
            ];
            $product_id = add_data_products($data_product);
            // show_array($data_product);
            foreach ($size as $item) {
                $data_size = [
                    'product_id' => $product_id,
                    'size_id' => $item,
                ];
                add_data_product_size($data_size);
            }
            echo "<script>alert('Bạn đã thêm thành công')</script>";
        }
        // show_array($size);

        #Xử lý lấy id ảnh
        if (isset($_POST['thumbnail_id'])) {
            $list_id_img = explode(',', $_POST['thumbnail_id']);
        }
        #Đặt cờ hiệu
        $isFirstElement = true;
        foreach ($list_id_img as $image_id) {
            $data_product_img = [
                'product_id' => $product_id,
                'image_id' => $image_id,
                'pin' => $isFirstElement ? 1 : 0
            ];

            add_data_product_images($data_product_img);

            // Đánh dấu là đã qua phần tử đầu tiên
            $isFirstElement = false;
        }
    }
    load_view('add');
}

function updateAction()
{
    $id = $_GET['id'];
    global $error, $product_id, $product_name, $product_code, $product_initial, $product_price, $size, $product_parameter, $product_detail, $stock_quantity, $is_featured, $category_id, $product_status;
    if (isset($_POST['btn_update'])) {
        #Valdation tên sản phẩm
        if (empty($_POST['product_name'])) {
            $error['product_name'] = "Vui lòng nhập tên sản phẩm";
        } else {
            $product_name = $_POST['product_name'];
        }
        #Validation mã sản phẩm
        if (empty($_POST['product_code'])) {
            $error['product_code'] = "Mã sản phẩm không được để trống";
        } else {
            $product_code = $_POST['product_code'];
        }
        #Validation giá ban đầu của sản phẩm
        if (empty($_POST['product_initial'])) {
            $error['product_initial'] = "Vui lòng nhập giá ban đầu của sản phẩm";
        } else {
            $product_initial = $_POST['product_initial'];
        }
        #Validation giá bán sản phẩm
        if (empty($_POST['product_price'])) {
            $error['product_price'] = "Vui lòng nhập giá bán của sản phẩm";
        } else {
            $product_price = $_POST['product_price'];
        }
        #Validation mô tả sản phẩm
        if (empty($_POST['product_parameter'])) {
            $error['product_parameter'] = "Thông số sản phẩm không được để trống";
        } else {
            $product_parameter = $_POST['product_parameter'];
        }
        #Validation chi tiết sản phẩm
        if (empty($_POST['product_detail'])) {
            $error['product_detail'] = "Chi tiết sản phẩm không được để trống";
        } else {
            $product_detail = $_POST['product_detail'];
        }
        #Validation số lượng sản phẩm
        if (empty($_POST['stock_quantity'])) {
            $error['stock_quantity'] = "Vui lòng nhập số lượng sản phẩm trong kho";
        } else {
            $stock_quantity = $_POST['stock_quantity'];
        }
        #Validation danh mục sản phẩm
        if (empty($_POST['category_id'])) {
            $error['category_id'] = "Vui lòng chọn danh mục sản phẩm";
        } else {
            $category_id = $_POST['category_id'];
        }
        #Validation đánh dấu nổi bật
        if (empty($_POST['is_featured'])) {
            $error['is_featured'] = "Vui lòng chọn 1 trong 2";
        } else {
            $is_featured = $_POST['is_featured'];
        }
        #Validation trạng thái
        if (empty($_POST['product_status'])) {
            $error['product_status'] = "Vui lòng chọn trạng thái";
        } else {
            $product_status = $_POST['product_status'];
        }

        if (empty($error)) {
            $data_product = [
                'product_name' => $product_name,
                'product_code' => $product_code,
                'product_initial' => $product_initial,
                'product_price' => $product_price,
                'product_parameter' => $product_parameter,
                'product_detail' => $product_detail,
                'stock_quantity' => $stock_quantity,
                'category_id' => $category_id,
                'is_featured' => $is_featured,
                'product_status' => $product_status,
                'created_by' => $_SESSION['username']
            ];
            $product_id = update_data_by_id($data_product, $id);
            echo "<script>alert('Cập nhật sản phẩm thành công');</script>";
        }
    }
    load_view('update');
}


function deleteAction()
{
    load_view('delete');
}
