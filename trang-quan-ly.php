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
<?php
    if(isset($_REQUEST['mamon'])) $mamon = $_REQUEST['mamon'];
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
              <div class="row">
                <div class="col-xl-2 col-lg-10 col-md-3 col-sm-3">
                  <button type="button" id="openmodal" data-toggle="modal" data-target="#modal1">Thêm món mới</button>
                </div>

                <div class="col-xl-10 col-lg-10 col-md-9 col-sm-9">
                  <form action="http://localhost:8080/QuanLyBepAn/trang-quan-ly.php" method="get" class="timkiem">
                    <input class="thanhtimkiem" type="text" name="timkiem" placeholder="Nhập từ khóa tìm kiếm..." 
                            value="<?php if(isset($_GET['timkiem'])) echo $_GET['timkiem'];?>">
                    <input class="nuttimkiem" type="submit" value="Tìm kiếm">
                  </form>
                </div>
              </div>

              <hr>

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
              <?php $p->phantrang($sql); ?>
            </div>
        </div>
    </div>

    <!--Modal thêm món ăn-->
    <div class="modal fade" id="modal1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="width: 535px;">
                <div class="modal-header">
                    <h5 class="modal-title"><strong>Thêm Món Ăn</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>    
                <div class="modal-body">
                    <form method="post" onsubmit="return checkinput(event)" enctype="multipart/form-data" name="form1" id="form1">
                      <table width="500" border="0" align="center" cellpadding="0" cellspacing="0">
                        <tbody>
                          <tr>
                            <td valign="middle" style="text-align: left">Nhập Mã Món</td>
                            <td valign="middle" style="text-align: left"><input name="txtma" type="text" id="txtma" size="50"></td>
                          </tr>
                          <tr>
                            <td valign="middle" style="text-align: left">Nhập Tên Món</td>
                            <td valign="middle" style="text-align: left"><input name="txtten" type="text" id="txtten" size="50"></td>
                          </tr>
                          <tr>
                            <td valign="middle" style="text-align: left">Nhập Mô Tả</td>
                            <td valign="middle" style="text-align: left"><textarea name="txtmota" cols="50" rows="5" id="txtmota"></textarea></td>
                          </tr>
                          <tr>
                            <td valign="middle" style="text-align: left">Nhập Giá</td>
                            <td valign="middle" style="text-align: left"><input name="txtgia" type="text" id="txtgia" size="50"></td>
                          </tr>
                          <tr>
                            <td valign="middle" style="text-align: left">Chọn Hình Ảnh</td>
                            <td valign="middle" style="text-align: left"><input type="file" name="hinhanh" id="hinhanh"></td>
                          </tr>
                          <tr>
                            <td valign="middle" style="text-align: left">Chọn Loại</td>
                            <td valign="middle" style="text-align: left">
                                <?php
                                    $p->loadloaimon("select * from loaimonan", null);
                                ?>
                            </td>
                          </tr>
                          <tr>
                            <td colspan="2" align="center" valign="middle" style="text-align: center">
                            	<input type="submit" name="nut" id="nut" value="Thêm">
                            </td>
                          </tr>
                        </tbody>
                      </table>
                      <?php
                        switch($_REQUEST['nut']){
                            case 'Thêm':{
                                $mamon = $_REQUEST['txtma'];
                                $tenmon = $_REQUEST['txtten'];
                                $mota = $_REQUEST['txtmota'];
                                $gia = $_REQUEST['txtgia'];
                                $name = $_FILES['hinhanh']['name'];
                                $type = $_FILES['hinhanh']['type'];
                                $tmp_name = $_FILES['hinhanh']['tmp_name'];
                                $loai = $_REQUEST['loai'];
                                $name = time().'_'.$name;
                                if($p->uphinh($name, "img/$loai", $tmp_name)==1){
                                	if($p->themxoasuamonan("insert into monan(MaMon, TenMon, MoTa, Gia, HinhAnh, Loai)
                                        	values ('$mamon', '$tenmon', '$mota', '$gia', '$name', '$loai')")==1){
                                    	echo '<script language="javascript">alert("Thêm món ăn thành công");</script>';
                                      echo '<script language="javascript">window.location="../QuanLyBepAn/trang-quan-ly.php";</script>';
                                    }
                                    else{
                                      echo '<script language="javascript">alert("Thêm món ăn không thành công");</script>';	
                                      echo '<script language="javascript">window.location="../QuanLyBepAn/trang-quan-ly.php";</script>';
                                    }
                                 }
                                 else{
                                 	echo '<script language="javascript">alert("Tải hình không thành công");</script>';
                                  echo '<script language="javascript">window.location="../QuanLyBepAn/trang-quan-ly.php";</script>';
                                }
                                break;
                            }
                        }
                      ?>
                    </form>
                </div>
            </div>
        </div>
	  </div>

    <!--Modal xóa, sửa món ăn-->
    <div class="modal fade" id="modal2">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="width: 535px;">
                <div class="modal-header">
                    <h5 class="modal-title"><strong>Thông Tin Món Ăn</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>    
                <div class="modal-body">
                    <form method="post" enctype="multipart/form-data" name="form1" id="form1">
                      <table width="500" border="0" align="center" cellpadding="0" cellspacing="0">
                        <tbody>
                          <tr>
                            <td valign="middle" style="text-align: left">Mã Món</td>
                            <td valign="middle" style="text-align: left"><input name="txtma" type="text" id="txtma" size="50" value="<?php echo $p->choncot("select MaMon from monan where MaMon='$mamon' "); ?>"></td>
                          </tr>
                          <tr>
                            <td valign="middle" style="text-align: left">Tên Món</td>
                            <td valign="middle" style="text-align: left"><input name="txtten" type="text" id="txtten" size="50" value="<?php echo $p->choncot("select TenMon from monan where MaMon='$mamon' "); ?>"></td>
                          </tr>
                          <tr>
                            <td valign="middle" style="text-align: left">Mô Tả</td>
                            <td valign="middle" style="text-align: left"><textarea name="txtmota" cols="50" rows="5" id="txtmota"><?php echo $p->choncot("select MoTa from monan where MaMon='$mamon' "); ?></textarea></td>
                          </tr>
                          <tr>
                            <td valign="middle" style="text-align: left">Giá</td>
                            <td valign="middle" style="text-align: left"><input name="txtgia" type="text" id="txtgia" size="50" value="<?php echo $p->choncot("select Gia from monan where MaMon='$mamon' "); ?>"></td>
                          </tr>
                          <tr>
                            <td valign="middle" style="text-align: left">Hình Ảnh</td>
                            <td valign="middle" style="text-align: left"><input type="file" name="hinhanh" id="hinhanh"></td>
                          </tr>
                          <tr>
                            <td valign="middle" style="text-align: left">Loại</td>
                            <td valign="middle" style="text-align: left">
                                <?php
                                    $loaimon = $p -> choncot("select Loai from monan where MaMon='$mamon' ");
                                    $p->loadloaimon("select * from loaimonan", $loaimon);
                                ?>
                            </td>
                          </tr>
                          <tr>
                            <td colspan="2" align="center" valign="middle" style="text-align: center">
                            	<input type="submit" name="nut" id="nut" value="Xóa">
                              <input type="submit" name="nut" id="nut" value="Sửa">
                            </td>
                          </tr>
                        </tbody>
                      </table>
                      <?php
                        switch($_REQUEST['nut']){
                            case 'Xóa':{
                              $HinhAnh = $p -> choncot("select HinhAnh from monan where MaMon='$mamon'");
                              $vitrihinh = "img/$loaimon/".$HinhAnh;
                              if(unlink($vitrihinh)){
                                  if ($p->themxoasuamonan("delete from monan where MaMon='$mamon'")==1){
                                    echo '<script language="javascript">alert("Xóa thành công");</script>';
                                    echo '<script language="javascript">window.location="../QuanLyBepAn/trang-quan-ly.php";</script>';
                                  } 
                                  else {
                                    echo '<script language="javascript">alert("Xóa không thành công");</script>';
                                    echo '<script language="javascript">window.location="../QuanLyBepAn/trang-quan-ly.php";</script>';
                                  } 
                              }
                              else{
                                echo '<script language="javascript">alert("Lỗi xóa hình");</script>';
                                echo '<script language="javascript">window.location="../QuanLyBepAn/trang-quan-ly.php";</script>';
                              }
                              break;
                            }
							
                            case 'Sửa':{
                              $ma = $_REQUEST['txtma'];
                              $ten = $_REQUEST['txtten'];
                              $mota = $_REQUEST['txtmota'];
                              $gia = $_REQUEST['txtgia'];
                              $loai = $_REQUEST['loai'];
                              if($ma!='' && $ten!='' && $mota!=''  && $gia!=''){
                                if ($_FILES['hinhanh']['name'] != '') {
                                  $name = $_FILES['hinhanh']['name'];
                                  $type = $_FILES['hinhanh']['type'];
                                  $tmp_name = $_FILES['hinhanh']['tmp_name'];
                                  if ($type == 'image/png' || $type == 'image/jpeg') {
                                    $name = time() . "_" . $name;
                                    if ($p->uphinh($name, "img/$loaimon/", $tmp_name) == 1) {
                                      // Nếu hình ảnh được tải lên thành công, thực hiện cập nhật thông tin món ăn
                                      if ($p->themxoasuamonan("update monan set MaMon='$ma', TenMon='$ten', MoTa='$mota', Gia='$gia', HinhAnh='$name', Loai='$loaimon' WHERE MaMon='$mamon'") == 1) {
                                        echo '<script language="javascript">alert("Sửa thành công");</script>';
                                        echo '<script language="javascript">window.location="../QuanLyBepAn/trang-quan-ly.php";</script>';
                                      } else {
                                        echo '<script language="javascript">alert("Không thành công");</script>';
                                        echo '<script language="javascript">window.location="../QuanLyBepAn/trang-quan-ly.php";</script>';
                                      }
                                    } 
                                    else {
                                      echo '<script language="javascript">alert("Tải hình lên không thành công");</script>';
                                      echo '<script language="javascript">window.location="../QuanLyBepAn/trang-quan-ly.php";</script>';
                                    }
                                  } 
                                  else {
                                    echo '<script language="javascript">alert("Vui lòng chọn file PNG hoặc JPG");</script>';
                                    echo '<script language="javascript">window.location="../QuanLyBepAn/trang-quan-ly.php";</script>';
                                  }
                                } 
                                else {
                                  // Nếu người dùng không thay đổi hình ảnh, chỉ cập nhật thông tin khác
                                  if ($p->themxoasuamonan("update monan set MaMon='$ma', TenMon='$ten', MoTa='$mota', Gia='$gia', Loai='$loaimon' WHERE MaMon='$mamon'") == 1) {
                                    echo '<script language="javascript">alert("Sửa thành công");</script>';
                                    echo '<script language="javascript">window.location="../QuanLyBepAn/trang-quan-ly.php";</script>';
                                  } 
                                  else {
                                    echo '<script language="javascript">alert("Không thành công");</script>';
                                    echo '<script language="javascript">window.location="../QuanLyBepAn/trang-quan-ly.php";</script>';
                                  }
                                }
                              }
                              else{
                                echo '<script language="javascript">alert("Vui lòng chọn món cần sửa");</script>';
                                echo '<script language="javascript">window.location="../QuanLyBepAn/trang-quan-ly.php";</script>';
                              }
                              break;
                            }
                        }
                      ?>
                    </form>
                </div>
            </div>
        </div>
	  </div>

<?php include("footer.php"); ?>

<!--js mở modal và xử lý dữ liệu-->
<script>
  $(document).ready(function () {
    $("#openmodal").click(function () {
      $("#modal1").modal("show");
    });

    $(".modal-header .close").click(function () {
      $("#modal1").modal("hide");
    });

    var urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('mamon')) {
            $("#modal2").modal("show");
        }

    $(".modal-header .close").click(function () {
      $("#modal2").modal("hide");
    });
  });

  function checkinput(event){
    var ma = document.getElementById('txtma');
    var ten = document.getElementById('txtten');
    var mota = document.getElementById('txtmota');
    var gia = document.getElementById('txtgia');
    if(ma.value!="" && ten.value!="" && mota.value!="" && gia.value!=""){
      var hinhanh = document.getElementById('hinhanh');
      var type = hinhanh.value.slice(-3);
      if(type=='jpg' || type=='png'){
        return 1;
      }
      alert("Vui Lòng chọn file JPG hoặc PNG");
      event.preventDefault();
      return 0;
    }
    alert("Vui Lòng nhập đầy đủ thông tin");
    event.preventDefault();
    return 0;
  }
</script>