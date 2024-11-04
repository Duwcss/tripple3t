<?php
    include("cls/clsxemmonan.php");
    $p = new xemmonan();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>
        <?php 
            if (isset($_REQUEST['mamon'])){
                $mamon=$_REQUEST['mamon'];
                $p->xuattenmon("select TenMon from monan where MaMon='$mamon'");
            }
            else{
                header("location:../QuanLyBepAn/thuc-don.php");
            }
        ?>
    </title>
    <link rel="stylesheet" href="css/xemmonan.css">
<?php include("header.php"); ?>
    <!--===================MAIN=====================-->
    <div class="container">
        <div class="row">
            <?php
                $p->xuathinh("select * from monan where MaMon='$mamon'");
                $p->xuatthongtin("select * from monan where MaMon='$mamon'");

                /* code thêm giỏ hàng */
                switch($_REQUEST['nut']){
                    case 'Thêm':{
                        if(isset($_SESSION['user'])){
                            $user=$_SESSION['user'];
                            $Ngaydat = $_REQUEST['Ngaydat'];
                            $now = time();
                            $future_date = strtotime($_REQUEST['Ngaydat']);
                            $time_diff = $future_date - $now;
                            if ($time_diff > 86400) {
                                if(isset($_REQUEST['soluong'])) $soluong=$_REQUEST['soluong'];
                            $check="select * from giohang where Username='$user' and MaMon='$mamon'";
                            if($p->kiemtragiohang($check)==1){
                                $sql="update giohang set SoLuong=SoLuong+$soluong where Username='$user' and MaMon='$mamon'";
                                if($p->themsuagiohang($sql)==1){
                                    echo '<script language="javascript">alert("Cập nhật giỏ hàng thành công");</script>';
                                    echo '<script language="javascript">window.location="../QuanLyBepAn/xem-mon-an.php?mamon='.$mamon.'";</script>';
                                }
                                else{
                                    echo '<script language="javascript">alert("Không thành công");</script>';
                                    echo '<script language="javascript">window.location="../QuanLyBepAn/xem-mon-an.php?mamon='.$mamon.'";</script>';
                                }
                            }
                            else{
                                $sql="insert into giohang(Username, MaMon, SoLuong,Ngaydat) 
                                values ('$user', '$mamon', '$soluong','$Ngaydat')";
                                if($p->themsuagiohang($sql)==1){
                                    echo '<script language="javascript">alert("Thêm vào giỏ hàng thành công");</script>';
                                    echo '<script language="javascript">window.location="../QuanLyBepAn/xem-mon-an.php?mamon='.$mamon.'";</script>';
                                }
                                else{
                                    echo '<script language="javascript">alert("Không thành công");</script>';
                                    echo '<script language="javascript">window.location="../QuanLyBepAn/xem-mon-an.php?mamon='.$mamon.'";</script>';
                                }
                            }
                        }
                            else{
                                 echo '<script language="javascript">alert("ngày đặt phải hơn 24h so với hiện tại");</script>';
                             }
            
                        } else {
                               
								echo '<script language="javascript">alert("Vui lòng đăng nhập");</script>';
                                echo '<script language="javascript">window.location="../QuanLyBepAn/xem-mon-an.php?mamon='.$mamon.'";</script>';
                            }
                            
                        break;
                    }
                }
            ?>
        </div>
        <hr>
        <div class="row">
            <?php $p->xuatmota("select MoTa from monan where MaMon='$mamon'"); ?>
        </div>

        <hr>

        <div class="row">
            <div class="danhgia col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <?php $p->xuatdanhgia("select * from danhgia where MaMon='$mamon' order by Ngay desc"); ?>
                <div class="row">
                    <form action="" method="post">
                        <textarea name="nhapdanhgia" class="nhapdanhgia" cols="30" rows="2" placeholder="Viết đánh giá..."></textarea>
                        <button type="submit" name="guidanhgia">Gửi</button>
                        <button type="reset" name="huydanhgia">Hủy</button>
                        <?php
                            $p->themdanhgia();
                        ?>
                    </form>
                </div>
            </div>
        </div>

        <hr>

        <div class="row">
            <?php
                $loaimon=$p->xuatloaimon("select Loai from monan where MaMon='$mamon'");
                $p->xuatmonankhac("select * from monan where Loai='$loaimon' limit 4", $mamon);
            ?>
        </div>
    </div>

<?php include("footer.php"); ?>