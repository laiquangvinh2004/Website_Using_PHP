<?php
    if(!empty($_GET['msg'])){
        $msg = unserialize(urldecode($_GET['msg']));
        foreach($msg as $key => $value){
            echo '<span style = "color:blue; font-weight:bold">'.$value.'</span>';
        }
    }
?>

<h2 class = "add-category-title">THÊM DANH MỤC BÀI VIẾT</h2>
<div class = "col-md-12">
    <form action="<?php echo BASE_URL ?>post/insert_category" method = "POST">
    <div class="form-group">
        <label for="email">Tên danh mục</label>
        <input type="text" name = "title_category_post" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="pwd">Miêu tả danh mục</label>
        <input type="text" name = "desc_category_post" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-default">Thêm danh mục</button>
    </form>
</div>

<style>
.add-category-title {
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