<?php
    if(!empty($_GET['msg'])){
        $msg = unserialize(urldecode($_GET['msg']));
        foreach($msg as $key => $value){
            echo '<span style = "color:blue; font-weight:bold">'.$value.'</span>';
        }
    }
?>

<h3 style = "text-align: center;">LIỆT KÊ ĐƠN HÀNG</h3>
<table class="table table-striped">
    <thead>
      <tr>
        <th class="text-center" style="width: auto;">Id</th>
        <th class="text-center" style="width: auto;">Mã đơn hàng</th>
        <th class="text-center" style="width: auto;">Ngày đặt</th>
        <th class="text-center" style="width: auto;">Tình trạng</th>
        <th class="text-center" style="width: auto;">Quản lý</th>
      </tr>
    </thead>
    <tbody>
        <?php
        $i = 0;
        foreach($order as $key => $ord){
            $i++;
        ?>
      <tr>
        <td class="text-center"><?php echo $i ?></td>
        <td class="text-center"><?php echo $ord['order_code'] ?></td>
        <td class="text-center"><?php echo $ord['order_date'] ?></td>
        <td class="text-center"><?php if($ord['order_status']==0){echo 'Đơn hàng mới';}else{echo 'Đã xử lý';} ?></td>
        <td class="text-center">
            <a href="<?php echo BASE_URL ?>order/order_detail/<?php echo $ord['order_code'] ?>" class="btn-view">Xem đơn hàng</a>
            <a href="<?php echo BASE_URL ?>order/delete_order/<?php echo $ord['order_code'] ?>" class="btn-delete" onclick="return confirm('Bạn có chắc chắn muốn xóa đơn hàng này?')">Xóa</a>
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
        <?php if($data['current_page'] > 1): ?>
            <a href="?page=<?php echo $data['current_page'] - 1 ?>" class="pagination-link">&laquo; Trước</a>
        <?php endif; ?>
        
        <?php
        $start_page = max(1, $data['current_page'] - 2);
        $end_page = min($data['total_pages'], $data['current_page'] + 2);
        
        if($start_page > 1) {
            echo '<a href="?page=1" class="pagination-link">1</a>';
            if($start_page > 2) {
                echo '<span class="pagination-ellipsis">...</span>';
            }
        }
        
        for($i = $start_page; $i <= $end_page; $i++) {
            $active = ($i == $data['current_page']) ? 'active' : '';
            echo '<a href="?page='.$i.'" class="pagination-link '.$active.'">'.$i.'</a>';
        }
        
        if($end_page < $data['total_pages']) {
            if($end_page < $data['total_pages'] - 1) {
                echo '<span class="pagination-ellipsis">...</span>';
            }
            echo '<a href="?page='.$data['total_pages'].'" class="pagination-link">'.$data['total_pages'].'</a>';
        }
        ?>
        
        <?php if($data['current_page'] < $data['total_pages']): ?>
            <a href="?page=<?php echo $data['current_page'] + 1 ?>" class="pagination-link">Sau &raquo;</a>
        <?php endif; ?>
    </div>
  </div>

  <style>
    .btn-view, .btn-delete {
        padding: 6px 12px;
        border-radius: 4px;
        text-decoration: none;
        color: white;
        font-size: 14px;
        margin: 0 5px;
    }

    th, td {
    padding: 12px 15px;
    text-align: center;
    border-bottom: 1px solid #eee;
    font-size: 20px;
        }

    .btn-view {
        background-color: #2196F3;
    }

    .btn-delete {
        background-color: #f44336;
    }

    .btn-view:hover {
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
        padding: 6px 10px;
        color: #6c757d;
        font-size: 14px;
    }
  </style>