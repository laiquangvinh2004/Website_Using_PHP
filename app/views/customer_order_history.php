<?php
    if(!empty($_GET['msg'])){
        $msg = unserialize(urldecode($_GET['msg']));
        foreach($msg as $key => $value){
            echo '<span style="color:blue;font-weight:bold">'.$value.'</span>';
        }
    }
?>

<div class="container">
    <h2 class="text-center" style="margin: 30px 0;">LỊCH SỬ ĐƠN HÀNG</h2>
    
    <?php if(empty($orders)): ?>
        <p class="text-center">Bạn chưa có đơn hàng nào.</p>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Mã đơn hàng</th>
                        <th>Ngày đặt</th>
                        <th>Tổng tiền</th>
                        <th>Trạng thái</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $current_order = '';
                    $total = 0;
                    foreach($orders as $key => $order):
                        if($current_order != $order['order_code']):
                            if($current_order != ''): ?>
                                <tr>
                                    <td><?php echo $current_order; ?></td>
                                    <td><?php echo $order_date; ?></td>
                                    <td><?php echo number_format($total, 0, ',', '.') . 'đ'; ?></td>
                                    <td>
                                        <?php
                                        if($order_status == 0){
                                            echo 'Đang xử lý';
                                        }else{
                                            echo 'Đã xử lý';
                                        }
                                        ?>
                                    </td>
                                </tr>
                            <?php
                            endif;
                            $current_order = $order['order_code'];
                            $order_date = $order['order_date'];
                            $order_status = $order['order_status'];
                            $total = 0;
                        endif;
                        $total += $order['product_quantity'] * $order['product_price'];
                    endforeach;
                    
                    // Display the last order
                    if($current_order != ''): ?>
                        <tr>
                            <td><?php echo $current_order; ?></td>
                            <td><?php echo $order_date; ?></td>
                            <td><?php echo number_format($total, 0, ',', '.') . 'đ'; ?></td>
                            <td>
                                <?php
                                if($order_status == 0){
                                    echo 'Đang xử lý';
                                }else{
                                    echo 'Đã xử lý';
                                }
                                ?>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- QR Code Section -->
        <div class="qr-code-section text-center">
            <h3>Quét mã QR để thanh toán</h3>
            <img src="<?php echo BASE_URL ?>/public/template/images/anh2.jpg" alt="QR Code" class="qr-code-image">
        </div>
    <?php endif; ?>
</div>

<style>
.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

.table {
    margin-top: 20px;
    background: white;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.table th {
    background-color: #f8f9fa;
    text-align: center;
    padding: 15px;
    font-weight: 600;
}

.table td {
    vertical-align: middle;
    text-align: center;
    padding: 15px;
}

.status-pending {
    color: #ffc107;
    font-weight: 500;
}

.status-completed {
    color: #28a745;
    font-weight: 500;
}

.btn-info {
    background-color: #17a2b8;
    border-color: #17a2b8;
    color: white;
    padding: 8px 15px;
    border-radius: 4px;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 5px;
}

.btn-info:hover {
    background-color: #138496;
    border-color: #117a8b;
    color: white;
}

.empty-orders {
    background: white;
    padding: 40px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    margin: 20px 0;
}

.btn-primary {
    background-color: #007bff;
    border-color: #007bff;
    color: white;
    padding: 10px 20px;
    border-radius: 4px;
    text-decoration: none;
    display: inline-block;
}

.btn-primary:hover {
    background-color: #0069d9;
    border-color: #0062cc;
    color: white;
}

.alert {
    padding: 15px;
    margin-bottom: 20px;
    border-radius: 4px;
}

.alert-info {
    background-color: #d1ecf1;
    border-color: #bee5eb;
    color: #0c5460;
}

@media (max-width: 768px) {
    .table-responsive {
        margin: 0 -15px;
    }
    
    .btn-info {
        padding: 6px 12px;
        font-size: 14px;
    }
}

.qr-code-section {
    margin: 40px 0;
    padding: 20px;
}

.qr-code-image {
    width: 200px;
    height: 200px;
    margin: 20px auto;
    display: block;
}
</style> 