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
	

	if (!isset($_SESSION['monchinh']) || !is_array($_SESSION['monchinh'])) {
		session_start();
		
	}

	if (isset($_POST['select']) && ($_POST['select'])) {	
		$tenmon = $_POST['tenmon'];	
		$gia = $_POST['gia'];	
		$hinhanh = $_POST['hinhanh'];
		$mamon = $_POST['mamon'];
		$Loai = $_POST['loai'];
		$monchinh = array($tenmon, $gia, $hinhanh,$mamon,$Loai);
		$_SESSION['monchinh'][] = $monchinh;

	}
	function showmonchinh(){
		if(isset($_SESSION['monchinh'])&& (is_array($_SESSION['monchinh']))){
			for ($i=0;$i<sizeof($_SESSION['monchinh']);$i++)
			{
				echo '<div style="margin-left:15px;">
						<div align="center"><img src="img/'.$_SESSION['monchinh'][$i][4].'/'.$_SESSION['monchinh'][$i][2].'" alt="'.$tenmon.'" width="150px" height="100px"></div>
						<div align="center">'.$_SESSION['monchinh'][$i][0].'</div>
						<div align="center">'.$_SESSION['monchinh'][$i][1].'</div>
						</div>';	
			}
		}	
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
                <div class="phai">
                    <h1>Thêm thực đơn</h1>
                    <form id="" name="" method="post" action="">
                      <table width="800" border="1" align="center" dir="ltr">
                       
                        <tr style="border-bottom:1px solid black">
                          <td style="border-right:1px solid black">Danh sách món ăn</td>
                          <td>
                            <div style="display:flex;">
                            
                                <?php
                                 showmonchinh();
                                ?>
                            </div>
                            
                            <p><input type="submit" name="nut" id="nut" value="+Thêm món"></p>
                            
                        </tr>
                         <tr style="border-bottom:1px solid black">
                            <td style="border-right:1px solid black">Mã thực đơn</td>
                            <td><input type="text" name="txtma" id="txtma"/></td>
                        </tr>
                        <tr style="border-bottom:1px solid black">
                          <td style="border-right:1px solid black">Thực đơn ngày</td>
                          <td><input name="ngaytd" type="date" id="ngaytd"/></td>
                        </tr>
                        <tr>
                          <td colspan="2" align="center"><input type="submit" name="nut" id="nut" value="Thêm thực đơn" />
                            <input type="submit" name="nut" id="nut" value="Thoát">
                          </td>
                        </tr>
                      </table>
                      <?php
                          
                            
                        switch($_POST['nut'])
                        {
                            case 'Thêm thực đơn':
                            {
                                
                                $tt=0;
                                $selectedData = $_SESSION['monchinh'];
                                $mathucdon = $_REQUEST['txtma'];
                                $ngay = $_REQUEST['ngaytd'];
                                for($i=0;$i<sizeof($selectedData);$i++)
                                    {
                                        $tenmon = $selectedData[$i][0]; 
										$mamon = $selectedData[$i][3];
                                        $gia =  $selectedData[$i][1];
                                        $hinhanh =  $selectedData[$i][2];
										$loai = $selectedData[$i][4];
										$sqlmonchinh = $p->themxoasua("INSERT INTO monchinh(TenMon,GiaMon,HinhAnhMon,maThucDon,Loai,MaMon) VALUES ('$tenmon','$gia','$hinhanh','$mathucdon','$loai','$mamon')");
										var_dump($sqlmonchinh);
										$tt += $gia;
                                    }
                                
                                // Loop qua mảng đã chọn và chèn vào cơ sở dữ liệu
                                
                                if($mathucdon!='' && $ngay!='' && $_SESSION['monchinh']!='')
                                {
                                    $sqlthucdon = $p->themxoasua("INSERT INTO thucdon(maThucDon,ngayLap,gia) VALUES ('$mathucdon','$ngay','$tt')");
                                    
                                    if(($sqlthucdon && $sqlmonchinh)==1)
                                    {
                                        echo '<script>alert("Thêm thành công!");</script>';
                                        echo '<script>
                                                    window.location="thucdon.php";
                                                </script>';
                                        unset($_SESSION['monchinh']);	
                                    }
                                    else
                                    {
                                        echo '<script>alert("Không thành công!");</script>';
                                        echo '<script>
                                                    window.location="thucdon.php";
                                                </script>';
                                        unset($_SESSION['monchinh']);
                                    }
                                }
                                else
                                {
                                    echo '<script>alert("Vui lòng nhập đủ thông tin!");</script>';
                                }
                                break;	
                            }
                            case '+Thêm món':
                                {
                                    echo'<script>
                                                window.location="monchinh.php";
                                            </script>';
											break;
                                }
                            case 'Thoát':
                            {
                                
								unset($_SESSION['monchinh']);
								echo'<script>
                                                window.location="thucdon.php";
                                            </script>';
								break;
                            }
                        }
                      ?>
                      <?php
                        if(isset($_POST['nut'])&&($_POST['nut'])){
                            
                            
                        }
                    ?>
                    </form>      
            </div>
        </div>
    </div>
<script>
	function exit() {

    // Thay đổi vị trí của cửa sổ
    window.location = "thucdon.php";
}

</script>
<?php include("footer.php"); ?>
