<nav class="navbar navbar-inverse">
    <div class="container-fluid">   
        <div class="collapse navbar-collapse" id="adminNav">
            <ul class="nav navbar-nav">
                <li><a href="<?php echo BASE_URL ?>login/dashboard">Trang chủ</a></li>
                <li><a href="<?php echo BASE_URL ?>login/logout">Đăng xuất</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        Danh mục bài viết <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo BASE_URL ?>post">Thêm</a></li>
                        <li><a href="<?php echo BASE_URL ?>post/list_category">Liệt kê</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        Danh mục sản phẩm <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo BASE_URL ?>product">Thêm</a></li>
                        <li><a href="<?php echo BASE_URL ?>product/list_category">Liệt kê</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        Đơn hàng <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo BASE_URL ?>order">Liệt kê</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        Bài viết <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo BASE_URL ?>post/add_post">Thêm</a></li>
                        <li><a href="<?php echo BASE_URL ?>post/list_post">Liệt kê</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        Sản phẩm <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo BASE_URL ?>product/add_product">Thêm</a></li>
                        <li><a href="<?php echo BASE_URL ?>product/list_product">Liệt kê</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        Khách hàng <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo BASE_URL ?>customer/list_customer">Liệt kê</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<style>
    .navbar-brand {
        font-size: 20px;
    }
    .navbar-nav > li > a {
        font-size: 17px;
    }
    .dropdown-menu > li > a {
        font-size: 15px;
    }
</style>

