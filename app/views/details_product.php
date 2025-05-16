<?php
   foreach($details_product as $key => $value){
      $name_product = $value['title_product'];
      $name_category_product = $value['title_category_product'];
      $id_cate = $value['id_category_product'];
   }
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<section>
   <?php
      foreach($details_product as $key => $details){
      ?>
   <div class="bg_in">
      <?php
         }
         ?>
      <div class="wrapper_all_main">
         <div class="wrapper_all_main_right no-padding-left" style="width:100%;">
            <div class="breadcrumbs">
               <ol itemscope itemtype="http://schema.org/BreadcrumbList">
                  <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                     <a itemprop="item" href=".">
                     <span itemprop="name">Trang chủ</span></a>
                     <meta itemprop="position" content="1" />
                  </li>
                  <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                     <a itemprop="item" href="<?php echo BASE_URL ?>sanpham/danhmuc/<?php echo $id_cate ?>">
                     <span itemprop="name"><?php echo $name_category_product?></span></a>
                     <meta itemprop="position" content="2" />
                  </li>
                  <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                     <span itemprop="item">
                     <strong itemprop="name"><?php echo $name_product ?></strong>
                     </span>
                     <meta itemprop="position" content="3" />
                  </li>
               </ol>
            </div>
            <div class="content_page">
               <div class="content-right-items margin0">
                  <div class="title-pro-des-ct">
                     <h1><?php echo $name_product ?></h1>
                  </div>
                  <div class="product-details-container">
                     <div class="product-gallery">
                        <div class="main-image">
                           <img src="<?php echo BASE_URL ?>public/upload/product/<?php echo $details['image_product'] ?>" alt="<?php echo $name_product ?>">
                        </div>
                     </div>
                     <div class="product-info">
                        <div class="product-meta">
                           <div class="product-code">
                              <span>Mã hàng: <?php echo $details['id_product'] ?></span>
                           </div>
                           <div class="product-status">
                              <span><i class="fas fa-check-circle"></i> Còn hàng</span>
                           </div>
                           <div class="product-origin">
                              <span><i class="fas fa-globe"></i> Xuất xứ: Việt Nam</span>
                           </div>
                        </div>
                        <div class="product-price">
                           <div class="price-label">Giá bán</div>
                           <div class="price-value">
                              <?php echo number_format($details['price_product'], 0, ',', '.') ?> <span class="currency">vnđ</span>
                              <span class="vat-note">(GIÁ CHƯA VAT)</span>
                           </div>
                        </div>
                        <div class="product-quantity">
                           <div class="quantity-control">
                              <button type="button" class="quantity-btn minus" onclick="decreaseQuantity()">-</button>
                              <input type="number" id="qty" name="qty" value="1" min="1" class="quantity-input">
                              <button type="button" class="quantity-btn plus" onclick="increaseQuantity()">+</button>
                           </div>
                        </div>
                        <form action="<?php echo BASE_URL ?>giohang/themgiohang" method="POST" onsubmit="console.log('Product added to cart:', { 
                            id: this.querySelector('[name=product_id]').value,
                            title: this.querySelector('[name=product_title]').value,
                            price: this.querySelector('[name=product_price]').value,
                            quantity: this.querySelector('[name=product_quantity]').value
                        });">
                           <input type="hidden" name="product_id" value="<?php echo $details['id_product'] ?>">
                           <input type="hidden" name="product_title" value="<?php echo $details['title_product'] ?>">
                           <input type="hidden" name="product_image" value="<?php echo $details['image_product'] ?>">
                           <input type="hidden" name="product_price" value="<?php echo $details['price_product'] ?>">
                           <input type="hidden" name="product_quantity" id="form_qty" value="1">
                           <div class="product-actions">
                              <button type="submit" class="add-to-cart-btn">
                                 <i class="fas fa-shopping-cart"></i> Thêm vào giỏ hàng
                              </button>
                           </div>
                        </form>
                        <div class="product-description">
                           <h3>Mô tả sản phẩm</h3>
                           <div class="description-content">
                              <?php echo $details['desc_product'] ?>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="wrapper_all_main_right">
            <div class="related-products">
               <h3>Sản phẩm liên quan</h3>
               <div class="related-products-grid">
                  <?php foreach($related as $key => $relate){ ?>
                  <div class="related-product-item">
                     <div class="product-image">
                        <a href="<?php echo BASE_URL ?>sanpham/chitietsanpham/<?php echo $relate['id_product'] ?>">
                           <img src="<?php echo BASE_URL ?>public/upload/product/<?php echo $relate['image_product'] ?>" alt="<?php echo $relate['title_product'] ?>">
                        </a>
                     </div>
                     <div class="product-info">
                        <h4>
                           <a href="<?php echo BASE_URL ?>sanpham/chitietsanpham/<?php echo $relate['id_product'] ?>">
                              <?php echo $relate['title_product'] ?>
                           </a>
                        </h4>
                        <div class="product-price">
                           <?php echo number_format($relate['price_product'], 0, ',', '.').'đ' ?>
                        </div>
                        <form action="<?php echo BASE_URL ?>giohang/themgiohang" method="POST">
                           <input type="hidden" name="product_id" value="<?php echo $relate['id_product'] ?>">
                           <input type="hidden" name="product_title" value="<?php echo $relate['title_product'] ?>">
                           <input type="hidden" name="product_image" value="<?php echo $relate['image_product'] ?>">
                           <input type="hidden" name="product_price" value="<?php echo $relate['price_product'] ?>">
                           <input type="hidden" name="product_quantity" value="1">
                           <button type="submit" class="add-to-cart-btn">
                              <i class="fas fa-shopping-cart"></i> Thêm vào giỏ
                           </button>
                        </form>
                     </div>
                  </div>
                  <?php } ?>
               </div>
            </div>
         </div>
         <div class="clear"></div>
      </div>
      <div class="clear"></div>
   </div>
   <script>
      jQuery(document).ready(function() {
 
          var div_fixed = jQuery('.product_detail_info').offset().top;
      
          jQuery(window).scroll(function() {
      
              if (jQuery(window).scrollTop() > div_fixed) {
      
                  jQuery('.tabs-animation').addClass('fix_top');
      
              } else {
      
                  jQuery('.tabs-animation').removeClass('fix_top');
      
              }
      
          });
      
          jQuery(window).load(function() {
      
              if (jQuery(window).scrollTop() > div_fixed) {
      
                  jQuery('.tabs-animation').addClass('fix_top');
      
              }
      
          });
      
      });
      
   </script>
