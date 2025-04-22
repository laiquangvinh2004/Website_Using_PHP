<div class="dashboard">    
    <div class="dashboard-stats">
        <div class="stat-card">
            <h3>Tổng đơn hàng</h3>
            <div class="stat-number">
                <?php
                    $orderModel = new ordermodel();
                    $totalOrders = $orderModel->getTotalOrders();
                    echo $totalOrders;
                ?>
            </div>
        </div>

        <div class="stat-card">
            <h3>Tổng doanh thu</h3>
            <div class="stat-number">
                <?php
                    $totalRevenue = $orderModel->getTotalRevenue();
                    echo $totalRevenue;
                    //echo number_format($totalRevenue, 0, ',', '.')
                ?>
            </div>
        </div>

        <div class="stat-card">
            <h3>Tổng bài viết</h3>
            <div class="stat-number">
                <?php
                    $postModel = new postmodel();
                    $totalPosts = $postModel->getTotalPosts();
                    echo $totalPosts;
                ?>
            </div>
        </div>

        <div class="stat-card">
            <h3>Tổng khách hàng</h3>    
            <div class="stat-number">
                <?php
                    $customerModel = new customermodel();
                    $totalCustomers = $customerModel->getTotalCustomers();
                    echo $totalCustomers;
                ?>
            </div>
        </div>

        <div class="stat-card">
            <h3>Đơn hàng đã xử lý</h3>   
            <div class="stat-number">
                <?php
                    $processedCount = $orderModel->getProcessedOrdersCount();
                    echo $processedCount;
                ?>
            </div>
        </div>
    </div>

    <div class="charts-row">
        <div class="chart-container">
            <h3>Sản phẩm theo danh mục</h3>
            <canvas id="productPieChart"></canvas>
        </div>

        <div class="chart-container">
            <h3>Bài viết theo danh mục</h3>  
            <canvas id="postPieChart"></canvas>
        </div>
    </div>

    <div class="recent-orders">
        <h3>Đơn hàng đã xử lý gần đây</h3>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Mã đơn hàng</th> 
                        <th>Ngày đặt hàng</th>
                        <th>Trạng thái</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $orderModel = new ordermodel();
                    $processedOrders = $orderModel->getProcessedOrders();
                    if(!empty($processedOrders)){
                        foreach($processedOrders as $order){
                    ?>
                    <tr>
                        <td><?php echo $order['order_code'] ?></td>
                        <td><?php echo $order['order_date'] ?></td>
                        <td>Đã xử lý</td>
                        <td>
                            <a href="<?php echo BASE_URL ?>/order/order_detail/<?php echo $order['order_code'] ?>" class="btn-view">View</a>
                        </td>
                    </tr>
                    <?php
                        }
                    } else {
                    ?>
                    <tr>
                        <td colspan="4" class="text-center">No processed orders found</td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Include Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Product Chart
    var productCtx = document.getElementById('productPieChart').getContext('2d');
    var productData = {
        labels: [
            <?php
                $productModel = new productmodel();
                $categoryData = $productModel->getProductsByCategory();
                $labels = [];
                $counts = [];
                foreach($categoryData as $category) {
                    $labels[] = "'" . $category['category_name'] . "'";
                    $counts[] = $category['product_count'];
                }
                echo implode(',', $labels);
            ?>
        ],
        datasets: [{
            data: [
                <?php echo implode(',', $counts); ?>
            ],
            backgroundColor: [
                '#FF6384',
                '#36A2EB',
                '#FFCE56',
                '#4BC0C0',
                '#9966FF',
                '#FF9F40'
            ]
        }]
    };

    new Chart(productCtx, {
        type: 'pie',
        data: productData,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'right'
                },
                title: {
                    display: true,
                    text: 'Sản phẩm theo danh mục'        
                }
            }
        }
    });

    // Post Chart
    var postCtx = document.getElementById('postPieChart').getContext('2d');
    var postData = {
        labels: [
            <?php
                $postModel = new postmodel();
                $postCategoryData = $postModel->getPostsByCategory();
                $postLabels = [];
                $postCounts = [];
                foreach($postCategoryData as $category) {
                    $postLabels[] = "'" . $category['category_name'] . "'";
                    $postCounts[] = $category['post_count'];
                }
                echo implode(',', $postLabels);
            ?>
        ],
        datasets: [{
            data: [
                <?php echo implode(',', $postCounts); ?>
            ],
            backgroundColor: [
                '#FF9F40',
                '#4BC0C0',
                '#FFCE56',
                '#36A2EB',
                '#FF6384',
                '#9966FF'
            ]
        }]
    };

    new Chart(postCtx, {
        type: 'pie',
        data: postData,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'right'
                },
                title: {
                    display: true,
                    text: 'Bài viết theo danh mục'   
                }
            }
        }
    });
});
</script>

<style>
.dashboard-stats {
    margin-top: 20px;
    display: flex;
    gap: 20px;
}

.stat-card {
    background: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    min-width: 200px;
}

.stat-number {
    font-size: 32px;
    font-weight: bold;
    color: #2c3e50;
    margin-top: 10px;
}

.stat-card h3 {
    margin: 0;
    color: #7f8c8d;
    font-size: 16px;
}

.charts-row {
    margin-top: 40px;
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
}

.chart-container {
    background: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    flex: 1;
    min-width: 300px;
}

.chart-container h3 {
    margin: 0 0 20px 0;
    color: #7f8c8d;
    font-size: 16px;
}

canvas {
    width: 100%;
    height: 300px;
}

.recent-orders {
    margin-top: 30px;
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    padding: 20px;
}

.recent-orders h3 {
    margin-bottom: 20px;
    color: #333;
}

.recent-orders .table-container {
    overflow-x: auto;
}

.recent-orders table {
    width: 100%;
    border-collapse: collapse;
}

.recent-orders th, 
.recent-orders td {
    padding: 12px 15px;
    text-align: center;
    border-bottom: 1px solid #eee;
}

.recent-orders th {
    background-color: #f8f9fa;
    font-weight: 600;
    color: #333;
}

.recent-orders tr:hover {
    background-color: #f5f5f5;
}

.recent-orders .btn-view {
    padding: 6px 12px;
    border-radius: 4px;
    text-decoration: none;
    color: white;
    background-color: #2196F3;
    font-size: 14px;
}

.recent-orders .btn-view:hover {
    background-color: #1976D2;
}

.text-center {
    text-align: center;
}

th, td {
    padding: 12px 15px;
    text-align: center;
    border-bottom: 1px solid #eee;
    font-size: 20px;
}
</style>