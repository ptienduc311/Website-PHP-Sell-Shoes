<?php
get_header();
$data_orders = get_data_orders($product_status);
$total_orders = count_all_orders();
$total_orders_finish = count_finish_orders();
$total_orders_canceled = count_cancelled_orders();
$total_orders_remain = count_remain_orders();
?>

<div id="main-content-wp" class="list-product-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách đơn hàng</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <ul class="post-status fl-left">
                            <li class="all"><a href="">Tất cả <span class="count">(<?php echo $total_orders; ?>)</span></a> |</li>
                            <li class="publish"><a href="">Hoàn thành<span class="count">(<?php echo $total_orders_finish; ?>)</span></a> |</li>
                            <li class="pending"><a href="">Đã bị hủy<span class="count">(<?php echo $total_orders_canceled; ?>)</span> |</a></li>
                            <li class="pending"><a href="">Khác<span class="count">(<?php echo $total_orders_remain; ?>)</span></a></li>
                        </ul>
                    </div>
                    <div class="actions">
                        <form method="POST" action="" class="form-actions">
                            <select name="status">
                                <option value="">Chọn trạng thái</option>
                                <option value="delivered">Hoàn thành</option>
                                <option value="canceled">Đơn hủy</option>
                                <option value="different">Khác</option>
                            </select>
                            <input type="submit" name="sm_action" value="Áp dụng">
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table class="table list-table-wp">
                            <thead>
                                <tr>
                                    <td><span class="thead-text">STT</span></td>
                                    <td><span class="thead-text">Mã đơn hàng</span></td>
                                    <td><span class="thead-text">Họ và tên</span></td>
                                    <td><span class="thead-text">Số sản phẩm</span></td>
                                    <td><span class="thead-text">Tổng giá</span></td>
                                    <td><span class="thead-text">Trạng thái</span></td>
                                    <td><span class="thead-text">Chi tiết</span></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $temp = 0;
                                foreach ($data_orders as $item) {
                                    $temp++;
                                ?>
                                    <tr>
                                        <td><span class="tbody-text"><?php echo $temp; ?></h3></span>
                                        <td><span class="tbody-text"><?php echo $item['code_order']; ?></h3></span>
                                        <td>
                                            <div class="tb-title fl-left">
                                                <a href="" title=""><?php echo $item['fullname']; ?></a>
                                            </div>
                                            
                                        </td>
                                        <td><span class="tbody-text"><?php echo $item['product_quantity']; ?></span></td>
                                        <td><span class="tbody-text"><?php echo currency_format($item['total_amout']); ?></span></td>
                                        <td><span class="tbody-text <?php echo $item['status'] ?>"><?php echo $item['name_status']; ?></span></td>
                                        <td><a href="<?php echo $item['url']; ?>" title="" class="tbody-text">Chi tiết</a></td>
                                    </tr>
                                <?php
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail clearfix">
                </div>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();
// show_array($data_orders);
?>