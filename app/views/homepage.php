<section>
   <div class="bg_in">
   <div class="module_pro_all">
      <div class="box-title">
         <div class="title-bar">
            <h1>Sản phẩm HOT</h1>
         </div>
      </div>
      <div class="pro_all_gird">
         <div class="girds_all list_all_other_page ">
         <?php
            foreach($product_home as $key => $product){
                if($product['product_hot']){
            ?>
            <form action ="<?php echo BASE_URL ?>giohang/themgiohang" method = "POST">
            <input type ="hidden" value = "<?php echo $product['id_product'] ?>" name = "product_id">
            <input type ="hidden" value = "<?php echo $product['title_product'] ?>" name = "product_title">
            <input type ="hidden" value = "<?php echo $product['image_product'] ?>" name = "product_image">
            <input type ="hidden" value = "<?php echo $product['price_product'] ?>" name = "product_price">
            <input type ="hidden" value = "1" name = "product_quantity">
            <div class="grids">
               <div class="grids_in">
                  <div class="content">
                     <div class="img-right-pro">
                        <a href="sanpham.php">
                        <img class="lazy img-pro content-image" src="<?php echo BASE_URL ?>public/upload/product/<?php echo $product['image_product'] ?>" data-original="image/iphone.png" alt=<?php echo $product['title_product']?> />
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
                        <button type="submit" class="order-button" name="addcart">
                            <i class="fas fa-shopping-cart"></i> Đặt hàng
                        </button>
                     </div>
                  </div>
               </div>
            </div>
            </form>
            <?php
                }
            }
            ?>
            <div class="clear"></div>
         </div>
         <div class="clear"></div>
      </div>
      <div class="clear"></div>
   </div>
   <?php
   foreach($category as $key => $cate){
   ?>
   <div class="module_pro_all">
      <div class="box-title">
         <div class="title-bar">
            <h1><?php echo $cate['title_category_product'] ?></h1>
            <a class="read_more" href="<?php echo BASE_URL ?>sanpham/danhmuc/<?php echo $cate['id_category_product'] ?>">
            Xem thêm
            </a>
         </div>
      </div>
      <div class="pro_all_gird">
         <div class="girds_all list_all_other_page ">
            <?php
               foreach($product_home as $key => $pro_cate){
                  if($cate['id_category_product'] == $pro_cate['id_category_product']){
            ?>
            <form action ="<?php echo BASE_URL ?>/giohang/themgiohang" method = "POST">
            <input type ="hidden" value = "<?php echo $pro_cate['id_product'] ?>" name = "product_id">
            <input type ="hidden" value = "<?php echo $pro_cate['title_product'] ?>" name = "product_title">
            <input type ="hidden" value = "<?php echo $pro_cate['image_product'] ?>" name = "product_image">
            <input type ="hidden" value = "<?php echo $pro_cate['price_product'] ?>" name = "product_price">
            <input type ="hidden" value = "1" name = "product_quantity">
            <div class="grids">
               <div class="grids_in">
                  <div class="content">
                     <div class="img-right-pro">
                        <a href="sanpham.php">
                        <img class="lazy img-pro content-image" src="<?php echo BASE_URL ?>public/upload/product/<?php echo $pro_cate['image_product'] ?>" data-original="image/iphone.png" alt="Máy in Canon MF229DW" />
                        </a>
                        <div class="content-overlay"></div>
                        <div class="content-details fadeIn-top">
                           <?php echo $pro_cate['desc_product']?>
                        </div>
                     </div>
                     <div class="name-pro-right">
                        <a href="<?php echo BASE_URL ?>sanpham/chitietsanpham/<?php echo $pro_cate['id_product'] ?>">
                           <h3><?php echo $pro_cate['title_product']?></h3>
                        </a>
                     </div>
                     <div class="price_old_new">
                        <div class="price">
                           <span class="news_price"><?php echo number_format($pro_cate['price_product'], 0, ',', '.').'đ'?> </span>
                        </div>
                     </div>
                     <div class="add_card">        
                        <button type="submit" class="order-button" name="addcart">
                            <i class="fas fa-shopping-cart"></i> Đặt hàng
                        </button>
                     </div>
                  </div>
               </div>
            </div>
            </form>
            <?php
               }
            }
            ?>
            <div class="clear"></div>
         </div>
         <div class="clear"></div>
      </div>
      <div class="clear"></div>
   </div>
   <?php
   }
   ?>
</section>
<!--end:body-->
<div class="clear"></div>
<style>
/* Add Font Awesome CDN */
@import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css');

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

.order-button {
    background-color: #28a745;
    color: white;
    border: none;
    border-radius: 5px;
    padding: 10px 20px;
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
    width: 100%;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
}

.order-button:hover {
    background-color: #218838;
    transform: translateY(-2px);
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.add_card {
    padding: 0 10px 10px;
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

.name-pro-right a {
    color: #333;
    text-decoration: none;
}

.name-pro-right a:hover {
    color: #28a745;
}

.read_more {
    float: right;
    color: #fff;
    text-decoration: none;
    background: #333;
    padding: 5px 10px;
    border-radius: 3px;
    font-size: 12px;
}

.read_more:hover {
    background: #444;
}

@media (max-width: 768px) {
    .pro_all_gird {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 480px) {
    .pro_all_gird {
        grid-template-columns: 1fr;
    }
}
</style>