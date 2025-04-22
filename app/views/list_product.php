<section>
   <div class="bg_in">
   <div class="breadcrumbs">
      <ol itemscope itemtype="http://schema.org/BreadcrumbList">
         <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
            <a itemprop="item" href=".">
            <span itemprop="name">Trang chủ</span></a>
            <meta itemprop="position" content="1" />
         </li>
         <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
            <a itemprop="item" href="sanpham.php">
            <span itemprop="name">Tất cả sản phẩm</span></a>
            <meta itemprop="position" content="2" />
         </li>
      </ol>
   </div>
   <div class="module_pro_all">
      <div class="box-title">
         <div class="title-bar">
            <h1>Tất cả sản phẩm</h1>
         </div>
      </div>
      <div class="pro_all_gird">
        <style type="text/css">
            .grids.grids-list-product{
                height:375px;
            }
            .price_old_new {
                padding: 10px;
                margin-bottom: 10px;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .price {
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .news_price {
                color: #e60000;
                font-size: 18px;
                font-weight: 600;
                text-align: center;
            }

            .grids_in .content {
                display: flex;
                flex-direction: column;
                align-items: center;
            }

            .name-pro-right {
                flex-grow: 1;
                padding: 10px;
                min-height: 60px;
                width: 100%;
            }

            .name-pro-right h3 {
                margin: 0;
                font-size: 14px;
                line-height: 1.4;
                height: 40px;
                overflow: hidden;
                text-overflow: ellipsis;
                display: -webkit-box;
                -webkit-line-clamp: 2;
                -webkit-box-orient: vertical;
                text-align: center;
            }

            .add_card {
                padding: 0 10px 10px;
                width: 100%;
                text-align: center;
            }

            .add-to-cart-btn {
                display: inline-block;
                background-color: #28a745;
                color: white;
                border: none;
                border-radius: 5px;
                padding: 10px 20px;
                font-size: 14px;
                font-weight: 500;
                cursor: pointer;
                transition: all 0.3s ease;
                text-decoration: none;
                width: 100%;
                max-width: 150px;
            }

            .add-to-cart-btn:hover {
                background-color: #218838;
                transform: translateY(-2px);
                box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            }

            .add-to-cart-btn i {
                margin-right: 5px;
            }

            .hot-badge {
                display: inline-block;
                background-color: #ff4444;
                color: white;
                padding: 4px 8px;
                border-radius: 4px;
                font-size: 12px;
                font-weight: bold;
                margin-top: 5px;
                box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            }

            .name-pro-right {
                padding: 10px;
                min-height: 60px;
                width: 100%;
            }
        </style>
         <div class="girds_all list_all_other_page ">
            <?php
            foreach($list_product as $key => $product){
            ?>
            <div class="grids grids-list-product">
               <div class="grids_in">
                  <div class="content">
                     <div class="img-right-pro">
                        <a href="sanpham.php">
                        <img class="lazy img-pro content-image" src="<?php echo BASE_URL ?>public/upload/product/<?php echo $product['image_product'] ?>" data-original="image/iphone.png" alt="Máy in Canon MF229DW" />
                        </a>
                        <div class="content-overlay"></div>
                        <div class="content-details fadeIn-top">
                           <?php echo $product['desc_product']?>
                        </div>
                     </div>
                     <div class="name-pro-right">
                        <a href="<?php echo BASE_URL ?>sanpham/chitietsanpham/<?php echo $product['id_product'] ?>">
                           <h3><?php echo $product['title_product']?></h3>
                        </a>
                     </div>
                     <div class="price_old_new">
                        <div class="price">
                           <span class="news_price"><?php echo number_format($product['price_product'], 0, ',', '.').'đ'?> </span>
                        </div>
                     </div>
                     <div class="add_card">
                        <form action="<?php echo BASE_URL ?>/giohang/themgiohang" method="POST">
                           <input type="hidden" name="product_id" value="<?php echo $product['id_product'] ?>">
                           <input type="hidden" name="product_title" value="<?php echo $product['title_product'] ?>">
                           <input type="hidden" name="product_image" value="<?php echo $product['image_product'] ?>">
                           <input type="hidden" name="product_price" value="<?php echo $product['price_product'] ?>">
                           <input type="hidden" name="product_quantity" value="1">
                           <button type="submit" class="add-to-cart-btn">
                              <i class="fa fa-shopping-cart" aria-hidden="true"></i> Đặt hàng
                           </button>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
            <?php
            }
            ?>
            <div class="clear"></div>
         </div>
         <div class="clear"></div>
      </div>
      <div class="clear"></div>
   </div>

   <!-- Hot Products Section -->
   <div class="module_pro_all" style="margin-top: 50px;">
      <div class="box-title">
         <div class="title-bar">
            <h1>Sản phẩm hot</h1>
         </div>
      </div>
      <div class="pro_all_gird">
         <div class="girds_all list_all_other_page">
            <?php
            foreach($list_product as $key => $product){
                if($product['product_hot'] == 1){
            ?>
            <div class="grids grids-list-product">
               <div class="grids_in">
                  <div class="content">
                     <div class="img-right-pro">
                        <a href="sanpham.php">
                        <img class="lazy img-pro content-image" src="<?php echo BASE_URL ?>public/upload/product/<?php echo $product['image_product'] ?>" data-original="image/iphone.png" alt="Máy in Canon MF229DW" />
                        </a>
                        <div class="content-overlay"></div>
                        <div class="content-details fadeIn-top">
                           <?php echo $product['desc_product']?>
                        </div>
                     </div>
                     <div class="name-pro-right">
                        <a href="<?php echo BASE_URL ?>sanpham/chitietsanpham/<?php echo $product['id_product'] ?>">
                           <h3><?php echo $product['title_product']?></h3>
                        </a>
                     </div>
                     <div class="price_old_new">
                        <div class="price">
                           <span class="news_price"><?php echo number_format($product['price_product'], 0, ',', '.').'đ'?> </span>
                        </div>
                     </div>
                     <div class="add_card">
                        <form action="<?php echo BASE_URL ?>/giohang/themgiohang" method="POST">
                           <input type="hidden" name="product_id" value="<?php echo $product['id_product'] ?>">
                           <input type="hidden" name="product_title" value="<?php echo $product['title_product'] ?>">
                           <input type="hidden" name="product_image" value="<?php echo $product['image_product'] ?>">
                           <input type="hidden" name="product_price" value="<?php echo $product['price_product'] ?>">
                           <input type="hidden" name="product_quantity" value="1">
                           <button type="submit" class="add-to-cart-btn">
                              <i class="fa fa-shopping-cart" aria-hidden="true"></i> Đặt hàng
                           </button>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
            <?php
                }
            }
            ?>
            <div class="clear"></div>
         </div>
      </div>
   </div>
</section>

<!-- Pagination -->
<div class="pagination-container">
    <div class="pagination">
        <?php if($current_page > 1): ?>
            <a href="?page=<?php echo $current_page - 1 ?>" class="pagination-link">&laquo; Trước</a>
        <?php endif; ?>
        
        <?php
        $start_page = max(1, $current_page - 2);
        $end_page = min($total_pages, $current_page + 2);
        
        if($start_page > 1) {
            echo '<a href="?page=1" class="pagination-link">1</a>';
            if($start_page > 2) {
                echo '<span class="pagination-ellipsis">...</span>';
            }
        }
        
        for($i = $start_page; $i <= $end_page; $i++) {
            $active = ($i == $current_page) ? 'active' : '';
            echo '<a href="?page='.$i.'" class="pagination-link '.$active.'">'.$i.'</a>';
        }
        
        if($end_page < $total_pages) {
            if($end_page < $total_pages - 1) {
                echo '<span class="pagination-ellipsis">...</span>';
            }
            echo '<a href="?page='.$total_pages.'" class="pagination-link">'.$total_pages.'</a>';
        }
        ?>
        
        <?php if($current_page < $total_pages): ?>
            <a href="?page=<?php echo $current_page + 1 ?>" class="pagination-link">Sau &raquo;</a>
        <?php endif; ?>
    </div>
</div>

<style>
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
    padding: 8px 12px;
    background-color: #f8f9fa;
    color: #333;
    text-decoration: none;
    border-radius: 4px;
    transition: all 0.3s ease;
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
}
</style>