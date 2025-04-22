<div class="customer-edit">
    <h2 align = "center">CẬP NHẬT KHÁCH HÀNG</h2>
    <?php
        foreach($customerbyid as $key => $cus){
    ?>
    <div class="form-container">
        <form action="<?php echo BASE_URL ?>customer/update_customer/<?php echo $cus['customer_id'] ?>" method="POST">
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="customer_name" value="<?php echo $cus['customer_name'] ?>" required>
            </div>
            
            <div class="form-group">
                <label>Phone</label>
                <input type="text" name="customer_phone" value="<?php echo $cus['customer_phone'] ?>" required>
            </div>
            
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="customer_email" value="<?php echo $cus['customer_email'] ?>" required>
            </div>
            
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="customer_password" value="<?php echo $cus['customer_password'] ?>" required>
            </div>
            
            <div class="form-group">
                <label>Address</label>
                <textarea name="customer_address" required><?php echo $cus['customer_address'] ?></textarea>
            </div>
            
            <div class="form-buttons">
                <button type="submit" class="btn-update">Cập nhật</button>
                <a href="<?php echo BASE_URL ?>customer/list_customer" class="btn-cancel">Hủy</a>
            </div>
        </form>
    </div>
    <?php
        }
    ?>
</div>

<style>
.customer-edit {
    padding: 40px;
}

.customer-edit h2 {
    margin-bottom: 30px;
    color: #333;
    font-size: 28px;
}

.form-container {
    background: #fff;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    max-width: 800px;
    margin: 0 auto;
}

.form-group {
    margin-bottom: 25px;
}

.form-group label {
    display: block;
    margin-bottom: 8px;
    color: #555;
    font-weight: 500;
    font-size: 16px;
}

.form-group input,
.form-group textarea {
    width: 100%;
    padding: 12px 16px;
    border: 1px solid #ddd;
    border-radius: 6px;
    font-size: 16px;
    transition: border-color 0.3s ease;
}

.form-group input:focus,
.form-group textarea:focus {
    border-color: #4CAF50;
    outline: none;
    box-shadow: 0 0 0 2px rgba(76, 175, 80, 0.1);
}

.form-group textarea {
    height: 120px;
    resize: vertical;
}

.form-buttons {
    margin-top: 30px;
    display: flex;
    gap: 15px;
}

.btn-update,
.btn-cancel {
    padding: 12px 30px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-size: 16px;
    text-decoration: none;
    display: inline-flex;
    justify-content: center;
    align-items: center;
    transition: all 0.3s ease;
}

.btn-update {
    background-color: #4CAF50;
    color: white;
    flex: 1;
}

.btn-cancel {
    background-color: #f44336;
    color: white;
    flex: 1;
}

.btn-update:hover {
    background-color: #45a049;
    transform: translateY(-1px);
}

.btn-cancel:hover {
    background-color: #da190b;
    transform: translateY(-1px);
}
</style> 