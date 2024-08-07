<?php

function construct()
{
    load_model('index');
    load('lib', 'email');
}


function orderAction()
{
    global $data, $product_status;
    if (isset($_POST['sm_action'])) {
        if (empty($_POST['status'])) {
            $product_status = NULL;
        } else {
            $product_status = $_POST['status'];
        }
        // echo $product_status;
    }
    $data['product_status'] = $product_status;
    load_view('order', $data);
}

function customerAction()
{
    load_view('customer');
}

function detailOrderAction()
{
    $id = $_GET['id'];
    global $status;
    if (isset($_POST['btn-change'])) {
        if (isset($_POST['select-status'])) {
            if ($_POST['select-status'] == 1) {
                $status = "pending";
            }
            if ($_POST['select-status'] == 2) {
                $status = "processing";
            }
            if ($_POST['select-status'] == 3) {
                $status = "shipped";
            }
            if ($_POST['select-status'] == 4) {
                $status = "delivered";
            }
            if ($_POST['select-status'] == 5) {
                $status = "canceled";
            }
        }
        update_order_status($id, $status);
    }
    load_view('detailOrder');
}

function printBillAction()
{
    $id = $_GET['id'];
    $data_order = get_info_order($id);
    $info_customer = get_info_customer($data_order['customer_id']);
    $order_detail = get_order_detail($id);
    if (isset($_POST['btn-send'])) {
        #-------------GỬI EMAIL KHI ĐẶT HÀNG THÀNH CÔNG---------------
        $content = '
        <!DOCTYPE html>
        <html lang="en">
        
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Order Success - MEN CLOTHES</title>
            <style>
                body {font-family: Arial, sans-serif;margin: 0;padding: 20px;background-color: #f4f4f4;text-align: center;}
                h1,h2 {margin-top: 0;font-size: 16px;}
                .success-message {background-color: #ffffff;color: #000000;padding: 20px;border-radius: 5px;box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);text-align: left;max-width: 800px;margin: auto;}
                .info-order {border-bottom: 2px solid #8d7a7a; }
                .info-order p {margin: 0;color: red;font-weight: bold;padding: 5px 0;}
                .customer {display: flex;justify-content: space-between;border-bottom: 2px solid #8d7a7a;margin-bottom: 10px;}
                .customer .info-customer{margin-right: 20px;}
                .customer p>strong {font-size: 14px;}
                table {width: 100%;border-collapse: collapse;margin-bottom: 20px;}
                th,td {border: 1px solid #d6d6d6;padding: 10px;text-align: left;background-color: #e5e5e5;}
                th {background-color: #e40c0c;color: white;}
                th {text-align: center;text-transform: uppercase;}
                .total-row {font-weight: bold;}
                .order-details span {font-weight: 600;color: red;}
            </style>
        </head>
        
        <body>
        
            <div class="success-message">
                <h1>Xin chào ' . $info_customer['fullname'] . ',</h1>
                <p>Đơn hàng #' . $data_order['code_order'] . ' của bạn đã được đặt thành công ngày ' .date("Y-m-d", strtotime($data_order['order_date'])). '</p>
        
                <div class="info-order">
                    <p>MÃ ĐƠN HÀNG: #<span>' . $data_order['code_order'] . '</span></p>
                    <p>THỜI GIAN ĐẶT: <span>' . date("Y-m-d", strtotime($data_order['order_date'])) . '</span></p>
                </div>
        
                <div class="customer">
                    <div class="info-customer">
                        <h3>Thông tin khách hàng</h3>
                        <p><strong>Họ và tên khách hàng:</strong> ' . $info_customer['fullname'] . '</p>
                        <p><strong>Số điện thoại:</strong> ' . $info_customer['phone_number'] . '</p>
                        <p><strong>Email:</strong> ' . $info_customer['email'] . '</p>
                    </div>
                    <div class="address-customer">
                        <h3>Địa chỉ giao hàng</h3>
                        <p><strong>Địa chỉ:</strong> ' . $info_customer['address'] . '</p>
                    </div>
                </div>
        
                <h2>THÔNG TIN ĐƠN HÀNG - DÀNH CHO NGƯỜI MUA</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Tên sản phẩm</th>
                            <th>Size</th>
                            <th>Số lượng</th>
                            <th>Giá</th>
                            <th>Thành tiền tiền</th>
                        </tr>
                    </thead>
                    <tbody>';

        foreach ($order_detail as $item) {
            $content .= '
                        <tr>
                            <td>' . $item['product_name'] . '</td>
                            <td>' . $item['size'] . '</td>
                            <td>' . $item['quantity'] . '</td>
                            <td>' . currency_format($item['price']) . '</td>
                            <td>' . currency_format($item['price'] * $item['quantity']) . '</td>
                        </tr>';
        }
        $content .= '
                    </tbody>
                    <tfoot>
                        <tr class="total-row">
                            <td colspan="4">Tổng tiền</td>
                            <td>' . currency_format($data_order['total_amout']) . '</td>
                        </tr>
                    </tfoot>
                </table>
                <div class="order-details">
                    <p>Xin khách hàng hãy kiểm tra lại thông tin cá nhân của mình và thông tin đơn hàng. </p>
                    <p>Nếu có bất ký sai sót hay thắc mắc gì xin hãy liên hệ ngay với chúng tôi</p>
                    <p>Liên hệ Hotline: <span>0338.237.xxx</span>(24/24 bất cả ngày nào trong tuần)</p>
                    <p><span>MEN CLOTHES</span> cảm ơn quý khách hàng đã tin tưởng và đặt hàng của chúng tôi.</p>
                    <div class="signature">
                        <p>Trân trọng,</p>
                        <p>Men Clothes</p>
                    </div>
                </div>
            </div>
        
        </body>
        
        </html>
        ';
        send_mail($info_customer['email'], '', "MEN CLOTHES - Đơn đặt hàng", $content);
        echo "<script>alert('Đã gửi email thành công');</script>";
    }
    load_view('printBill');
}