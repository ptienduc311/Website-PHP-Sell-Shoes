<?php
$id = $_GET['id'];
$data_order = get_info_order($id);
$info_customer = get_info_customer($data_order['customer_id']);
$order_detail = get_order_detail($id);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>In hóa đơn</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="public/css/pdf.css" />
    <script src="public/js/pdf.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>

</head>

<body>
    <div class="container d-flex justify-content-center mt-50 mb-50">
        <div class="row">
            <div class="col-md-12 text-right mb-3">
                <button class="btn btn-primary" id="download">In hóa đơn</button>
            </div>
            <div class="col-md-12">
                <form action="" method="post">
                    <div class="card" id="invoice">
                        <div class="card-header bg-transparent header-elements-inline">
                            <h6 class="card-title" style="color: #ff0000; font-weight: bold; font-size: 24px;">PHIẾU HÓA ĐƠN</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-4 pull-left">

                                        <ul class="list list-unstyled mb-0 text-left">
                                            <li style="font-size: 18px; font-weight: bold; color: #3e56e7;">SHOES STORE</li>
                                            <li>145 Hoàng Cầu</li>
                                            <li>Quận Đống Đa</li>
                                            <li>Hà Nội</li>
                                            <li>+(84) 837 4712 312</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-4 ">
                                        <div class="text-sm-right">
                                            <h4 class="invoice-color mb-2 mt-md-2">Hóa đơn <span style="font-size: 14px;">#<?php echo $data_order['code_order']; ?></span></h4>
                                            <ul class="list list-unstyled mb-0">
                                                <li style="font-weight: bold">Ngày đặt hàng: <span class="font-weight-semibold" style="font-weight: normal"><?php echo date("Y-m-d", strtotime($data_order['order_date'])); ?></span></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-md-flex flex-md-wrap">
                                <div class="mb-4 mb-md-2 text-left"> <span class="text-muted">Hóa đơn đến:</span>
                                    <ul class="list list-unstyled mb-0">
                                        <li>
                                            <h5 class="my-2"><?php echo $info_customer['fullname']; ?></h5>
                                        </li>
                                        <li><span class="font-weight-semibold"><?php echo $info_customer['address']; ?></span></li>
                                        <li><?php echo $info_customer['phone_number']; ?></li>
                                        <li><a href="" data-abc="true"><?php echo $info_customer['email']; ?></a></li>
                                    </ul>
                                </div>

                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-lg">
                                <thead>
                                    <tr>
                                        <th>Hình ảnh</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Size</th>
                                        <th>Số lượng</th>
                                        <th>Giá</th>
                                        <th>Thành tiền tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($order_detail as $item) {
                                    ?>
                                        <tr>
                                            <td>
                                                <img src="<?php echo $item['image_url']; ?>" id="proudct-thumb-img" alt="">
                                            </td>
                                            <td>
                                                <h6 class="mb-0"><?php echo $item['product_name'] ?></h6>
                                            </td>
                                            <td><?php echo $item['size'] ?></td>
                                            <td><?php echo $item['quantity'] ?></td>
                                            <td><span class="font-weight-semibold"><?php echo currency_format($item['price']) ?></span></td>
                                            <td><span class="font-weight-semibold"><?php echo currency_format($item['price'] * $item['quantity']) ?></span></td>

                                        </tr>
                                    <?php
                                    }
                                    ?>


                                </tbody>
                            </table>
                        </div>
                        <div class="card-body">
                            <div class="d-md-flex flex-md-wrap">
                                <div class="pt-2 mb-3 wmin-md-400 ml-auto">
                                    <h6 class="mb-3 text-left">Tổng chi phí</h6>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <th class="text-left">Thành tiền:</th>
                                                    <td class="text-right"><?php echo currency_format($data_order['total_amout']); ?></td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="text-right mt-3"> <button type="submit" class="btn btn-primary" name="btn-send">Gửi hóa đơn</button> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
</body>

</html>