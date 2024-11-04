<?php
    include("clsthucdon.php");
    class quanly extends thucdon{
		
		public function xuatchucnang(){
			echo '<ul>
                    <li><a href="http://localhost:8080/QuanLyBepAn/trang-quan-ly.php">Quản Lý Món Ăn</a></li>
                    <li><a href="#">Quản Lý Nguyên Liệu</a></li>
                    
					<li><a href="thucdon.php">Quản lý thực đơn</a></li>
                    <li><a href="http://localhost:8080/QuanLyBepAn/tinhtoannvl.php">Tính Toán NVL</a></li>
                    <li><a href="#">Thống Kê Món Ăn</a></li>
                </ul>';	
		}
		
		public function loadloaimon($sql, $loaimon){
			$link = $this->connect();
			$ketqua = mysql_query($sql, $link);
			$i = mysql_num_rows($ketqua);
			if($i>0){
				echo '<select name="loai" id="loai">
						<option>Chọn loại món</option>';
				while($row = mysql_fetch_array($ketqua)){
					$id=$row['id'];
					$Ten=$row['Ten'];
					if($id==$loaimon){
                        echo '<option value="'.$id.'" selected>'.$Ten.'</option>';
                    }
                    else{
                        echo '<option value="'.$id.'">'.$Ten.'</option>';
                    }
				}
				echo '</select>';
			}
			else{
				echo 'Đang cập nhật dữ liệu';
			}
			mysql_close($link);
		}
		
		public function uphinh($name, $folder, $tmp_name){
            if($name!='' && $folder!='' && $tmp_name!=''){
                $newname = $folder.'/'.$name;
                if(move_uploaded_file($tmp_name, $newname)){
                    return 1;
                }
                else{
                    return 0;
                }
            }
            else{
                return 0;
            }
        }
		
		public function themxoasuamonan($sql){
			$link = $this->connect();
			if(mysql_query($sql, $link)){
				return 1;
			}
			else{
				return 0;	
			}
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
							<td align="center" valign="middle"><a href="?mamon='.$MaMon.'"><button type="button" class="openmodal2" data-toggle="modal" data-target="#modal2">Chọn</button></a></td>
						</tr>';
					$dem++;
                }
            }
            else{
                echo '<tr><td colspan="8" align="center" valign="middle">Không có dữ liệu</td></tr>';
            }
            mysql_close($link);
        }

		public function choncot($sql){
            $link = $this->connect();
            $ketqua = mysql_query($sql, $link);
            $i = mysql_num_rows($ketqua);
            $giatri = '';
            if($i>0){
                while($row = mysql_fetch_array($ketqua)){
                    $giatri = $row[0];
                }
            }
            return $giatri;
        }

        public function loadnvl($sql){
            $link = $this->connect();
            $ketqua = mysql_query($sql, $link);
            $i = mysql_num_rows($ketqua);
            if($i>0){
                $dem=1;
                while($row=mysql_fetch_array($ketqua)){
                    $MaNVL = $row['MaNVL'];
                    $TenNVL = $row['TenNVL'];
                    $TongKhoiLuong = $row['TongKhoiLuong']; // Sửa đổi cột KhoiLuong
                    $DonGia = $row['DonGia'];
                    $DonVi = $row['DonVi'];
                    echo '<tr>
                            <td align="center" valign="middle">'.$dem.'</td>
                            <td align="center" valign="middle">'.$MaNVL.'</td>
                            <td align="center" valign="middle">'.$TenNVL.'</td>
                            <td align="center" valign="middle">'.$TongKhoiLuong.'</td>
                            <td align="center" valign="middle">'.number_format($DonGia).'đ</td>
                            <td align="center" valign="middle">'.$DonVi.'</td>
                        </tr>';
                    $dem++;
                }
            }
            else{
                echo '<tr><td colspan="6" align="center" valign="middle">Không có dữ liệu</td></tr>';
            }
            mysql_close($link);
        }

        public function tinhtoannvl($sql){
            $link = $this->connect();
            $tong = 0;
            $ketqua = mysql_query($sql, $link);
            if ($ketqua) {
                while ($row = mysql_fetch_array($ketqua)) {
                    $TenNVL = $row['TenNVL'];
                    $TongKhoiLuong = $row['TongKhoiLuong'];
                    $DonGia = $row['DonGia'];
                    $DonVi = $row['DonVi'];
                    $TongNVL = $TongKhoiLuong * $DonGia;
                    echo '<center><table class="table-secondary"><tbody>';
                    echo '<tr>
                                <td width="200" height="50" align="left" valign="middle">'.$TenNVL.'</td>
                                <td width="200" height="50" align="left" valign="middle">'.number_format($TongKhoiLuong, 1).' ('.$DonVi.') x '.number_format($DonGia).'đ</td>
                                <td width="20" height="50" align="center" valign="middle">=</td>
                                <td width="100" height="50" align="right" valign="middle">'.number_format($TongNVL) .'đ</td>
                          </tr>';
                    $tong += $TongNVL;
                }
                echo '<tr><td colspan="4" height="50" align="right" valign="middle"><hr><strong>Tổng nguyên vật liệu:</strong> '.number_format($tong).'đ</td></tr>';
                echo '</tbody></table></center>';
            } else {
                echo 'Đang cập nhật dữ liệu';
            }
            mysql_close($link);
        }
        
        
    }
?>