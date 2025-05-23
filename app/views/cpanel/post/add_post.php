<?php
    if(!empty($_GET['msg'])){
        $msg = unserialize(urldecode($_GET['msg']));
        foreach($msg as $key => $value){
            echo '<span style = "color:blue; font-weight:bold">'.$value.'</span>';
        }
    }
?>

<h2 class = "add-post-title">THÊM BÀI VIẾT</h2>
<div class = "col-md-12">
    <form action="<?php echo BASE_URL ?>/post/insert_post" method = "POST" enctype = "multipart/form-data" onsubmit="return validateFile()">
    <div class="form-group">
        <label for="email">Tên bài viết</label>
        <input type="text" name = "title_post" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="email">Hình ảnh bài viết</label>
        <input type="file" name = "image_post" id="image_post" class="form-control" accept=".jpg,.jpeg,.png" required>
        <small class="text-muted">Chỉ chấp nhận file JPG và PNG</small>
    </div>
    <div class="form-group">
        <label for="pwd">Chi tiết bài viết</label>
        <textarea name = "content_post" rows="10" style="resize: none" class="form-control" required></textarea>
    </div>
    <div class="form-group">
        <label for="pwd">Danh mục bài viết</label>
        <select class = "form-control" name = "category_post">
            <?php
            foreach($category as $key => $cate){
            ?>
            <option value ="<?php echo $cate['id_category_post'] ?>"><?php echo $cate['title_category_post'] ?></option>
            <?php
            }
            ?>
        </select>
    </div>
    <button type="submit" class="btn btn-default">Thêm bài viết</button>
    </form>
</div>

<script>
function validateFile() {
    var fileInput = document.getElementById('image_post');
    var filePath = fileInput.value;
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
.add-post-title {
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