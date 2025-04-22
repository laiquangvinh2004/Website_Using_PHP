<?php
   $name = 'Danh mục chưa có sản phẩm';
   foreach($category_by_id as $key => $pro){
      $name = $pro['title_category_product'];
   }
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<section>
   <div class="bg_in">
      <div class="breadcrumbs">
         <ol itemscope itemtype="http://schema.org/BreadcrumbList">
            <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
               <a itemprop="item" href="<?php echo BASE_URL ?>">
               <span itemprop="name">Trang chủ</span></a>
               <meta itemprop="position" content="1" />
            </li>
            <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
               <a itemprop="item" href="sanpham.php">
               <span itemprop="name"><?php echo $name ?></span></a>
               <meta itemprop="position" content="2" />
            </li>
         </ol>
      </div>
      <div class="category-container">
         <div class="category-header">
            <h1>DANH MỤC: <?php echo $name ?></h1>
         </div>
         <div class="products-grid">
            <?php foreach($category_by_id as $key => $product){ ?>
            <div class="product-card">
               <form action="<?php echo BASE_URL ?>giohang/themgiohang" method="POST">
                  <input type="hidden" value="<?php echo $product['id_product'] ?>" name="product_id">
                  <input type="hidden" value="<?php echo $product['title_product'] ?>" name="product_title">
                  <input type="hidden" value="<?php echo $product['image_product'] ?>" name="product_image">
                  <input type="hidden" value="<?php echo $product['price_product'] ?>" name="product_price">
                  <input type="hidden" value="1" name="product_quantity">
                  <div class="product-image">
                     <a href="<?php echo BASE_URL ?>sanpham/chitietsanpham/<?php echo $product['id_product'] ?>">
                        <img src="<?php echo BASE_URL ?>public/upload/product/<?php echo $product['image_product'] ?>" alt="<?php echo $product['title_product'] ?>">
                     </a>
                  </div>
                  <div class="product-info">
                     <h3>
                        <a href="<?php echo BASE_URL ?>sanpham/chitietsanpham/<?php echo $product['id_product'] ?>">
                           <?php echo $product['title_product'] ?>
                        </a>
                     </h3>
                     <div class="product-price">
                        <?php echo number_format($product['price_product'], 0, ',', '.').'đ' ?>
                     </div>
                     <button type="submit" class="add-to-cart-btn">
                        <i class="fas fa-shopping-cart"></i> Đặt hàng
                     </button>
                  </div>
               </form>
            </div>
            <?php } ?>
         </div>
      </div>
   </div>
</section>

<style>
.category-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

.category-header {
    margin-bottom: 30px;
    text-align: center;
}

.category-header h1 {
    color: #333;
    font-size: 24px;
    margin: 0;
}

.products-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 20px;
}

.product-card {
    background: #fff;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
    height: 375px;
}

.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
}

.product-image {
    padding: 15px;
    background: #f8f9fa;
    text-align: center;
    height: 200px;
}

.product-image img {
    width: 100%;
    height: 100%;
    object-fit: contain;
}

.product-info {
    padding: 15px;
    text-align: center;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.product-info h3 {
    margin: 0 0 10px 0;
    font-size: 14px;
    line-height: 1.4;
    height: 40px;
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
}

.product-info h3 a {
    color: #333;
    text-decoration: none;
}

.product-info h3 a:hover {
    color: #28a745;
}

.product-price {
    color: #e60000;
    font-weight: bold;
    font-size: 18px;
    margin-bottom: 15px;
    text-align: center;
}

.add-to-cart-btn {
    width: 80%;
    padding: 8px;
    background: #28a745;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 13px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    transition: background 0.3s ease;
    margin: 0 auto;
}

.add-to-cart-btn:hover {
    background: #218838;
}

@media (max-width: 768px) {
    .products-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 480px) {
    .products-grid {
        grid-template-columns: 1fr;
    }
}
</style>