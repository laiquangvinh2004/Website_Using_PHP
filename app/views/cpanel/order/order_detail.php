<div class="order-detail">
    <h2>Chi tiết đơn hàng</h2>
    
    <div class="table-container">
        <h3>Thông tin khách hàng</h3>
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Tên người đặt</th>
                        <th>Email</th>
                        <th>Số điện thoại</th>
                        <th>Địa chỉ</th>
                        <th>Ghi chú</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    foreach($order_detail as $key => $ord){
                        $i++;
                    ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $ord['name'] ?></td>
                        <td><?php echo $ord['email'] ?></td>
                        <td><?php echo $ord['sodienthoai'] ?></td>
                        <td><?php echo $ord['diachi'] ?></td>
                        <td><?php echo $ord['noidung'] ?></td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <h3>Chi tiết sản phẩm</h3>
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Tên sản phẩm</th>
                        <th>Hình ảnh</th>
                        <th>Số lượng</th>
                        <th>Đơn giá</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    $total = 0;
                    foreach($order_detail as $key => $ord){
                        $total += $ord['product_quantity'] * $ord['price_product'];
                        $i++;
                    ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $ord['title_product'] ?></td>
                        <td class="product-image">
                            <img src="<?php echo BASE_URL ?>public/upload/product/<?php echo $ord['image_product'] ?>" alt="Product image">
                        </td>
                        <td><?php echo $ord['product_quantity'] ?></td>
                        <td class="price"><?php echo number_format($ord['price_product'], 0, ',', '.') ?>đ</td>
                        <td class="price"><?php echo number_format($ord['product_quantity'] * $ord['price_product'], 0, ',', '.') ?>đ</td>
                    </tr>
                    <?php
                    }
                    ?>
                    <tr class="total-row">
                        <td colspan="4">
                            <form method="POST" action="<?php echo BASE_URL ?>order/order_confirm/<?php echo $ord['order_code'] ?>" class="order-form">
                                <button type="submit" name="update_order" class="btn-update">Đã xử lý</button>
                            </form>
                        </td>
                        <td colspan="2" class="total-cell">
                            Tổng tiền: <span><?php echo number_format($total, 0, ',', '.') ?>đ</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
.order-detail {
    padding: 40px;
}

.order-detail h2 {
    margin-bottom: 30px;
    color: #333;
    font-size: 32px;
    text-align: center;
}

.order-detail h3 {
    margin: 35px 0 25px;
    color: #444;
    font-size: 24px;
    font-weight: 500;
}

.table-container {
    background: #fff;
    padding: 35px;
    border-radius: 12px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    max-width: 1400px;
    margin: 0 auto;
}

.table-responsive {
    overflow-x: auto;
    margin: 0 -20px;
    padding: 0 20px;
}

table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    min-width: 1000px;
}

th, td {
    padding: 20px;
    text-align: center;
    border-bottom: 1px solid #eee;
    font-size: 16px;
    vertical-align: middle;
    line-height: 1.5;
}

th {
    background-color: #f8f9fa;
    font-weight: 600;
    color: #333;
    white-space: nowrap;
    font-size: 17px;
}

tr:hover {
    background-color: #f5f5f5;
}

.product-image {
    padding: 12px;
}

.product-image img {
    height: 120px;
    width: auto;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.price {
    font-weight: 600;
    color: #e74c3c;
    font-size: 17px;
}

.total-row {
    background-color: #f8f9fa;
}

.total-cell {
    text-align: right;
    font-weight: 600;
    font-size: 18px;
    color: #333;
    padding-right: 30px;
}

.total-cell span {
    color: #e74c3c;
    font-size: 22px;
    margin-left: 10px;
}

.order-form {
    display: flex;
    justify-content: flex-start;
    padding-left: 20px;
}

.btn-update {
    padding: 12px 30px;
    border: none;
    border-radius: 8px;
    background-color: #4CAF50;
    color: white;
    font-size: 16px;
    cursor: pointer;
    transition: all 0.3s ease;
    font-weight: 500;
}

.btn-update:hover {
    background-color: #45a049;
    transform: translateY(-1px);
}
</style> 