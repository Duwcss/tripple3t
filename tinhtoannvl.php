<?php
    session_start();
    include('cls/clsdangnhap.php');
    $p = new login();
    if(isset($_SESSION['id']) && isset($_SESSION['user']) && isset($_SESSION['pass']) && isset($_SESSION['phanquyen'])){
        $p -> confirmlogin($_SESSION['id'], $_SESSION['user'], $_SESSION['pass'], $_SESSION['phanquyen']);
    }
    else{
        header('location:../QuanLyBepAn/dang-nhap.php');
    }
?>
<?php
  include("cls/clsquanly.php");
  $p = new quanly();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Trang Quản Lý</title>
    <title>Document</title>
    <link rel="stylesheet" href="css/quanly.css">
<?php include("header.php"); ?>
    <!--===================MAIN=====================-->
    <div class="container-fluid">
        <div class="row">
            <div class="chucnang col-xl-2 col-lg-2 col-md-3 col-sm-3">
                <h4><strong>CHỨC NĂNG</strong></h4>
				<?php $p->xuatchucnang(); ?>
            </div>
    
            <div class="col-xl-10 col-lg-10 col-md-9 col-sm-9">
                <!--<table class="table table-bordered table-secondary table-hover" width="1100" border="1" align="center" cellpadding="0" cellspacing="0">
                    <center><h5><strong>DANH SÁCH NGUYÊN VẬT LIỆU CẦN TÍNH TOÁN</strong></h5></center>
                    <tbody>
                        <tr>
                            <td width="50" height="50" align="center" valign="middle"><strong>STT</strong></td>
                            <td width="100" height="50" align="center" valign="middle"><strong>MÃ NVL</strong></td>
                            <td width="100" height="50" align="center" valign="middle"><strong>TÊN NVL</strong></td>
                            <td width="50" height="50" align="center" valign="middle"><strong>TỔNG KHỐI LƯỢNG</strong></td>
                            <td width="50" height="50" align="center" valign="middle"><strong>ĐƠN GIÁ</strong></td>
                            <td width="50" height="50" align="center" valign="middle"><strong>ĐƠN VỊ</strong></td>
                        </tr>
                        <?php
                            $sql="select 
                                    nvl.MaNVL,
                                    nvl.TenNVL,
                                    COALESCE(SUM(monan_nvl.KhoiLuong * giohang.SoLuong), 0) AS TongKhoiLuong,
                                    nvl.DonGia,
                                    nvl.DonVi
                                from nvl
                                left join monan_nvl ON nvl.MaNVL = monan_nvl.MaNVL
                                left join giohang ON monan_nvl.MaMon = giohang.MaMon
                                group by nvl.MaNVL, nvl.TenNVL, nvl.DonGia, nvl.DonVi
                                having TongKhoiLuong > 0
                                order by nvl.MaNVL;
                                ";
                            $p->loadnvl($sql);
                        ?>
                    </tbody>
                </table>

                <hr>-->
                <center><h5><strong>TÍNH TOÁN NGUYÊN VẬT LIỆU</strong></h5></center>
                <?php $p->tinhtoannvl($sql); ?>             
            </div>
        </div>
    </div>

<?php include("footer.php"); ?>
