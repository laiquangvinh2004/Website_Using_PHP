<?php
    if(!empty($_GET['msg'])){
        $msg = unserialize(urldecode($_GET['msg']));
        foreach($msg as $key => $value){
            echo '<span style = "color:blue; font-weight:bold">'.$value.'</span>';
        }
    }
?>

<h3 style = "text-align: center;">LIỆT KÊ BÀI VIẾT</h3>
<div class="posts-per-page" style="text-align: right; margin-bottom: 20px;">
    <form action="<?php echo BASE_URL ?>post/list_post" method="GET" style="display: inline-block;">
        <label for="category">Danh mục:</label>
        <select name="category" id="category" onchange="this.form.submit()" style="margin-right: 20px;">
            <option value="">Tất cả danh mục</option>
            <?php
            if(isset($categories) && !empty($categories)){
                foreach($categories as $category){
                    $selected = (isset($_GET['category']) && $_GET['category'] == $category['id_category_post']) ? 'selected' : '';
                    echo '<option value="'.$category['id_category_post'].'" '.$selected.'>'.$category['title_category_post'].'</option>';
                }
            }
            ?>
        </select>
        
        <label for="per_page">Số bài viết mỗi trang:</label>
        <select name="per_page" id="per_page" onchange="this.form.submit()">
            <option value="10" <?php echo (isset($_GET['per_page']) && $_GET['per_page'] == 10) ? 'selected' : ''; ?>>10</option>
            <option value="25" <?php echo (isset($_GET['per_page']) && $_GET['per_page'] == 25) ? 'selected' : ''; ?>>25</option>
            <option value="50" <?php echo (isset($_GET['per_page']) && $_GET['per_page'] == 50) ? 'selected' : ''; ?>>50</option>
        </select>
    </form>
</div>
<table class="table table-striped">
    <thead>
      <tr>
        <th class="text-center" style="width: 10%;">Id</th>
        <th class="text-center" style="width: 20%;">Tên bài viết</th>
        <th class="text-center" style="width: 20%;">Danh mục bài viết</th>
        <th class="text-center" style="width: 20%;">Hình ảnh</th>
        <th class="text-center" style="width: auto;">Quản lý</th>
      </tr>
    </thead>
    <tbody>
        <?php
        $i = 0;
        foreach($post as $key => $pos){
            $i++;
        ?>
      <tr>
        <td><?php echo $i ?></td>
        <td><?php echo $pos['title_post'] ?></td>
        <td><img src="<?php echo BASE_URL ?>public/upload/post/<?php echo $pos['image_post'] ?>" height = "100" width = "100"></td>
        <td><?php echo $pos['title_category_post'] ?></td>
        <td class = "actions">
          <a href ="<?php echo BASE_URL ?>post/delete_post/<?php echo $pos['id_post'] ?>" class = "btn-delete" onclick="return confirm('Bạn có chắc chắn muốn xóa đơn hàng này?')">Xóa</a>
          <a href ="<?php echo BASE_URL ?>post/edit_post/<?php echo $pos['id_post'] ?>" class = "btn-edit">Cập nhật</a>
        </td>
      </tr>
      <?php
        }
        ?>
    </tbody>
  </table>

  <!-- Pagination -->
  <div class="pagination-container">
      <div class="pagination">
          <?php if($current_page > 1): ?>
              <a href="?page=<?php echo $current_page - 1 ?><?php echo isset($_GET['per_page']) ? '&per_page='.$_GET['per_page'] : '' ?><?php echo isset($_GET['category']) ? '&category='.$_GET['category'] : '' ?>" class="pagination-link">&laquo; Trước</a>
          <?php endif; ?>
          
          <?php
          $start_page = max(1, $current_page - 2);
          $end_page = min($total_pages, $current_page + 2);
          
          if($start_page > 1) {
              echo '<a href="?page=1'.(isset($_GET['per_page']) ? '&per_page='.$_GET['per_page'] : '').(isset($_GET['category']) ? '&category='.$_GET['category'] : '').'" class="pagination-link">1</a>';
              if($start_page > 2) {
                  echo '<span class="pagination-ellipsis">...</span>';
              }
          }
          
          for($i = $start_page; $i <= $end_page; $i++) {
              $active = ($i == $current_page) ? 'active' : '';
              echo '<a href="?page='.$i.(isset($_GET['per_page']) ? '&per_page='.$_GET['per_page'] : '').(isset($_GET['category']) ? '&category='.$_GET['category'] : '').'" class="pagination-link '.$active.'">'.$i.'</a>';
          }
          
          if($end_page < $total_pages) {
              if($end_page < $total_pages - 1) {
                  echo '<span class="pagination-ellipsis">...</span>';
              }
              echo '<a href="?page='.$total_pages.(isset($_GET['per_page']) ? '&per_page='.$_GET['per_page'] : '').(isset($_GET['category']) ? '&category='.$_GET['category'] : '').'" class="pagination-link">'.$total_pages.'</a>';
          }
          ?>
          
          <?php if($current_page < $total_pages): ?>
              <a href="?page=<?php echo $current_page + 1 ?><?php echo isset($_GET['per_page']) ? '&per_page='.$_GET['per_page'] : '' ?><?php echo isset($_GET['category']) ? '&category='.$_GET['category'] : '' ?>" class="pagination-link">Sau &raquo;</a>
          <?php endif; ?>
      </div>
  </div>

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

.pagination-container {
    text-align: center;
    margin: 30px 0;
}

.pagination {
    display: inline-flex;
    gap: 5px;
}

.pagination-link {
        display: inline-block;
        padding: 6px 10px;
        background-color: #f8f9fa;
        color: #333;
        text-decoration: none;
        border-radius: 4px;
        transition: all 0.3s ease;
        font-size: 14px;
    }

.pagination-link:hover {
    background-color: #e9ecef;
}

.pagination-link.active {
    background-color: #28a745;
    color: white;
}

.pagination-ellipsis {
    padding: 8px 12px;
    color: #6c757d;
    width: auto;
}

.table>tbody>tr>td{
    padding: 8px;
    line-height: 1.42857143;
    vertical-align: top;
    border-top: 1px solid #ddd;
    width: auto;
}
</style>