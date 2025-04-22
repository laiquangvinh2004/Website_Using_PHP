<section>
   <div class="bg_in">
      <div class="wrapper_all_main">
         <div class="wrapper_all_main_right">
            <!--breadcrumbs-->
            <div class="breadcrumbs">
               <ol itemscope itemtype="http://schema.org/BreadcrumbList">
                  <li itemprop="itemListElement" itemscope
                     itemtype="http://schema.org/ListItem">
                     <a itemprop="item" href=".">
                     <span itemprop="name">Trang chủ</span></a>
                     <meta itemprop="position" content="1" />
                  </li>
                  <li itemprop="itemListElement" itemscope
                     itemtype="http://schema.org/ListItem">
                     <span itemprop="item">
                     <strong itemprop="name">
                     Tất cả tin tức
                     </strong>  
                     </span>
                     <meta itemprop="position" content="2" />
                  </li>
               </ol>
            </div>
            <!--breadcrumbs-->
            <div class="content_page">
               <div class="box-title">
                  <div class="title-bar">
                     <h1>Tất cả tin tức</h1>
                  </div>
               </div>
               <div class="content_text">
                  <ul class="list_ul">
                     <?php
                     foreach($list_post as $key => $post){
                     ?>
                     <li class="lists">
                        <div class="img-list">
                           <a href="<?php echo BASE_URL ?>tintuc/chitiettin/14">
                           <img src="<?php echo BASE_URL ?>public/upload/post/<?php echo $post['image_post']?>" 
                           alt="<?php echo BASE_URL ?>public/upload/post/<?php echo $post['title_post']?>" class="img-list-in">
                           </a>
                        </div>
                        <div class="content-list">
                           <div class="content-list_inm">
                              <div class="title-list">
                                 <h3>
                                    <a href="<?php echo BASE_URL ?>tintuc/chitiettin/<?php echo $post['id_post']?>"><?php echo $post['title_post']?></a>
                                 </h3>
                              </div>
                              <div class="content-list-in">
                                 <p><span style="font-size:16px">
                                    <?php 
                                    $content = $post['content_post'];
                                    if(strlen($content) > 300) {
                                        $content = substr($content, 0, 300) . '...';
                                    }
                                    echo $content;
                                    ?>
                                 </span></p>
                              </div>
                              <div class="xt"><a href="<?php echo BASE_URL ?>tintuc/chitiettin/<?php echo $post['id_post']?>">Xem thêm</a></div>
                           </div>
                        </div>
                        <div class="clear"></div>
                     </li>
                     <?php
                     }
                     ?>
                  </ul>
                  <div class="clear"></div>
                  <div class="wp_page">
                     <div class="page">
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="clear"></div>
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