<div class="customer-list">
    <h3 style = "text-align: center;">LIỆT KÊ DANH SÁCH KHÁCH HÀNG</h3>
    
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th style = "text-align: center;">ID Khách hàng</th>
                    <th style = "text-align: center;">Tên khách hàng</th>
                    <th style = "text-align: center;">Số điện thoại</th>
                    <th style = "text-align: center;">Email</th>
                    <th style = "text-align: center;">Password</th>
                    <th style = "text-align: center;">Địa chỉ</th>
                    <th style = "text-align: center;">Quản lý</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                foreach($customer as $key => $cus){ 
                ?>
                <tr>
                    <td style = "text-align: center;"><?php echo $i ?></td>
                    <td style = "text-align: center;"><?php echo $cus['customer_name'] ?></td>
                    <td style = "text-align: center;"><?php echo $cus['customer_phone'] ?></td>
                    <td style = "text-align: center;"><?php echo $cus['customer_email'] ?></td>
                    <td style = "text-align: center;"><?php echo $cus['customer_password'] ?></td>
                    <td style = "text-align: center;"><?php echo $cus['customer_address'] ?></td>
                    <td class="actions">
                        <a href="<?php echo BASE_URL ?>customer/delete_customer/<?php echo $cus['customer_id'] ?>" class="btn-delete">Xóa</a>
                        <a href="<?php echo BASE_URL ?>customer/edit_customer/<?php echo $cus['customer_id'] ?>" class="btn-edit">Cập nhật</a>
                    </td>
                </tr>
                <?php
                $i++;
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<style>
.customer-list {
    padding: 20px;
}

.customer-list h2 {
    margin-bottom: 20px;
    color: #333;
}

.table-container {
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    overflow-x: auto;
}

table {
    width: 100%;
    border-collapse: collapse;
    min-width: 800px;
}

th, td {
    padding: 12px 15px;
    text-align: center;
    border-bottom: 1px solid #eee;
    font-size: 20px;
}

th {
    background-color: #f8f9fa;
    font-weight: 600;
    color: #333;
}

tr:hover {
    background-color: #f5f5f5;
}

tbody tr:last-child td {
    border-bottom: none;
}

.actions {
    gap: 8px;
}

.btn-edit,
.btn-delete {
    padding: 6px 12px;
    border-radius: 4px;
    text-decoration: none;
    color: white;
    font-size: 14px;
}

.btn-edit {
    background-color: #2196F3;
}

.btn-delete {
    background-color: #f44336;
}

.btn-edit:hover {
    background-color: #1976D2;
}

.btn-delete:hover {
    background-color: #da190b;
}
</style>
