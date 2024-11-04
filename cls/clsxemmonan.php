<?php
    include("clsthucdon.php");
    class xemmonan extends thucdon{
        public function xuattenmon($sql){
            $link = $this->connect();
            $ketqua = mysql_query($sql, $link);
            $i = mysql_num_rows($ketqua);
            if($i>0){
                while($row=mysql_fetch_array($ketqua)){
                    $TenMon = $row['TenMon'];
                    echo $TenMon;
                }
            }
            else{
                echo '';
            }
            mysql_close($link);
        }

        public function xuathinh($sql){
            $link = $this->connect();
            $ketqua = mysql_query($sql, $link);
            $i = mysql_num_rows($ketqua);
            if($i>0){
                while($row=mysql_fetch_array($ketqua)){
                    $TenMon = $row['TenMon'];
                    $HinhAnh = $row['HinhAnh'];
                    $Loai = $row['Loai'];
                    echo '<div class="hinhmonan col-xl-6 col-lg-6 col-md-6 col-sm-6">
                            <img src="img/'.$Loai.'/'.$HinhAnh.'" alt="'.$TenMon.'">
                        </div>';
                }
            }
            else{
                echo 'Không có hình ảnh';
            }
            mysql_close($link);
        }

        public function xuatthongtin($sql){
            $link = $this->connect();
            $ketqua = mysql_query($sql, $link);
            $i = mysql_num_rows($ketqua);
            if($i>0){
                while($row=mysql_fetch_array($ketqua)){
                    $MaMon = $row['MaMon'];
                    $TenMon = $row['TenMon'];
                    $Gia = $row['Gia'];
                    $MoTa = $row['MoTa'];
                    $HinhAnh = $row['HinhAnh'];
                    $Loai = $row['Loai'];
                    echo   '<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                <div class="row">
                                    <div class="ttmonan">
                                        <h1><strong>'.$TenMon.'</strong></h1>
                                        <div class="tt_gia"><h4>'.number_format($Gia).'đ</h4></div>
                                        <form method="post" action="">
                                            <div class="tt_nut">
                                                <input type="number" name="soluong" class="soluong" min="1" value="1">
                                                <input type="date" name="Ngaydat" class="Ngaydat" style="width: 120px;">
                                                <button name="nut" id="nut" value="Thêm">Thêm vào giỏ hàng</button>
                                            </div>
                                        </form>
                                        <hr>
                                        <div class="tt_ma">Mã: '.$MaMon.'</div>
                                        <div class="tt_loai">Danh mục: 
                                            <a href="http://localhost:8080/QuanLyBepAn/thuc-don.php?loaimon='.$Loai.'">'.$this->xuattendanhmuc("select Ten from loaimonan where id='$Loai'").'</a>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                }
            }
            else{
                echo '<div style="text-align: center; max-height: 240px;">Không có dữ liệu</div>';
            }
        }

        public function xuatmota($sql){
            $link = $this->connect();
            $ketqua = mysql_query($sql, $link);
            $i = mysql_num_rows($ketqua);
            if($i>0){
                while($row=mysql_fetch_array($ketqua)){
                    $MoTa = $row['MoTa'];
                    echo '<div class="mota col-xl col-lg col-md col-sm">
                            <center><h3><strong>Mô Tả</strong></h3></center>';
                    if($MoTa!='')
                        echo '<div class="tt_mota"><p>'.$MoTa.'</p></div>';
                    else echo '<center>Không có mô tả.</center>';
                    echo '</div>';
                }
            }
            mysql_close($link);
        }

        public function themdanhgia(){
            $link = $this->connect();
            if(isset($_POST['guidanhgia'])){
                if(isset($_SESSION['user']) && isset($_REQUEST['mamon'])){
                    $username = $_SESSION['user'];
                    $mamon = $_REQUEST['mamon'];
                    $noidung=$_REQUEST['nhapdanhgia'];
                    if($noidung!='')
                    {
                        $sql = "insert into danhgia (MaMon, NoiDung, Username) values ('$mamon', '$noidung', '$username')";
                        $ketqua = mysql_query($sql, $link);
                        if($ketqua){
                            echo '<script language="javascript">window.location="../QuanLyBepAn/xem-mon-an.php?mamon='.$mamon.'";</script>';
                        }
                        else{
                            echo '<script language="javascript">alert("Không thành công");</script>';
                            echo '<script language="javascript">window.location="../QuanLyBepAn/xem-mon-an.php?mamon='.$mamon.'";</script>';
                        }
                    }
                    else{
                        echo '<script language="javascript">alert("Vui lòng nhập nội dung đánh giá.");</script>';
                        
                    }
                }
                else{
                    echo '<script language="javascript">alert("Vui lòng đăng nhập để đánh giá.");</script>';
                }
            }
            mysql_close($link);
        }

        public function xuatdanhgia($sql){
            $link = $this->connect();
            $ketqua = mysql_query($sql, $link);
            $i = mysql_num_rows($ketqua);
            echo '<span><strong>'.$i.' bài đánh giá</strong></h3>';
            if($i>0){
                while($row=mysql_fetch_array($ketqua)){
                    $MaMon = $row['MaMon'];
                    $NoiDung = $row['NoiDung'];
                    $Username = $row['Username'];
                    $Ngay = $row['Ngay'];
                    echo '<div class="row">
                                <div class="tt_danhgia">
                                    <div class="nd_tendanhgia">
                                        <img class="avt" src="img/avt_macdinh.jpg" alt="avt" width="30" height="30">
                                        <strong class="nd_username">'.$Username.'</strong>
                                        <span class="nd_ngay">'.$Ngay.'</span>
                                        <button style="border: none; background-color: #dde1e2;">...</button>
                                    </div>
                                    <div class="nd_danhgia"><p>'.$NoiDung.'</p></div>
                                </div>
                          </div>';
                }
            }
            mysql_close($link);
        }

        public function xuatloaimon($sql){
            $link = $this->connect();
            $ketqua = mysql_query($sql, $link);
            $i = mysql_num_rows($ketqua);
            if($i>0){
                while($row=mysql_fetch_array($ketqua)){
                    $Loai = $row['Loai'];
                    return $Loai;
                }
            }
            mysql_close($link);
        }

        public function xuatmonankhac($sql,$mamondangxem){
            $link = $this->connect();
            $ketqua = mysql_query($sql, $link);
            $i = mysql_num_rows($ketqua);
            if($i>0){
                echo '<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                        <div class="row">
                            <center><h3><strong>Món Ăn Khác</strong></h3></center>';
                                while($row=mysql_fetch_array($ketqua)){
                                    $MaMon = $row['MaMon'];
                                    if($MaMon!=$mamondangxem){
                                        $TenMon = $row['TenMon'];
                                        $Gia = $row['Gia'];
                                        $MoTa = $row['MoTa'];
                                        $HinhAnh = $row['HinhAnh'];
                                        $Loai = $row['Loai'];
                                        echo '<div class="monan"><a href="http://localhost:8080/QuanLyBepAn/xem-mon-an.php?mamon='.$MaMon.' " style="text-decoration: none;">
                                                <div class="monan_hinh"><img src="img/'.$Loai.'/'.$HinhAnh.'" alt="'.$TenMon.'"></div>
                                                <div class="monan_nd">
                                                    <div class="monan_ten">'.$TenMon.'</div>
                                                    <div class="monan_mota"><p style="color: black">'.$MoTa.'</p></div>
                                                    <div class="monan_gia">'.number_format($Gia).'đ</div>
                                                    <div class="monan_xemthem"><button>Xem thêm</button></div>
                                                </div>
                                            </a></div>';
                                    }
                                }
                echo '  </div>
                    </div>';
            }
            else{
                echo '<div style="text-align: center; max-height: 240px;">Không có dữ liệu</div>';
            }
            mysql_close($link);
        }

        public function themsuagiohang($sql){
			$link = $this->connect();
			if(mysql_query($sql, $link)){
				return 1;
			}
			else{
				return 0;	
			}
		}

        public function kiemtragiohang($sql){
            $link = $this->connect();
            $ketqua = mysql_query($sql, $link);
            $i = mysql_num_rows($ketqua);
            if($i>0){
                return 1;
            }
            return 0;
            mysql_close($link);
        }
    }
?>