<?php
    if(!empty($_GET['msg'])){
        $msg = unserialize(urldecode($_GET['msg']));
        foreach($msg as $key => $value){
            echo '<div class="alert alert-success">'.$value.'</div>';
        }
    }
?>

<div class="category-edit">
    <h2 class = "category-edit-title">Cập nhật danh mục bài viết</h2>
    
    <div class="form-container">
        <?php
        foreach($categorybyid as $key => $cate){
        ?>
        <form action="<?php echo BASE_URL ?>/post/update_category_post/<?php echo $cate['id_category_post'] ?>" method="POST">
            <div class="form-group">
                <label>Tên danh mục</label>
                <input type="text" value="<?php echo $cate['title_category_post'] ?>" name="title_category_post" required>
            </div>

            <div class="form-group">
                <label>Miêu tả danh mục</label>
                <textarea name="desc_category_post" rows="5"><?php echo trim($cate['desc_category_post']) ?></textarea>
            </div>

            <div class="form-buttons">
                <button type="submit" class="btn-update">Cập nhật danh mục</button>
                <a href="<?php echo BASE_URL ?>post/list_category" class="btn-cancel">Hủy</a>
            </div>
        </form>
        <?php
        }
        ?>
    </div>
</div>

<style>
.category-edit {
    padding: 40px;
}

.category-edit h2 {
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

.category-edit-title {
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