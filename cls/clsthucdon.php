<?php
    class thucdon{
        public function connect(){
            $con = mysql_connect("localhost", "Tripple3T", "123456");
            if(!$con){
                echo "Khong ket noi duoc csdl";
                exit(); 
            }
            else{
                mysql_select_db("qlba");
                mysql_query("set names utf8");
                return $con;
            }
        }

        public function phantrang($sql) {
            $link = $this->connect();
            $ketqua = mysql_query($sql, $link);
            $i = mysql_num_rows($ketqua);
            $sotrang = ceil($i/12);//mỗi trang hiển thị 12 món
            echo '<div class="pagination mt-3">';
            for($page=1;$page<=$sotrang;$page++){
                if(isset($_GET['loaimon'])) {
                    $pageloaimon = "&loaimon=".$_GET['loaimon'];
                }
                else {
                    $pageloaimon = "";
                }
                if(isset($_GET['timkiem'])) {
                    $pagetimkiem = "&timkiem=".$_GET['timkiem'];
                }
                else {
                    $pagetimkiem = "";
                }
                echo '<a href="?page='.$page.$pageloaimon.$pagetimkiem.'">'.$page.'</a>';
            }
            echo '</div>';
            mysql_close($link);
        }

        public function xuatdanhmuc($sql){
            $link = $this->connect();
            $ketqua = mysql_query($sql, $link);
            $i = mysql_num_rows($ketqua);
            if($i>0){
                echo '<div class="danhmuc col-xl-2 col-lg-2 col-md-3 col-sm-3">
                        <h4><strong>DANH MỤC</strong></h4>
                            <ul>';
                            while($row=mysql_fetch_array($ketqua)){
                                $id=$row['id'];
                                $Ten=$row['Ten'];
                                echo '<li><a href="?loaimon='.$id.'">'.$Ten.'</a></li>';
                            }
                echo '      </ul>
                    </div>';
            }
            else{

            }
            mysql_close($link);
        }

        public function xuattendanhmuc($sql){
            $link = $this->connect();
            $ketqua = mysql_query($sql, $link);
            $i = mysql_num_rows($ketqua);
            $Ten='';
            if($i>0){
                while($row=mysql_fetch_array($ketqua)){
                    $id=$row['id'];
                    $Ten=$row['Ten'];
                }
                return $Ten;
            }
            else{
                echo '';
            }
            mysql_close($link);
        }

        public function xuatmonan($sql){
            $link = $this->connect();
            if(!isset($_REQUEST['page'])) $page=1;
            else $page=$_REQUEST['page'];
            $tranghientai = ($page-1)*12;
            $ketqua = mysql_query($sql." limit $tranghientai, 12", $link);
            $i = mysql_num_rows($ketqua);
            if($i>0){
                while($row=mysql_fetch_array($ketqua)){
                    $MaMon = $row['MaMon'];
                    $TenMon = $row['TenMon'];
					$MoTa = $row['MoTa'];
                    $Gia = $row['Gia'];
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
            else{
                echo '<div style="text-align: center; max-height: 240px;">Không có dữ liệu</div>';
            }
            mysql_close($link);
        }

        public function timkiem($sql){
            $link = $this->connect();
            $ketqua = mysql_query($sql, $link);
            $i = mysql_num_rows($ketqua);
            if($i>0){
                return 1;
            }
            else{
                return 0;
            }
            mysql_close($link);
        }
    }
?>