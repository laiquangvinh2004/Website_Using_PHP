<?php
    if(!empty($_GET['msg'])){
        $msg = unserialize(urldecode($_GET['msg']));
        foreach($msg as $key => $value){
            echo '<div class="alert alert-success">'.$value.'</div>';
        }
    }
?>

<div class="product-edit">
    <h2 class = "product-edit-title">Cập nhật sản phẩm</h2>
    
    <div class="form-container">
        <?php
        foreach($productbyid as $key => $pro){
        ?>
        <form action="<?php echo BASE_URL ?>product/update_product/<?php echo $pro['id_product'] ?>" method="POST" enctype="multipart/form-data" onsubmit="return validateFile()">
            <div class="form-group">
                <label>Tên sản phẩm</label>
                <input type="text" value="<?php echo $pro['title_product'] ?>" name="title_product" required>
            </div>

            <div class="form-group">
                <label>Hình ảnh sản phẩm</label>
                <input type="file" name="image_product" id="image_product" accept=".jpg,.jpeg,.png">
                <small class="text-muted">Chỉ chấp nhận file JPG và PNG</small>
                <div class="current-image">
                    <img src="<?php echo BASE_URL ?>public/upload/product/<?php echo $pro['image_product'] ?>" alt="Current product image">
                </div>
            </div>

            <div class="form-group">
                <label>Giá sản phẩm</label>
                <input type="text" value="<?php echo $pro['price_product'] ?>" name="price_product" required>
            </div>

            <div class="form-group">
                <label>Số lượng sản phẩm</label>
                <input type="text" value="<?php echo $pro['quantity_product'] ?>" name="quantity_product" required>
            </div>

            <div class="form-group">
                <label>Miêu tả danh mục</label>
                <textarea name="desc_product" rows="5"><?php echo $pro['desc_product'] ?></textarea>
            </div>

            <div class="form-group">
                <label>Danh mục sản phẩm</label>
                <select name="category_product">
                    <?php
                    foreach($category as $key => $cate){
                    ?>
                    <option <?php if($cate['id_category_product'] == $pro['id_category_product']){echo 'selected';}?>
                        value="<?php echo $cate['id_category_product'] ?>"><?php echo $cate['title_category_product'] ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label>Sản phẩm hot</label>
                <select name="product_hot">
                    <?php
                    if($pro['product_hot'] == 0){
                    ?>
                    <option selected value="0">Không</option>
                    <option value="1">Có</option>
                    <?php
                    }else{
                    ?>
                    <option value="0">Không</option>
                    <option selected value="1">Có</option>
                    <?php
                    }
                    ?>
                </select>
            </div>

            <div class="form-buttons">
                <button type="submit" class="btn-update">Cập nhật sản phẩm</button>
                <a href="<?php echo BASE_URL ?>product/list_product" class="btn-cancel">Hủy</a>
            </div>
        </form>
        <?php
        }
        ?>
    </div>
</div>

<script>
function validateFile() {
    var fileInput = document.getElementById('image_product');
    var filePath = fileInput.value;
    
    // Skip validation if no file is selected (file upload is optional in edit form)
    if (!filePath) {
        return true;
    }
    
    var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
    
    if (!allowedExtensions.exec(filePath)) {
        alert('Vui lòng chọn file ảnh có định dạng JPG hoặc PNG');
        fileInput.value = '';
        return false;
    }
    return true;
}
</script>

<style>
.product-edit {
    padding: 40px;
}

.product-edit h2 {
    margin-bottom: 30px;
    color: #333;
    font-size: 28px;
    text-align: center;
}

.alert {
    padding: 15px;
    margin-bottom: 20px;
    border-radius: 6px;
    background-color: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
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
.form-group select,
.form-group textarea {
    width: 100%;
    padding: 12px 16px;
    border: 1px solid #ddd;
    border-radius: 6px;
    font-size: 16px;
    transition: border-color 0.3s ease;
}

.form-group input[type="file"] {
    padding: 8px;
}

.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {
    border-color: #4CAF50;
    outline: none;
    box-shadow: 0 0 0 2px rgba(76, 175, 80, 0.1);
}

.form-group textarea {
    height: 120px;
    resize: vertical;
}

.current-image {
    margin-top: 10px;
}

.current-image img {
    height: 150px;
    width: auto;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
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
    flex: 1;
}

.btn-update {
    background-color: #4CAF50;
    color: white;
}

.btn-cancel {
    background-color: #f44336;
    color: white;
}

.btn-update:hover {
    background-color: #45a049;
    transform: translateY(-1px);
}

.btn-cancel:hover {
    background-color: #da190b;
    transform: translateY(-1px);
}

.text-muted {
    color: #6c757d;
    font-size: 14px;
    margin-top: 5px;
    display: block;
}

.product-edit-title {
    text-align: center;
    font-size: 30px;
    font-weight: bold;
    color: #2196F3;
    letter-spacing: 2px;
    margin-bottom: 30px;
    margin-top: 10px;
    text-shadow: 1px 2px 8px rgba(33,150,243,0.15);
    background: linear-gradient(90deg, #2196F3 0%, #21CBF3 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}
</style>