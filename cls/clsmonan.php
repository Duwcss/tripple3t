<?php
session_start();
	class qlba
	{
		
		public function connect()
		{
			$con = mysql_connect("localhost","Tripple3T","123456");
			if($con)
			{
				$db = mysql_select_db("qlba");
				mysql_query("SET NAMES UTF8");
				return $con;
			}
			else
			{
				echo'khong ket noi duoc co so du lieu';
				exit();
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
		public function loadmonan($sql){
            $link = $this->connect();
            if(!isset($_REQUEST['page'])) $page=1;
            else $page=$_REQUEST['page'];
            $tranghientai = ($page-1)*12;
            $ketqua = mysql_query($sql." limit $tranghientai, 12", $link);
            $i = mysql_num_rows($ketqua);
            if($i>0){
				$dem=$tranghientai + 1;
                while($row=mysql_fetch_array($ketqua)){
                    $MaMon = $row['MaMon'];
                    $TenMon = $row['TenMon'];
					$MoTa = $row['MoTa'];
                    $Gia = $row['Gia'];
                    $HinhAnh = $row['HinhAnh'];
                    $Loai = $row['Loai'];
                    echo '<tr>
							<td align="center" valign="middle">'.$dem.'</td>
							<td align="center" valign="middle">'.$MaMon.'</td>
							<td align="center" valign="middle">'.$TenMon.'</td>
							<td align="justify" valign="middle">'.$MoTa.'</td>
							<td align="center" valign="middle">'.number_format($Gia).'đ</td>
							<td align="center" valign="middle"><img src="img/'.$Loai.'/'.$HinhAnh.'" alt="'.$TenMon.'" width="150"></td>
							<td align="center" valign="middle">'.$Loai.'</td>
							
							<td><form action="themthucdon.php" method="post">
									<input type="submit" name="select" id="select" value="Chọn món">
									<input type="hidden" name="mamon" value="'.$MaMon.'">
									<input type="hidden" name="tenmon" id="tenmon" value="'.$TenMon.'">
									<input type="hidden" name="gia" value="'.$Gia.'">
									<input type="hidden" name="hinhanh" value="'.$HinhAnh.'">
									<input type="hidden" name="loai" value="'.$Loai.'">
								</form></td>
						</tr>';
					$dem++;
                }
            }
            else{
                echo '<tr><td colspan="8" align="center" valign="middle">Không có dữ liệu</td></tr>';
            }
            mysql_close($link);
        }

		function xuatmonan($sql)
			{
				$link = $this->connect();
				$ketqua = mysql_query($sql,$link);
				$i=mysql_num_rows($ketqua);
				if($i>0)
				{
					while($row = mysql_fetch_array($ketqua))
					{
						$MaMon = $row['MaMon'];
						$TenMon = $row['TenMon'];
						$MoTa = $row['MoTa'];
						$Gia = $row['Gia'];
						$HinhAnh = $row['HinhAnh'];
						$DanhGia = $row['DanhGia'];
						
						echo '<tbody style="border-width:2px;">
									<tr>
									  <td id="'.$MaMon.'" name="mamon"><a style="text-decoration:none;color:black;" href="">'.$MaMon.'</a></td>
									  <td id="'.$TenMon.'" name="tenmon"><a style="text-decoration:none;color:black;" href="#">'.$TenMon.'</a></td>
									  <td id="'.$MoTa.'" name="mota"><a style="text-decoration:none;color:black;" href="#">'.$MoTa.'</a></td>
									  <td id="'.$Gia.'" name="gia"><a style="text-decoration:none;color:black;" href="#">'.$Gia.'</a></td>
									  <td id="'.$HinhAnh.'" name="hinhanh"><a style="text-decoration:none;color:black;" href="#">'.$HinhAnh.'</a></td>
									  <td><form action="themthucdon.php" method="post">
											<input type="submit" name="select" id="select" value="Chọn món">
											<input type="hidden" name="mamon" value="'.$MaMon.'">
											<input type="hidden" name="tenmon" id="tenmon" value="'.$TenMon.'">
											<input type="hidden" name="gia" value="'.$Gia.'">
											<input type="hidden" name="hinhanh" value="'.$HinhAnh.'">
											</form></td>
									</tr>
								</tbody>';
					}
					echo '</table>';
				}
				else
				{
					echo'khong co du lieu';
				}
			}
			function chonMon($selectedMon) {
				// Giả sử $_SESSION['thucDon'] chứa thực đơn hiện tại, bạn cần điều chỉnh để phản ánh cấu trúc của thực đơn trong ứng dụng của bạn
				if (isset($_SESSION['monchinh'])) {
					$thucDon = $_SESSION['monchinh'];
		
					// Kiểm tra xem món ăn đã được chọn có trùng với món ăn trong thực đơn hay không
					if (in_array($selectedMon, $thucDon)) {
						echo 'Món ăn đã có trong thực đơn!';
					} else {
						echo 'Chọn món ăn thành công!';
					}
				} else {
					echo 'Lỗi: Thực đơn không được định nghĩa.';
				}
			}
			function chotcot($sql)
			{
				$link = $this->connect();
				$ketqua = mysql_query($sql,$link);
				$i=mysql_num_rows($ketqua);
				$giatri = '';
				if($i>0)
				{
					while($row = mysql_fetch_array($ketqua))
					{
						$giatri = $row[0];
					}
				}
				return $giatri;
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
			public function themxoasua($sql)
			{
				$link = $this->connect();
				if(mysql_query($sql,$link))
				{
					return 1;	
				}
				else
				{
					return 0;
				}
			} 
	}
?>