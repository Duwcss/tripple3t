<?php
    include("cls/clsthucdon.php");
    $p = new thucdon();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>
        <?php
            if(isset($_REQUEST['loaimon'])){
                $loaimon=$_REQUEST['loaimon'];
                echo $p->xuattendanhmuc("select Ten from loaimonan where id='$loaimon'");
            }
            else echo 'Thực Đơn';
                
        ?>
    </title>
<?php include("header.php"); ?>
    <!--===================MAIN=====================-->
    <div class="container">
        <div class="row">
            <?php
                $p->xuatdanhmuc("select * from loaimonan order by id");
            ?>
    
            <div class="col-xl-10 col-lg-10 col-md-9 col-sm-9">
                <div class="row">
                    <?php
                        if(isset($_REQUEST['loaimon'])){
                            $loaimon=$_REQUEST['loaimon'];
                            $p->xuatmonan("select * from monan where Loai='$loaimon'");
                            $p->phantrang("select * from monan where Loai='$loaimon'");
                        }
                        else{
                            if(isset($_GET['timkiem']) && !empty($_GET['timkiem'])){
                                $key = $_GET['timkiem'];
                                $sql = "select * from monan
                                        where MaMon like '%$key%' or TenMon like '%$key%' or HinhAnh like '%$key%'";
                                            
                            }
                            else{
                                $sql = "select * from monan order by TenMon asc";
                            }
                            
                            if($p->timkiem($sql)==1){
                                $p->xuatmonan($sql);
                                $p->phantrang($sql);
                            }
                            else echo '<div style="text-align: center; max-height: 240px;">Không có dữ liệu</div>';
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>

<?php include("footer.php"); ?>