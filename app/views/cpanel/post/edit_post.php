<?php
    if(!empty($_GET['msg'])){
        $msg = unserialize(urldecode($_GET['msg']));
        foreach($msg as $key => $value){
            echo '<div class="alert alert-success">'.$value.'</div>';
        }
    }
?>

<div class="post-edit">
    <h2>Cập nhật bài viết</h2>
    
    <div class="form-container">
        <?php
        foreach($postbyid as $key => $pos){
        ?>
        <form action="<?php echo BASE_URL ?>/post/update_post/<?php echo $pos['id_post'] ?>" method="POST" enctype="multipart/form-data" onsubmit="return validateFile()">
            <div class="form-group">
                <label>Tên bài viết</label>
                <input type="text" value="<?php echo $pos['title_post'] ?>" name="title_post" required>
            </div>

            <div class="form-group">
                <label>Hình ảnh bài viết</label>
                <input type="file" name="image_post" id="image_post" accept=".jpg,.jpeg,.png">
                <small class="text-muted">Chỉ chấp nhận file JPG và PNG</small>
                <div class="current-image">
                    <img src="<?php echo BASE_URL ?>public/upload/post/<?php echo $pos['image_post'] ?>" alt="Current post image">
                </div>
            </div>

            <div class="form-group">
                <label>Miêu tả bài viết</label>
                <textarea name="content_post" rows="10"><?php echo $pos['content_post'] ?></textarea>
            </div>

            <div class="form-group">
                <label>Danh mục bài viết</label>
                <select name="category_post">
                    <?php
                    foreach($category as $key => $cate){
                    ?>
                    <option <?php if($cate['id_category_post'] == $pos['id_category_post']){echo 'selected';}?>
                        value="<?php echo $cate['id_category_post'] ?>"><?php echo $cate['title_category_post'] ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>

            <div class="form-buttons">
                <button type="submit" class="btn-update">Cập nhật bài viết</button>
                <a href="<?php echo BASE_URL ?>post/list_post" class="btn-cancel">Hủy</a>
            </div>
        </form>
        <?php
        }
        ?>
    </div>
</div>

<script>
function validateFile() {
    var fileInput = document.getElementById('image_post');
    var filePath = fileInput.value;
    
    // Skip validation if no file is selected (since it's optional in edit)
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
.post-edit {
    padding: 40px;
}

.post-edit h2 {
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
    height: 200px;
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
</style>