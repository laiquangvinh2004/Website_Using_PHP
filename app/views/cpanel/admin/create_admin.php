<?php
    if(!empty($_GET['msg'])){
        $msg = unserialize(urldecode($_GET['msg']));
        foreach($msg as $key => $value){
            echo '<div class="alert alert-danger">'.$value.'</div>';
        }
    }
?>

<div class="admin-create-container">
    <div class="admin-create-wrapper">
        <div class="admin-create-header">
            <h2>TẠO TÀI KHOẢN ADMIN</h2>
            <p>Vui lòng điền thông tin để tạo tài khoản admin mới</p>
        </div>
        
        <form action="<?php echo BASE_URL ?>/login/create_admin" method="POST" class="admin-create-form">
            <div class="form-group">
                <label for="username">Tên đăng nhập</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Nhập tên đăng nhập" required>
                </div>
            </div>
            
            <div class="form-group">
                <label for="password">Mật khẩu</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu" required>
                </div>
            </div>
            
            <div class="form-group">
                <label for="confirm_password">Xác nhận mật khẩu</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Nhập lại mật khẩu" required>
                </div>
            </div>
            
            <div class="form-group">
                <label for="email">Email</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Nhập email" required>
                </div>
            </div>
            
            <div class="form-group">
                <button type="submit" class="btn-create-admin">Tạo tài khoản</button>
            </div>
        </form>
    </div>
</div>

<style>
.admin-create-container {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    padding: 20px;
    background: linear-gradient(135deg, #1a2a6c, #b21f1f, #fdbb2d);
    background-size: 400% 400%;
    animation: gradient 15s ease infinite;
}

@keyframes gradient {
    0% {
        background-position: 0% 50%;
    }
    50% {
        background-position: 100% 50%;
    }
    100% {
        background-position: 0% 50%;
    }
}

.admin-create-wrapper {
    background: rgba(255, 255, 255, 0.95);
    padding: 40px;
    border-radius: 10px;
    box-shadow: 0 0 30px rgba(0,0,0,0.2);
    width: 100%;
    max-width: 450px;
    backdrop-filter: blur(10px);
}

.admin-create-header {
    text-align: center;
    margin-bottom: 30px;
}

.admin-create-header h2 {
    color: #333;
    font-size: 28px;
    margin-bottom: 10px;
    font-weight: 600;
}

.admin-create-header p {
    color: #666;
    font-size: 16px;
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    margin-bottom: 8px;
    color: #333;
    font-weight: 500;
}

.input-group {
    position: relative;
    display: flex;
    align-items: center;
}

.input-group-text {
    background-color: #f8f9fa;
    border: 1px solid #ced4da;
    border-right: none;
    padding: 10px 15px;
    border-radius: 5px 0 0 5px;
    color: #666;
}

.form-control {
    width: 100%;
    padding: 12px 15px;
    border: 1px solid #ced4da;
    border-radius: 0 5px 5px 0;
    font-size: 16px;
    transition: all 0.3s ease;
}

.form-control:focus {
    border-color: #1a2a6c;
    outline: none;
    box-shadow: 0 0 0 0.2rem rgba(26, 42, 108, 0.25);
}

.btn-create-admin {
    width: 100%;
    padding: 12px;
    background: linear-gradient(45deg, #1a2a6c, #b21f1f);
    color: white;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-create-admin:hover {
    background: linear-gradient(45deg, #b21f1f, #1a2a6c);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.alert {
    padding: 15px;
    margin-bottom: 20px;
    border-radius: 5px;
    text-align: center;
}

.alert-danger {
    background-color: #f8d7da;
    border-color: #f5c6cb;
    color: #721c24;
}

@media (max-width: 576px) {
    .admin-create-wrapper {
        padding: 30px 20px;
    }
    
    .admin-create-header h2 {
        font-size: 24px;
    }
}
</style> 