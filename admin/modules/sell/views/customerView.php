<?php
get_header();
$data_customers = get_data_customers();
$count_customers = count_customers();
?>

<div id="main-content-wp" class="list-product-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách khách hàng</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <ul class="post-status fl-left">
                            <li class="all"><a href="">Tất cả <span class="count">(<?php echo $count_customers; ?>)</span></a></li>
                        </ul>
                    </div>
                    <div class="table-responsive">
                        <table class="table list-table-wp">
                            <thead>
                                <tr>
                                    <td><span class="thead-text">STT</span></td>
                                    <td><span class="thead-text">Họ và tên</span></td>
                                    <td><span class="thead-text">Số điện thoại</span></td>
                                    <td><span class="thead-text">Email</span></td>
                                    <td><span class="thead-text">Địa chỉ</span></td>
                                    <td><span class="thead-text">Số lượng</span></td>
                                    <td><span class="thead-text">Thời gian đặt</span></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $temp=0;
                                foreach ($data_customers as $item) {
                                    $time_order = date("d-m-Y", strtotime($item['created_at']));
                                    $temp++;
                                ?>
                                    <tr>
                                        <td><span class="tbody-text"><?php echo $temp; ?></h3></span>
                                        <td>
                                            <div class="tb-title fl-left">
                                                <a href="" title=""><?php echo $item['fullname']; ?></a>
                                            </div>
                                        </td>
                                        <td><span class="tbody-text"><?php echo $item['phone_number']; ?></span></td>
                                        <td><span class="tbody-text"><?php echo $item['email']; ?></span></td>
                                        <td><span class="tbody-text"><?php echo $item['address']; ?></span></td>
                                        <td><span class="tbody-text"><?php echo $item['num_product']['product_quantity']; ?> sản phẩm</span></td>
                                        <td><span class="tbody-text"><?php echo $time_order;?></span></td>
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
            </div>
        </div>
    </div>
</div>

<?php
get_footer();
// show_array($data_customers);
?>