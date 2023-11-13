<?php
if ($_SESSION['role'] != 'admin') {
    header("Location: http://localhost/project/website_shoes/?mod=users&action=login");
}
get_header();
$count_delivered = get_count_deliver();
$count_processing = get_count_processing();
$count_cancel  = get_count_cancel();
$total_stock = count_product();
// echo "$count_cancel - $count_delivered - $count_processing";
// show_array($total_stock);
$data_order = get_order_info();
?>

<style>
    .box-info {
        display: flex;
        justify-content: space-around;
        padding: 20px;
    }

    .box {
        /* background-color: #ffffff; */
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        text-align: center;
        width: 200px;
    }

    .box-success {
        background-color: #1ad400;
    }

    .box-processing {
        background-color: #0513bf;
    }

    .box-cancel {
        background-color: #f00e0e;
    }

    .box-total {
        background-color: #ff6e00;
    }

    .box h2 {
        margin: 0;
        font-size: 24px;
        color: #fff;
        border-bottom: 2px solid;
        padding: 4px;
    }

    .box p {
        margin: 5px 0;
        font-size: 18px;
        color: #f9f3f3;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        border-radius: 15px;
    }

    th,
    td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }

    .actions {
        text-align: center;
    }

    .actions button {
        background: none;
        border: none;
        cursor: pointer;
        font-size: 16px;
        color: #3498db;
    }

    .actions button:hover i {
        color: #ad0a28;
    }
</style>

<div id="main-content-wp" class="list-post-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <div class="box-info">
                <div class="box box-success">
                    <h2>ĐƠN HÀNG THÀNH CÔNG</h2>
                    <p><?php echo $count_delivered; ?></p>
                    <p>Đơn hàng giao dịch thành công</p>
                </div>
                <div class="box box-processing">
                    <h2>ĐANG XỬ LÝ</h2>
                    <p><?php echo $count_processing; ?></p>
                    <p>Số lượng đơn hàng đang xử lý</p>
                </div>
                <div class="box box-cancel">
                    <h2>ĐƠN HÀNG HỦY</h2>
                    <p><?php echo $count_cancel; ?></p>
                    <p>Số đơn bị hủy trong hệ thống</p>
                </div>
                <div class="box box-total">
                    <h2>TỔNG SỐ SẢN PHẨM TRONG KHO</h2>
                    <p><?php echo $total_stock['total_stock']; ?></p>
                    <p>sản phẩm</p>
                </div>

            </div>
            <div class="box-order">
                <table>
                    <thead>
                        <tr>
                            <th>Mã đơn</th>
                            <th>Tên khách hàng</th>
                            <th>Số lượng sản phẩm</th>
                            <th>Tổng giá trị đơn hàng</th>
                            <th>Trạng thái</th>
                            <th>Thời gian đặt</th>
                            <th>Tác vụ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($data_order as $item) {
                        ?>
                            <tr>
                                <td><?php echo $item['code_order']; ?></td>
                                <td><?php echo $item['name_customer']; ?></td>
                                <td><?php echo $item['product_quantity']; ?></td>
                                <td><?php echo currency_format($item['total_amout']); ?></td>
                                <td><span class="<?php echo $item['status'] ?>"><?php echo $item['name_status']; ?></span></td>
                                <td><?php echo $item['order_date']; ?></td>
                                <td class="actions">
                                    <button>
                                        <a href="<?php echo $item['url']; ?>"><i class="fa-solid fa-eye"></i></a>
                                    </button>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();
// show_array($data_order);
?>