</section>

<style>
/* Product Details Styles */
.product-details-container {
    display: flex;
    gap: 30px;
    margin-top: 20px;
}

.product-gallery {
    flex: 1;
}

.main-image {
    border: 1px solid #eee;
    padding: 10px;
    border-radius: 8px;
}

.main-image img {
    width: 100%;
    height: auto;
    object-fit: cover;
}

.product-info {
    flex: 1;
    padding: 20px;
}

.product-meta {
    margin-bottom: 20px;
}

.product-code, .product-status, .product-origin {
    margin-bottom: 10px;
    color: #666;
}

.product-price {
    background: #f8f9fa;
    padding: 20px;
    border-radius: 8px;
    margin-bottom: 20px;
}

.price-label {
    color: #666;
    margin-bottom: 5px;
}

.price-value {
    font-size: 24px;
    color: #e60000;
    font-weight: bold;
}

.currency {
    font-size: 18px;
}

.vat-note {
    font-size: 14px;
    color: #666;
    margin-left: 10px;
}

.quantity-control {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
}

.quantity-btn {
    width: 40px;
    height: 40px;
    border: 1px solid #ddd;
    background: #fff;
    font-size: 18px;
    cursor: pointer;
}

.quantity-input {
    width: 60px;
    height: 40px;
    text-align: center;
    border: 1px solid #ddd;
    margin: 0 5px;
}

.product-actions {
    display: flex;
    gap: 10px;
    margin-bottom: 30px;
}

.add-to-cart-btn, .call-btn {
    padding: 12px 24px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 8px;
}

.add-to-cart-btn {
    background: #28a745;
    color: white;
}

.call-btn {
    background: #007bff;
    color: white;
    text-decoration: none;
}

.product-description {
    border-top: 1px solid #eee;
    padding-top: 20px;
}

.product-description h3 {
    margin-bottom: 15px;
    color: #333;
}

.description-content {
    color: #666;
    line-height: 1.6;
}

/* Related Products Styles */
.related-products {
    margin-top: 40px;
    padding: 20px;
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.related-products h3 {
    margin-bottom: 20px;
    color: #333;
    font-size: 20px;
    padding-bottom: 10px;
    border-bottom: 1px solid #eee;
}

.related-products-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 20px;
}

.related-product-item {
    border: 1px solid #eee;
    border-radius: 8px;
    overflow: hidden;
    transition: transform 0.3s ease;
    background: #fff;
}

.related-product-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.related-product-item .product-image {
    padding: 10px;
    background: #f8f9fa;
}

.related-product-item .product-image img {
    width: 100%;
    height: 200px;
    object-fit: contain;
}

.related-product-item .product-info {
    padding: 15px;
    text-align: center;
}

.related-product-item h4 {
    margin: 0 0 10px 0;
    font-size: 14px;
    line-height: 1.4;
    height: 40px;
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    text-align: center;
}

.related-product-item h4 a {
    color: #333;
    text-decoration: none;
}

.related-product-item h4 a:hover {
    color: #28a745;
}

.related-product-item .product-price {
    color: #e60000;
    font-weight: bold;
    margin-bottom: 10px;
    font-size: 16px;
    text-align: center;
}

.related-product-item .add-to-cart-btn {
    width: 100%;
    padding: 8px;
    background: #28a745;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    transition: background 0.3s ease;
}

.related-product-item .add-to-cart-btn:hover {
    background: #218838;
}

/* Responsive Design */
@media (max-width: 768px) {
    .related-products-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 480px) {
    .related-products-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<script>
function decreaseQuantity() {
    var input = document.getElementById('qty');
    var formInput = document.getElementById('form_qty');
    var value = parseInt(input.value);
    if (value > 1) {
        input.value = value - 1;
        formInput.value = value - 1;
    }
}

function increaseQuantity() {
    var input = document.getElementById('qty');
    var formInput = document.getElementById('form_qty');
    var value = parseInt(input.value);
    input.value = value + 1;
    formInput.value = value + 1;
}
</script>