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
include("cls/clsindex.php");
$p = new qlba();
?>
<?php
	if(isset($_REQUEST['laymaThucDon']))
	{
		$laymaThucDon = $_REQUEST['laymaThucDon'];	
	}
	
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Trang Quản Lý</title>
    <title>Document</title>
    <link rel="stylesheet" href="css/quanly.css">
   	<link rel="stylesheet" href="css/dsthucdon.css">
<?php include("header.php"); ?>
    <!--===================MAIN=====================-->
    <div class="container-fluid">
        <div class="row">
            <div class="chucnang col-xl-2 col-lg-2 col-md-3 col-sm-3">
                <h4><strong>CHỨC NĂNG</strong></h4>
				<?php $q->xuatchucnang(); ?>
            </div>
    
            <div class="col-xl-10 col-lg-10 col-md-9 col-sm-9">
                <div class="phai" style="background-color:transparent">
                    <div class="chucnang" style="width:auto;padding-left:52%;margin:20px 0 20px 0;background-color:transparent">
                        <input name="dateTD" type="date" id="selectDate" value="Thực đơn ngày"/>
                        <input type="button" name="nut" id="btnGetMenu" value="Chọn ngày" />
                        <button class="themthucdon" style="background-color:#92E4A5;"><a href="themthucdon.php" style="text-decoration:none;">Thêm thực đơn</a></button>
                  </div>
                    <?php
					
					$p->xuatthucdon("select * from thucdon order by maThucDon asc");
                    ?>
                    <br/>
                    
                     <form id="" name="form1" method="post" action="">
                      <table width="800" border="1" align="center" dir="ltr">
                        <tr style="border-bottom:1px solid black">
                          <td width="185" style="border-right:1px solid black">Mã thực đơn</td>
                          <td width="599"><input name="macanxoa" type="text" id="macanxoa" value="<?php echo $laymaThucDon; ?>" />
                        </tr>
                        <tr style="border-bottom:1px solid black">
                          <td style="border-right:1px solid black">Danh sách món ăn</td>
                          <td>
                                <?php
                                    echo $p->monan("select * from monchinh where maThucDon = '$laymaThucDon' ");
                                ?>
                           </td>
                        </tr>
                        <tr style="border-bottom:1px solid black">
                          <td style="border-right:1px solid black">Thực đơn ngày</td>
                          <td><input name="ngaytd" type="date" id="ngaytd" 
                                value="<?php echo $p->chotcot("select ngayLap from thucdon where maThucDon = '$laymaThucDon' limit 1") ; ?>"/></td>
                        </tr>
                        <tr style="border-bottom:1px solid black">
                          <td style="border-right:1px solid black">Giá</td>
                          <td><label for="textfield6"></label>
                          <input type="text" name="txtgia" id="textfield6" 
                                value="<?php echo $p->chotcot("select gia from thucdon where maThucDon = '$laymaThucDon' limit 1") ;echo 'đ'; ?>"/ style="margin-left:-5px;"></td>
                        </tr>
                        <tr>
                          <td colspan="2" align="center"><input type="submit" name="btn_xoa" id="btn_xoa" value="Xóa thực đơn" /></td>
                        </tr>
                        </table>
                        <?php
                            switch($_POST['btn_xoa'])
                            {
                                case 'Xóa thực đơn':
                                {
                                    $laymaxoa =$_REQUEST['macanxoa'];
                                        if($laymaxoa != '')
                                        {
                                            $delthucdon = $p->themxoasua("delete from thucdon where maThucDon ='$laymaxoa' limit 1");
                                            $delmonan = $p->themxoasua("delete from monchinh where maThucDon ='$laymaxoa'");
											$del = $delmonan + $delthucdon;
                                            if($del)
                                                {
                                                    echo '<script>alert("Xóa thành công!"); window.location.href = "thucdon.php";</script>';
                
                                                }
                                        }	
                                        else
                                        {
                                            echo '<script>alert("Vui lòng chọn thực đơn cần xóa!"); window.location.href = "thucdon.php";</script>';
                                        }	
                                }
                            }
                            
                        ?>
                     </form>      
            </div>
        </div>
    </div>

<?php include("footer.php"); ?>
