<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/thuc-don.css">
    <style>
        body{ background-color: #dde1e2;}
        .header{ background-color: #dde1e2;}
        .header img{ border: 2px solid black; border-radius: 10px; margin-left: 5px; transition: transform 0.5s ease;}
        .header img:hover {transform: scale(1.1);}
        .search{ text-align: center;}
        .search .thanhtimkiem{ width: 80%; border-radius: 10px; border-color: #b9b9b9; padding-left: 10px;}
        .search .nuttimkiem{ border-radius: 10px;  background-color: #b9b9b9; border-color: #b9b9b9; font-weight: bold}
        .search .nuttimkiem:hover{ background-color: gray;}
        .login{ text-align: right;}
        .login button{ border-radius: 10px; font-weight: bold;}
        .login .nut_dangnhap{  background-color: #e58423; border-color: #e58423;}
        .login .nut_dangnhap:hover{ background-color: rgb(193, 108, 23);}
        .login .nut_lienhe:hover{ background-color: lightgray;}
        .menu ul { background: #b9b9b9; list-style-type: none; text-align: center; margin: 0;}
        .menu li { display: inline-block; width: 150px; height: 40px; line-height: 40px; margin-left: -5px;}
        .menu li:hover{ background-color: gray; border-radius: 10px;}
        .menu li a{ color: black; font-weight: bold;text-decoration: none;}
        .avt{margin-top: -4px; margin-right: 10px;}
        .footer{ background-color: #dde1e2;}
        .footer img{ width: 100%;}
    </style>
</head>
<body>
    <div class="container-fluid">
<!--===================HEADER=====================-->
        <div class="header">
            <div class="row">
                <div class="logo col-xl-3 col-lg-3 col-md-12 col-sm-12 col-xs-12 mt-3">
                    <a href="http://localhost:8080/QuanLyBepAn/trang-chu.php"><img src="img/logo.jpg" alt="logo" width="120"></a>
                </div>
        
                <div class="search col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12 mt-5">
                    <form action="http://localhost:8080/QuanLyBepAn/thuc-don.php" method="get" class="form_tmkiem">
                        <input class="thanhtimkiem" type="text" name="timkiem" placeholder="Nhập từ khóa tìm kiếm..." 
                                value="<?php if(isset($_GET['timkiem'])) echo $_GET['timkiem'];?>">
                        <input class="nuttimkiem" type="submit" value="Tìm kiếm">
                    </form>
                </div>
        
                <div class="login col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 mt-5">
                    <?php
                        session_start();
                        if (isset($_SESSION['user'])) {
                            echo $_SESSION['user'].'<img class="avt" src="img/avt_macdinh.jpg" alt="avt" width="30">';
                        } else {
                            echo '<a href="http://localhost:8080/QuanLyBepAn/dang-nhap.php"><button class="nut_dangnhap" type="submit" name="submit">Đăng nhập</button></a>';
                        }
                    ?>
                    <a href="gio-hang.php">
                        <button class="giohang" type="submit" name="submit">
                            Giỏ Hàng
                        </button>
                    </a>
                </div>
            </div>
        </div>
        <hr>

        <div class="row">
            <div class="menu">
                <ul class="">
                    <li><a href="http://localhost:8080/QuanLyBepAn/trang-chu.php">TRANG CHỦ</a></li>
                    <li><a href="thucdon-user.php">THỰC ĐƠN</a></li>
                    <li><a href="http://localhost:8080/QuanLyBepAn/tin-tuc.php">TIN TỨC</a></li>
                    <li><a href="http://localhost:8080/QuanLyBepAn/gioi-thieu.php">GIỚI THIỆU</a></li>
                    <li><a href="ds-suatan.php">SUẤT ĂN</a></li>
                    <?php
                        if ($_SESSION['phanquyen'] == 1) {
                            echo '<li><a href="http://localhost:8080/QuanLyBepAn/trang-quan-ly.php">TRANG QUẢN LÝ</a></li>';
                        }
						
                    ?>
                </ul>
            </div>
        </div>
        <hr>