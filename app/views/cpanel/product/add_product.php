<?php
    if(!empty($_GET['msg'])){
        $msg = unserialize(urldecode($_GET['msg']));
        foreach($msg as $key => $value){
            echo '<span style = "color:blue; font-weight:bold">'.$value.'</span>';
        }
    }
?>

<h2 class="add-product-title">THÊM SẢN PHẨM</h2>
<div class = "col-md-12">
    <form action="<?php echo BASE_URL ?>product/insert_product" method = "POST" enctype = "multipart/form-data" onsubmit="return validateFile()" onsuccess="console.log('Product added successfully:', {
        title: this.querySelector('[name=title_product]').value,
        price: this.querySelector('[name=price_product]').value,
        quantity: this.querySelector('[name=quantity_product]').value,
        category: this.querySelector('[name=category_product]').options[this.querySelector('[name=category_product]').selectedIndex].text,
        isHot: this.querySelector('[name=product_hot]').value === '1' ? 'Yes' : 'No'
    });">
    <div class="form-group">
        <label for="email">Tên sản phẩm</label>
        <input type="text" name = "title_product" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="email">Hình ảnh sản phẩm</label>
        <input type="file" name = "image_product" id="image_product" class="form-control" accept=".jpg,.jpeg,.png" required>
        <small class="text-muted">Chỉ chấp nhận file JPG và PNG</small>
    </div>
    <div class="form-group">
        <label for="text">Giá sản phẩm</label>
        <input type="tel" name="price_product" class="form-control" required>
        <span class="text-danger" id="price-warning" style="display: none;">Giá sản phẩm phải lớn hơn 0</span>
    </div>
    <div class="form-group">
        <label for="email">Đơn vị</label>
        <input type="text" name = "quantity_product" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="pwd">Miêu tả danh mục</label>
        <textarea name = "desc_product" rows="5" style="resize: none" class="form-control" required></textarea>
    </div>
    <div class="form-group">
        <label for="pwd">Danh mục sản phẩm</label>
        <select class = "form-control" name = "category_product">
            <?php
            foreach($category as $key => $cate){
            ?>
            <option value ="<?php echo $cate['id_category_product'] ?>"><?php echo $cate['title_category_product'] ?></option>
            <?php
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="pwd">Sản phẩm hot</label>
        <select class = "form-control" name = "product_hot">
            <option value="0">Không</option>
            <option value="1">Có</option>
        </select>
    </div>
    <button type="submit" class="btn btn-default">Thêm sản phẩm</button>
    </form>
</div>

<script>
function validateFile() {
    var fileInput = document.getElementById('image_product');
    var filePath = fileInput.value;
    
    var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
    
    if (!allowedExtensions.exec(filePath)) {
        alert('Vui lòng chọn file ảnh có định dạng JPG hoặc PNG');
        fileInput.value = '';
        return false;
    }
    return true;
}

document.querySelector('form').addEventListener('submit', function(e) {
    var priceInput = document.querySelector('input[name="price_product"]');
    var price = parseFloat(priceInput.value);
    var warning = document.getElementById('price-warning');
    
    if (price <= 0 || isNaN(price)) {
        e.preventDefault();
        warning.style.display = 'block';
        priceInput.focus();
    } else {
        warning.style.display = 'none';
    }
});

document.querySelector('input[name="price_product"]').addEventListener('input', function() {
    var warning = document.getElementById('price-warning');
    warning.style.display = 'none';
});
</script>

<style>
.text-muted {
    color: #6c757d;
    font-size: 14px;
    margin-top: 5px;
    display: block;
}
.add-product-title {
    text-align: center;
    font-size: 35px;
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