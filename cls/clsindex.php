<?php
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
		function xuatthucdon($sql)
			{
				$link = $this->connect();
				$ketqua = mysql_query($sql,$link);
				$i=mysql_num_rows($ketqua);
				if($i>0)
				{
					echo '<table width="800" border="1" align="center">
							<tr>
							  <td colspan="3" align="center" style="border-bottom:1px solid black;">Thực đơn hôm nay</td>
							</tr>
							<tr>
							  <td width="180" align="center" >Mã thực đơn</td>
							  <td width="391" align="center">Ngày lập</td>
							  <td width="207" align="center">Giá</td>
							</tr>';
					while($row = mysql_fetch_array($ketqua))
					{
						$maThucDon = $row['maThucDon'];
						$ngayLap = $row['ngayLap'];
						$Gia = $row['gia'];
						
						echo '<tr>
								  <td id="maThucDon" align="center";"><a href="?laymaThucDon='.$maThucDon.'">'.$maThucDon.'</a></td>
								  <td id="ngayLap" align="center"><a href="?laymaThucDon='.$maThucDon.'">'.$ngayLap.'</a></td>
								  <td id="Gia" align="center"><a href="?laymaThucDon='.$maThucDon.'">'.$Gia.'<sup>đ</sup></a></td>
								</tr>';
					}
					echo '</table>';
				}
				else
				{
					echo '<table width="800" border="1" align="center">
							<tr>
							  <td colspan="3" align="center">Danh sách thực đơn</td>
							</tr>
							<tr>
							  <td width="180" align="center">Mã thực đơn</td>
							  <td width="391" align="center">Ngày lập</td>
							  <td width="207" align="center">Giá</td>
							</tr>';
					echo'	<table width="800" border="1" align="center">
							<tr>
							<td width="600" align="center">Không có dữ liệu</td>
							</tr>';
				}
			}
			function monan($sql)
			{
				$link = $this->connect();
				$ketqua = mysql_query($sql,$link);
				$i=mysql_num_rows($ketqua);
				if($i>0)
				{
					while($row = mysql_fetch_array($ketqua))
					{
						$tenmonan = $row['TenMon'];
						$Gia = $row['GiaMon'];
						$HinhAnh = $row['HinhAnhMon'];
						$Loai = $row['Loai'];
						echo '<div style="float:left;margin-left:10px;">
								<div align="center"><img src="img/'.$Loai.'/'.$HinhAnh.'" alt="'.$tenmon.'" width="150px" height="100px"></div>
								<div align="center">'.$tenmonan.'</div>
								<div align="center">Giá: '.$Gia.'<sup>đ</sup></div>
							</div>';
					}
				}
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
	}
?>