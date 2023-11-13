<?php
get_header();
$id = $_GET['id'];
$data_order = get_info_order($id);
$info_customer = get_info_customer($data_order['customer_id']);
$order_detail = get_order_detail($id);
?>

<div id="main-content-wp" class="list-product-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <div id="info-customer">
                <h2>Thông tin đơn hàng</h2>
                <div class="title-info">
                    <i class="fa-solid fa-id-card"></i>
                    <p>Thông tin khách hàng</p>
                </div>
                <div class="table-info">
                    <table>
                        <thead>
                            <tr>
                                <th>Họ và tên</th>
                                <th>Mã đơn</th>
                                <th>Địa chỉ</th>
                                <th>Số điện thoại</th>
                                <th>Email</th>
                                <th>Thời gian đặt</th>
                                <th>Chú thích</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?php echo $info_customer['fullname']; ?></td>
                                <td><?php echo $data_order['code_order']; ?></td>
                                <td><?php echo $info_customer['address']; ?></td>
                                <td><?php echo $info_customer['phone_number']; ?></td>
                                <td><?php echo $info_customer['email']; ?></td>
                                <td><?php echo $info_customer['created_at']; ?></td>
                                <td><?php echo $info_customer['note']; ?></td>
                            </tr>
                            <!-- Thêm các dòng khác tương tự -->
                        </tbody>
                    </table>
                </div>
                <form action="" method="post">
                    <div class="order-status">
                        <div class="info-status">
                            <div class="title-info">
                                <i class="fa-brands fa-slack"></i>
                                <p>Trạng thái đơn hàng:</p>
                                <p class="<?php echo $data_order['status']; ?>"><?php echo $data_order['status']; ?></p>

                            </div>
                            <div class="change-status">
                                <select name="select-status" id="">
                                    <option value="">Cập nhật tình trạng đơn hàng</option>
                                    <option value="1">Chưa xử lý</option>
                                    <option value="2">Đang xử lý</option>
                                    <option value="3">Đã giao</option>
                                    <option value="4">Hoàn thành</option>
                                    <option value="5">Đã bị hủy</option>
                                </select>
                                <button name="btn-change" type="submit">Cập nhật</button>
                            </div>
                        </div>
                        <div class="table-info">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Tổng số lượng</th>
                                        <th>Tổng tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?php echo $data_order['product_quantity']; ?> sản phẩm</td>
                                        <td><?php echo currency_format($data_order['total_amout']); ?></td>
                                    </tr>
                                </tbody>

                            </table>
                        </div>
                    </div>
                </form>
            </div>
            <div id="detail-order">
                <h2>Chi tiết đơn hàng</h2>
                <div class="table-info data-product">
                    <table>
                        <thead>
                            <tr>
                                <th>Ảnh</th>
                                <th>Tên</th>
                                <th>Số lượng</th>
                                <th>Giá</th>
                                <th>Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($order_detail as $item) {
                            ?>
                                <tr>
                                    <td><img src="<?php echo $item['image_url']; ?>" alt="<?php echo $item['product_name']; ?>"></td>
                                    <td><?php echo $item['product_name']; ?></td>
                                    <td><?php echo $item['quantity']; ?></td>
                                    <td><?php echo currency_format($item['price']); ?></td>
                                    <td><?php echo currency_format($item['price'] * $item['quantity']); ?></td>
                                </tr>
                            <?php
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
            <button class="btn-print-bill">
                <a href="<?php echo $data_order['url_bill']; ?>" style="color:#fff;" target="_blank">In hóa đơn</a>
            </button>
        </div>
    </div>
</div>


<?php
get_footer();
// show_array($data_order);
// show_array($info_customer);
// show_array($order_detail);
?>