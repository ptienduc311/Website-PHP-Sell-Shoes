<!DOCTYPE html>
<html>

<head>
    <title>Quản lý SHOES STORE</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="public/css/bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="public/css/bootstrap/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />
    <link href="public/reset.css" rel="stylesheet" type="text/css" />
    <link href="public/css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="public/style.css" rel="stylesheet" type="text/css" />
    <link href="public/responsive.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="public/js/jquery-2.2.4.min.js" type="text/javascript"></script>
    <script src="public/js/bootstrap/bootstrap.min.js" type="text/javascript"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="public/js/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
    <script src="public/js/main.js" type="text/javascript"></script>
    <script src="public/js/custom.js"></script>
    <script src="public/js/upload_more.js"></script>
</head>

<body>
    <div id="site">
        <div id="container">
            <div id="header-wp">
                <div class="wp-inner clearfix">
                    <a href="?mod=home" title="" id="logo" class="fl-left">ADMIN</a>
                    <ul id="main-menu" class="fl-left">
                        <li>
                            <a href="?mod=page" title="">Trang</a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="?mod=page&action=add" title="">Thêm mới</a>
                                </li>
                                <li>
                                    <a href="?mod=page" title="">Danh sách trang</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="?mod=post" title="">Bài viết</a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="?mod=post&controller=index&action=add" title="">Thêm bài viết mới</a>
                                </li>
                                <li>
                                    <a href="?mod=post" title="">Danh sách bài viết</a>
                                </li>
                                <li>
                                    <a href="?mod=post&controller=index&action=addCat" title="">Thêm danh mục mới</a>
                                </li>
                                <li>
                                    <a href="?mod=post&controller=index&action=category" title="">Danh mục bài viết</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="?mod=product" title="">Sản phẩm</a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="?mod=product&action=add" title="">Thêm sản phẩm mới</a>
                                </li>
                                <li>
                                    <a href="?mod=product" title="">Danh sách sản phẩm</a>
                                </li>
                                <li>
                                    <a href="?mod=product&controller=cat&action=addCat" title="">Thêm danh mục sản phẩm</a>
                                </li>
                                <li>
                                    <a href="?mod=product&controller=cat&action=category" title="">Danh mục sản phẩm</a>
                                </li>
                                <li>
                                    <a href="?mod=product&controller=cat&action=size" title="">Thêm size giày mới</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="?mod=sell&action=order" title="">Bán hàng</a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="?mod=sell&action=order" title="">Danh sách đơn hàng</a>
                                </li>
                                <li>
                                    <a href="?mod=sell&action=customer" title="">Danh sách khách hàng</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <div id="dropdown-user" class="dropdown dropdown-extended fl-right">
                        <button class="dropdown-toggle clearfix" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            <div id="thumb-circle" class="fl-left">
                                <img src="public/images/img-admin.png">
                            </div>
                            <h3 id="account" class="fl-right"><?php echo $_SESSION['fullname']; ?></h3>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="?mod=users&action=update" title="Thông tin cá nhân">Thông tin tài khoản</a></li>
                            <li><a href="?mod=users&action=logout" title="Thoát">Thoát</a></li>
                        </ul>
                    </div>
                </div>
            </div>