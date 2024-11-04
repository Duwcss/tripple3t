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
  $q = new quanly();
?>
<?php
include("cls/clsmonan.php");
$p = new qlba();
?>
<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Trang Quản Lý</title>
    <title>Document</title>
    <link rel="stylesheet" href="css/quanly.css">
   	<link rel="stylesheet" href="css/monan.css">
<?php include("header.php"); ?>
    <!--===================MAIN=====================-->
    <div class="container-fluid">
        <div class="row">
            <div class="chucnang col-xl-2 col-lg-2 col-md-3 col-sm-3">
                <h4><strong>CHỨC NĂNG</strong></h4>
				<?php $q->xuatchucnang(); ?>
            </div>
            <div class="col-xl-10 col-lg-10 col-md-9 col-sm-9">
               <table class="table table-bordered table-secondary table-hover" width="1100" border="1" align="center" cellpadding="0" cellspacing="0">
                <center><h5><strong>DANH SÁCH MÓN ĂN</strong></h5></center>
                <tbody>
                  <tr>
                    <td width="50" height="50" align="center" valign="middle"><strong>STT</strong></td>
                    <td width="100" height="50" align="center" valign="middle"><strong>MÃ MÓN</strong></td>
                    <td width="100" height="50" align="center" valign="middle"><strong>TÊN MÓN</strong></td>
                    <td width="300" height="50" align="center" valign="middle"><strong>MÔ TẢ</strong></td>
                    <td width="50" height="50" align="center" valign="middle"><strong>GIÁ</strong></td>
                    <td width="100" height="50" align="center" valign="middle"><strong>HÌNH ẢNH</strong></td>
                    <td width="50" height="50" align="center" valign="middle"><strong>LOẠI</strong></td>
                    <td width="50" height="50" align="center" valign="middle"></td>
                  </tr>
                  <?php
                    if(isset($_GET['timkiem']) && !empty($_GET['timkiem'])){
                      $key = $_GET['timkiem'];
                      $sql = "select * from monan
                              where MaMon like '%$key%' or TenMon like '%$key%' or HinhAnh like '%$key%'";
                                    
                    }
                    else{
                        $sql = "select * from monan order by TenMon asc";
                    }
                    
                    if($p->timkiem($sql)==1){
                        $p->loadmonan($sql);
						
                    }
                    else{
                      echo '<tr><td colspan="8" align="center" valign="middle">Không có dữ liệu</td></tr>';
                    }
                  ?>
                  
                </tbody>
              </table>
              <?php
                  	$p->phantrang($sql);
				  ?>
            </div>
        </div>
    </div>

<?php include("footer.php"); ?>
