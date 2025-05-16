<section class="cart-section">
    <div class="container">
        <!-- Add Font Awesome CDN -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

        <!-- Breadcrumbs -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo BASE_URL ?>">Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Giỏ hàng</li>
            </ol>
        </nav>

        <!-- Page Title -->
        <div class="page-title">
            <h1>Giỏ hàng của bạn</h1>
        </div>

        <!-- Messages -->
        <?php
        if(!empty($_GET['msg'])){
            $msg = unserialize(urldecode($_GET['msg']));
            foreach($msg as $key => $value){
                echo '<div class="alert alert-info">'.$value.'</div>';
            }
        }
        ?>

        <!-- Cart Content -->
        <div class="cart-content">
            <?php if(isset($_SESSION['shopping_cart']) && !empty($_SESSION['shopping_cart'])): ?>
                <form action="<?php echo BASE_URL ?>giohang/updategiohang" method="post">
                    <div class="cart-items">
                        <?php
                        $total = 0;
                        foreach($_SESSION['shopping_cart'] as $key => $value){
                            $subtotal = $value['product_quantity'] * $value['product_price'];
                            $total += $subtotal;
                        ?>
                        <div class="cart-item">
                            <div class="item-image">
                                <img src="<?php echo BASE_URL?>public/upload/product/<?php echo $value['product_image'] ?>" 
                                     alt="<?php echo $value['product_title'] ?>">
                            </div>
                            <div class="item-details">
                                <h4 class="item-title"><?php echo $value['product_title'] ?></h4>
                                <div class="item-price"><?php echo number_format($value['product_price'], 0, ',', '.').'đ' ?></div>
                                <div class="item-quantity">
                                    <div class="quantity-control">
                                        <input type="number" class="quantity-input" 
                                               name="qty[<?php echo $value['product_id'] ?>]"
                                               value="<?php echo $value['product_quantity'] ?>"
                                               onchange="validateQuantity(this)">
                                        <div class="quantity-error" style="color: red; display: none;">
                                            Số lượng phải lớn hơn 0
                                        </div>
                                    </div>
                                </div>
                                <div class="item-subtotal">
                                    <?php echo number_format($subtotal, 0, ',', '.').'đ' ?>
                                </div>
                                <div class="item-actions">
                                    <button type="submit" value="<?php echo $value['product_id'] ?>" 
                                            name="update_cart" class="btn-update">
                                        Cập nhật
                                    </button>
                                    <button type="submit" value="<?php echo $value['product_id'] ?>" 
                                            name="delete_cart" class="btn-delete">
                                        Xóa
                                    </button>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>

                    <!-- Cart Summary -->
                    <div class="cart-summary">
                        <div class="summary-row total">
                            <span>Tổng tiền:</span>
                            <span class="total-amount"><?php echo number_format($total, 0, ',', '.').'đ' ?></span>
                        </div>
                        <div class="cart-actions">
                            <a href="<?php echo BASE_URL ?>" class="btn-continue">
                                <i class="fas fa-arrow-left"></i> Tiếp tục mua hàng
                            </a>
                            <button type="button" class="btn-checkout" onclick="document.getElementById('checkout-form').scrollIntoView();">
                                Tiến hành đặt hàng <i class="fas fa-arrow-right"></i>
                            </button>
                        </div>
                    </div>
                </form>

                <!-- Checkout Form -->
                <div id="checkout-form" class="checkout-section">
                    <h2>Thông tin đặt hàng</h2>
                    <form name="FormDatHang" method="POST" action="<?php echo BASE_URL ?>giohang/dathang" class="checkout-form">
                        <div class="form-row">
                            <div class="form-group">
                                <label>Họ và tên</label>
                                <input type="text" name="name" required>
                            </div>
                            <div class="form-group">
                                <label>Số điện thoại</label>
                                <input type="tel" name="sodienthoai" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label>Email (Chú ý nhập đúng email đã tạo tài khoản)</label>
                                <?php 
                                // Debug session
                                echo "<!-- Debug: ";
                                print_r($_SESSION);
                                echo " -->";
                                ?>
                                <input type="email" name="email" required 
                                    value="<?php echo isset($_SESSION['customer_email']) ? $_SESSION['customer_email'] : ''; ?>"
                                    <?php echo isset($_SESSION['customer_email']) ? 'readonly' : ''; ?>>
                            </div>
                            <div class="form-group">
                                <label>Địa chỉ</label>
                                <input type="text" name="diachi" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Ghi chú</label>
                            <textarea name="noidung" rows="4"></textarea>
                        </div>
                        <div class="form-actions">
                            <button type="submit" name="frmSubmit" class="btn-place-order">Đặt hàng</button>
                        </div>
                    </form>
                </div>

            <?php else: ?>
                <div class="empty-cart">
                    <i class="fas fa-shopping-cart"></i>
                    <p>Giỏ hàng của bạn đang trống</p>
                    <a href="<?php echo BASE_URL ?>" class="btn-continue">Tiếp tục mua hàng</a>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <style>
    .cart-section {
        padding: 40px 0;
        background-color: #f8f9fa;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 15px;
    }

    /* Breadcrumbs */
    .breadcrumb {
        background-color: transparent;
        padding: 0;
        margin-bottom: 30px;
    }

    .breadcrumb-item a {
        color: #007bff;
        text-decoration: none;
    }

    .breadcrumb-item.active {
        color: #6c757d;
    }

    /* Page Title */
    .page-title {
        margin-bottom: 30px;
    }

    .page-title h1 {
        font-size: 28px;
        color: #333;
        margin: 0;
    }

    /* Alert */
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

    /* Cart Items */
    .cart-items {
        background: white;
        border-radius: 10px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        margin-bottom: 30px;
    }

    .cart-item {
        display: flex;
        padding: 20px;
        border-bottom: 1px solid #eee;
    }

    .cart-item:last-child {
        border-bottom: none;
    }

    .item-image {
        width: 120px;
        margin-right: 20px;
    }

    .item-image img {
        width: 100%;
        height: auto;
        border-radius: 4px;
    }

    .item-details {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .item-title {
        font-size: 16px;
        margin: 0 0 10px;
        color: #333;
    }

    .item-price {
        color: #007bff;
        font-weight: 500;
    }

    .quantity-control {
        display: flex;
        align-items: center;
    }

    .quantity-input {
        width: 60px;
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 4px;
        text-align: center;
    }

    .item-subtotal {
        font-weight: 500;
        color: #28a745;
    }

    .item-actions {
        display: flex;
        gap: 10px;
    }

    .btn-update, .btn-delete {
        padding: 8px 16px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 14px;
        font-weight: 500;
        transition: background-color 0.3s;
    }

    .btn-update {
        background-color: #007bff;
        color: white;
    }

    .btn-update:hover {
        background-color: #0056b3;
    }

    .btn-delete {
        background-color: #dc3545;
        color: white;
    }

    .btn-delete:hover {
        background-color: #c82333;
    }

    /* Cart Summary */
    .cart-summary {
        background: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        margin-bottom: 30px;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 0;
    }

    .total {
        font-size: 20px;
        font-weight: 500;
    }

    .total-amount {
        color: #28a745;
    }

    .cart-actions {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
    }

    .btn-continue, .btn-checkout {
        padding: 12px 24px;
        border-radius: 5px;
        text-decoration: none;
        font-weight: 500;
        cursor: pointer;
    }

    .btn-continue {
        background-color: #6c757d;
        color: white;
        border: none;
    }

    .btn-checkout {
        background-color: #28a745;
        color: white;
        border: none;
    }

    /* Checkout Form */
    .checkout-section {
        background: white;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .checkout-section h2 {
        margin-bottom: 30px;
        color: #333;
    }

    .form-row {
        display: flex;
        gap: 20px;
        margin-bottom: 20px;
    }

    .form-group {
        flex: 1;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        color: #555;
    }

    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 12px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 14px;
    }

    .form-group textarea {
        resize: vertical;
    }

    .form-actions {
        margin-top: 30px;
        text-align: right;
    }

    .btn-place-order {
        padding: 12px 30px;
        background-color: #28a745;
        color: white;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        font-weight: 500;
        cursor: pointer;
    }

    /* Empty Cart */
    .empty-cart {
        text-align: center;
        padding: 50px 20px;
        background: white;
        border-radius: 10px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .empty-cart i {
        font-size: 48px;
        color: #6c757d;
        margin-bottom: 20px;
    }

    .empty-cart p {
        font-size: 18px;
        color: #6c757d;
        margin-bottom: 20px;
    }

    @media (max-width: 768px) {
        .form-row {
            flex-direction: column;
            gap: 0;
        }

        .cart-item {
            flex-direction: column;
        }

        .item-image {
            width: 100%;
            margin-bottom: 20px;
        }

        .item-details {
            flex-direction: column;
            gap: 15px;
            text-align: center;
        }

        .cart-actions {
            flex-direction: column;
            gap: 10px;
        }

        .btn-continue, .btn-checkout {
            width: 100%;
            text-align: center;
        }
    }
    </style>

    <script>
    // Phone number validation
    document.querySelector('input[name="sodienthoai"]').addEventListener('input', function(e) {
        this.value = this.value.replace(/[^0-9]/g, '');
    });

    // Email validation
    function validateEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }

    document.querySelector('input[name="email"]').addEventListener('blur', function() {
        if (!validateEmail(this.value)) {
            this.setCustomValidity('Vui lòng nhập email hợp lệ');
        } else {
            this.setCustomValidity('');
        }
    });

    // Quantity validation
    function validateQuantity(input) {
        const errorDiv = input.parentElement.querySelector('.quantity-error');
        const value = parseInt(input.value);
        
        if (isNaN(value) || value <= 0) {
            errorDiv.style.display = 'block';
            errorDiv.textContent = 'Số lượng phải lớn hơn 0';
        } else {
            errorDiv.style.display = 'none';
        }
    }

    // Add form validation
    document.querySelector('form').addEventListener('submit', function(e) {
        const quantityInputs = document.querySelectorAll('.quantity-input');
        let hasError = false;
        
        quantityInputs.forEach(input => {
            const value = parseInt(input.value);
            if (isNaN(value) || value <= 0) {
                const errorDiv = input.parentElement.querySelector('.quantity-error');
                errorDiv.style.display = 'block';
                errorDiv.textContent = 'Số lượng phải lớn hơn 0';
                hasError = true;
            }
        });
        
        if (hasError) {
            e.preventDefault();
            alert('Vui lòng kiểm tra lại số lượng sản phẩm');
        }
    });
    </script>
</section>