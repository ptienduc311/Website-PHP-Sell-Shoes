<?php
function construct()
{
    load_model('index');
    load('lib', 'validation');
    load('lib', 'email');
}
function indexAction()
{
    global $error, $fullname, $email, $address, $phone_number, $note,
        $product_quantity, $total_amout, $payment_method, $shipping_address, $code_order,
        $data_order_items, $data_order_send_customer;
    $currentDateTime = date('Y-m-d H:i:s');
    $currentDate = date('Y-m-d');
    if (isset($_POST['btn-order'])) {
        //Validation họ tên khách hàng
        if (empty($_POST['fullname'])) {
            $error['fullname'] = "Vui lòng nhập họ tên";
        } else {
            if (!is_fullname($_POST['fullname'])) {
                $error['fullname'] = "Họ và tên người nhận không đúng định dạng";
            } else {
                $fullname = $_POST['fullname'];
            }
        }
        //Validation email
        if (empty($_POST['email'])) {
            $error['email'] = "Vui lòng nhập Email";
        } else {
            if (!is_email($_POST["email"])) {
                $error['email'] = "Email của bạn không đúng định dạng";
            } else {
                $email = $_POST['email'];
            }
        }
        //Validation address
        if (empty($_POST['address'])) {
            $error['address'] = "Vui lòng nhập địa chỉ giao hàng";
        } else {
            $address = $_POST['address'];
        }
        //Validation số điện thoại
        if (empty($_POST['phone_number'])) {
            $error['phone_number'] = "Vui lòng nhập số điện thoại";
        } elseif (!is_phone($_POST['phone_number'])) {
            $error['phone_number'] = "Số điện thoại phải là 10 chữ số";
        } else {
            $phone_number = $_POST['phone_number'];
        }
        //Validation note
        if (empty($_POST['note'])) {
            $note = NULL;
        } else {
            $note = $_POST['note'];
        }
        //Validation phương thức thanh toán
        if (empty($_POST['payment-method'])) {
            $error['payment-method'] = "Bạn chưa chọn phương thức thanh toán";
        } else {
            $payment_method = $_POST['payment-method'];
        }

        if (empty($error)) {
            #----------THÔNG TIN KHÁCH HÀNG------------
            $data_customer = [
                'fullname' => $fullname,
                'email' => $email,
                'address' => $address,
                'phone_number' => $phone_number,
                'note' => $note
            ];
            $customer_id = addCustomer($data_customer);
            // show_array($data_customer);

            #----------THÔNG TIN ĐƠN HÀNG------------
            $product_quantity = get_num_order_cart();
            $total_amout = get_total_cart();
            $payment_method = $_POST['payment-method'];
            $shipping_address = $address;
            $code_order = strtoupper(uniqid($total_amout));
            $data_orders = [
                'code_order' => $code_order,
                'product_quantity' => $product_quantity,
                'total_amout' => $total_amout,
                'payment_method' => $payment_method,
                'shipping_address' => $shipping_address,
                'customer_id' => $customer_id
            ];
            $order_id = addOrders($data_orders);
            // show_array($data_orders);

            #----------THÔNG TIN CHI TIẾT ĐƠN HÀNG------------
            $list_buy = get_data_product_cart();
            $data_order_items = [];
            $data_order_send_customer = [];
            foreach ($list_buy as $data) {
                foreach ($data as $item) {
                    $data_order_items = [
                        'product_id' => $item['id'],
                        'product_name' => $item['product_name'],
                        'image_url' => $item['product_thumb'],
                        'size' => $item['product_size'],
                        'price' => $item['product_price'],
                        'quantity' => $item['product_quantity'],
                        'order_id' => $order_id
                    ];
                    $data_order_send_customer[] = $data_order_items;
                    addOrderItems($data_order_items);
                }
            }
            // show_array($data_order_send_customer);

            #-------------TRỪ SỐ LƯỢNG SẢN PHẨM TRONG KHO---------------
            foreach ($list_buy as $data) {
                foreach ($data as $item) {
                    minus_product_by_id($item['product_quantity'], $item['id']);
                }
            }


            #-------------GỬI EMAIL KHI ĐẶT HÀNG THÀNH CÔNG---------------
            $content = '
            <!DOCTYPE html>
            <html lang="en">
            
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Order Success - SHOES STORE</title>
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
                    <h1>Xin chào ' . $fullname . ',</h1>
                    <p>Đơn hàng #' . $code_order . ' của bạn đã được đặt thành công ngày ' . $currentDate . '</p>
            
                    <div class="info-order">
                        <p>MÃ ĐƠN HÀNG: #<span>' . $code_order . '</span></p>
                        <p>THỜI GIAN ĐẶT: <span>' . $currentDateTime . '</span></p>
                    </div>
            
                    <div class="customer">
                        <div class="info-customer">
                            <h3>Thông tin khách hàng</h3>
                            <p><strong>Họ và tên khách hàng:</strong> ' . $fullname . '</p>
                            <p><strong>Số điện thoại:</strong> ' . $phone_number . '</p>
                            <p><strong>Email:</strong> ' . $email . '</p>
                        </div>
                        <div class="address-customer">
                            <h3>Địa chỉ giao hàng</h3>
                            <p><strong>Địa chỉ:</strong> ' . $address . '</p>
                        </div>
                    </div>
            
                    <h2>THÔNG TIN ĐƠN HÀNG - DÀNH CHO NGƯỜI MUA</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>Tên</th>
                                <th>Size</th>
                                <th>Giá</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>';

            foreach ($data_order_send_customer as $product) {
                $content .= '
                            <tr>
                                <td>'.$product['product_name'].'</td>
                                <td>'.$product['size'].'</td>
                                <td>'.currency_format($product['price']).'</td>
                                <td>'.$product['quantity'].'</td>
                                <td>'.currency_format($product['price'] * $product['quantity']).'</td>
                            </tr>';
            }
            $content .= '
                        </tbody>
                        <tfoot>
                            <tr class="total-row">
                                <td colspan="4">Tổng tiền</td>
                                <td>'.currency_format($total_amout).'</td>
                            </tr>
                        </tfoot>
                    </table>
                    <div class="order-details">
                        <p>Xin khách hàng hãy kiểm tra lại thông tin cá nhân của mình và thông tin đơn hàng. </p>
                        <p>Nếu có bất ký sai sót hay thắc mắc gì xin hãy liên hệ ngay với chúng tôi</p>
                        <p>Liên hệ Hotline: <span>0338.237.xxx</span>(24/24 bất cả ngày nào trong tuần)</p>
                        <p><span>SHOES STORE</span> cảm ơn quý khách hàng đã tin tưởng và đặt hàng của chúng tôi.</p>
                        <div class="signature">
                            <p>Trân trọng,</p>
                            <p>Shoes Store</p>
                        </div>
                    </div>
                </div>
            
            </body>
            
            </html>
            ';
            send_mail($email, '', "SHOES STORE - Đơn đặt hàng", $content);
            unset($_SESSION['cart']);
            echo "<script>alert('Bạn đã thanh toán thành công');</script>";
        }
    }
    load_view('index');
}
