<section class="auth-section">
    <?php
    if(!empty($_GET['msg'])){
        $msg = unserialize(urldecode($_GET['msg']));
        foreach($msg as $key => $value){
            echo '<div class="alert alert-info">'.$value.'</div>';
        }
    }
    ?>
    <div class="container">
        <div class="auth-container">
            <!-- Login Form -->
            <div class="auth-box login-box">
                <h2>Đăng nhập</h2>
                <form action="<?php echo BASE_URL ?>khachhang/login_customer" method="POST" class="auth-form">
                    <div class="form-group">
                        <label for="login-email">Email</label>
                        <input type="email" id="login-email" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="login-password">Mật khẩu</label>
                        <input type="password" id="login-password" name="password" required>
                    </div>
                    <button type="submit" name="dangnhap" class="auth-button">Đăng nhập</button>
                </form>
            </div>

            <!-- Register Form -->
            <div class="auth-box register-box">
                <h2>Đăng ký</h2>
                <form action="<?php echo BASE_URL ?>khachhang/insert_dangky" method="POST" class="auth-form">
                    <div class="form-group">
                        <label for="reg-name">Họ và tên</label>
                        <input type="text" id="reg-name" name="txtHoTen" required>
                    </div>
                    <div class="form-group">
                        <label for="reg-phone">Số điện thoại</label>
                        <input type="tel" id="reg-phone" name="txtDienThoai" required>
                    </div>
                    <div class="form-group">
                        <label for="reg-address">Địa chỉ</label>
                        <input type="text" id="reg-address" name="txtDiaChi" required>
                    </div>
                    <div class="form-group">
                        <label for="reg-email">Email</label>
                        <input type="email" id="reg-email" name="txtEmail" required>
                    </div>
                    <div class="form-group">
                        <label for="reg-password">Mật khẩu</label>
                        <input type="password" id="reg-password" name="txtPassword" required>
                    </div>
                    <button type="submit" name="dangky" class="auth-button">Đăng ký</button>
                </form>
            </div>
        </div>
    </div>

    <style>
    .auth-section {
        padding: 50px 0;
        background-color: #f8f9fa;
        min-height: 100vh;
    }

    .auth-container {
        display: flex;
        justify-content: center;
        gap: 30px;
        flex-wrap: wrap;
        max-width: 1200px;
        margin: 0 auto;
    }

    .auth-box {
        background: white;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0,0,0,0.1);
        width: 100%;
        max-width: 400px;
    }

    .auth-box h2 {
        color: #333;
        text-align: center;
        margin-bottom: 30px;
        font-size: 24px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        color: #555;
        font-weight: 500;
    }

    .form-group input {
        width: 100%;
        padding: 12px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 14px;
        transition: border-color 0.3s;
    }

    .form-group input:focus {
        border-color: #007bff;
        outline: none;
        box-shadow: 0 0 0 2px rgba(0,123,255,0.25);
    }

    .auth-button {
        width: 100%;
        padding: 12px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        font-weight: 500;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .auth-button:hover {
        background-color: #0056b3;
    }

    .alert {
        padding: 15px;
        margin-bottom: 20px;
        border: 1px solid transparent;
        border-radius: 4px;
        text-align: center;
    }

    .alert-info {
        color: #0c5460;
        background-color: #d1ecf1;
        border-color: #bee5eb;
    }

    @media (max-width: 768px) {
        .auth-container {
            padding: 20px;
        }
        
        .auth-box {
            max-width: 100%;
        }
    }
    </style>

    <script>
    // Phone number validation
    document.getElementById('reg-phone').addEventListener('input', function(e) {
        this.value = this.value.replace(/[^0-9]/g, '');
    });

    // Email validation
    function validateEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }

    document.querySelectorAll('input[type="email"]').forEach(function(input) {
        input.addEventListener('blur', function() {
            if (!validateEmail(this.value)) {
                this.setCustomValidity('Vui lòng nhập email hợp lệ');
            } else {
                this.setCustomValidity('');
            }
        });
    });
    </script>
</section>