<?php
    if(!empty($_GET['msg'])){
        $msg = unserialize(urldecode($_GET['msg']));
        foreach($msg as $key => $value){
            echo '<span style = "color:blue; font-weight:bold">'.$value.'</span>';
        }
    }
?>

<h3 style = "text-align: center;">LIỆT KÊ DANH MỤC BÀI VIẾT</h3>
<table class="table table-striped">
    <thead>
      <tr>
        <th class="text-center" style="width: auto;">Id</th> 
        <th class="text-center" style="width: auto;">Tên danh mục</th>
        <th class="text-center" style="width: auto;">Mô tả</th>
        <th class="text-center" style="width: auto;">Quản lý</th>
      </tr>
    </thead>
    <tbody>
        <?php
        $i = 0;
        foreach($category as $key => $cate){
            $i++;
        ?>
      <tr>
        <td><?php echo $i ?></td>
        <td><?php echo $cate['title_category_post'] ?></td>
        <td><?php echo $cate['desc_category_post'] ?></td>
        <td class = "actions">
          <a href ="<?php echo BASE_URL ?>post/delete_category/<?php echo $cate['id_category_post'] ?>" class = "btn-delete" onclick="return confirm('Bạn có chắc chắn muốn xóa đơn hàng này?')">Xóa</a>
          <a href ="<?php echo BASE_URL ?>post/edit_category/<?php echo $cate['id_category_post'] ?>" class = "btn-edit">Cập nhật</a>
        </td>
      </tr>
      <?php
        }
        ?>
    </tbody>
  </table>

  <style>
.customer-list {
    padding: 20px;
}

.customer-list h2 {
    margin-bottom: 20px;
    color: #333;
}

.table-container {
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    overflow-x: auto;
}

table {
    width: 100%;
    border-collapse: collapse;
    min-width: 800px;
}

th, td {
    padding: 12px 15px;
    text-align: center;
    border-bottom: 1px solid #eee;
    font-size: 20px;
}

th {
    background-color: #f8f9fa;
    font-weight: 600;
    color: #333;
}

tr:hover {
    background-color: #f5f5f5;
}

tbody tr:last-child td {
    border-bottom: none;
}

.actions {
    gap: 8px;
}

.btn-edit,
.btn-delete {
    padding: 6px 12px;
    border-radius: 4px;
    text-decoration: none;
    color: white;
    font-size: 14px;
}

.btn-edit {
    background-color: #2196F3;
}

.btn-delete {
    background-color: #f44336;
}

.btn-edit:hover {
    background-color: #1976D2;
}

.btn-delete:hover {
    background-color: #da190b;
}
</style>