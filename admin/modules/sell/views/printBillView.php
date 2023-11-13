<?php
$id = $_GET['id'];
$data_order = get_info_order($id);
$info_customer = get_info_customer($data_order['customer_id']);
$order_detail = get_order_detail($id);
// show_array($data_order);
// echo "<hr>";
// show_array($info_customer);
// echo "<hr>";
// show_array($order_detail);

$pdf = new tFPDF();
$pdf->AddPage('0');
$pdf->AddFont('DejaVu', '', 'DejaVuSansCondensed.ttf', true);
$pdf->SetFont('DejaVu', '', 14);

$pdf->Write(10, "HÓA ĐƠN CHI TIẾT");
$pdf->Ln(10);
$pdf->Write(10, "Thời gian đặt: {$data_order['order_date']}");
$pdf->Ln(10);
$pdf->Write(10, "Thông tin khách hàng");
$pdf->Ln(10);
// Tiêu đề bảng
$pdf->Cell(45, 10, 'Họ tên', 1);
$pdf->Cell(70, 10, 'Mã đơn', 1);
$pdf->Cell(40, 10, 'Địa chỉ', 1);
$pdf->Cell(35, 10, 'Số điện thoại', 1);
$pdf->Cell(50, 10, 'Email', 1);
$pdf->Cell(50, 10, 'Chú thích', 1);

// Xuống dòng
$pdf->Ln();

// Dữ liệu bảng
$pdf->Cell(45, 10, $info_customer['fullname'], 1);
$pdf->Cell(70, 10, $data_order['code_order'], 1);
$pdf->Cell(40, 10, $data_order['shipping_address'], 1);
$pdf->Cell(35, 10, $info_customer['phone_number'], 1);
$pdf->Cell(50, 10, $info_customer['email'], 1);
$pdf->MultiCell(50, 10, $info_customer['note'], 1);

$pdf->Write(10, "Thông tin đơn hàng");
$pdf->Ln(10);
//Tiêu đề
$pdf->Cell(110, 10, 'Tên', 1);
$pdf->Cell(40, 10, 'Size', 1);
$pdf->Cell(40, 10, 'Số lượng', 1);
$pdf->Cell(35, 10, 'Giá', 1);
$pdf->Cell(50, 10, 'Thành tiền', 1);

$pdf->Ln();

// Dữ liệu bảng
foreach ($order_detail as $item) {
    $pdf->Cell(110, 10, $item['product_name'], 1);
    $pdf->Cell(40, 10, $item['size'], 1);
    $pdf->Cell(40, 10, $item['quantity'], 1);
    $pdf->Cell(35, 10, currency_format($item['price']), 1);
    $pdf->Cell(50, 10, currency_format($item['price'] * $item['quantity']), 1);
    $pdf->Ln();
}

$pdf->Cell(225, 10, 'Tổng số lượng', 1);
$pdf->Cell(50, 10, 'Tổng thanh toán', 1);
$pdf->Ln();
$pdf->Cell(225, 10, "{$data_order['product_quantity']} sản phẩm", 1);
$pdf->Cell(50, 10, currency_format($data_order['total_amout']), 1);
// Xuất tài liệu ra file hoặc hiển thị trực tiếp
$pdf->Output('hoadon.pdf', 'I');
