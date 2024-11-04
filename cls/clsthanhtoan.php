<?php
    include("clsthucdon.php");
    class thanhtoan extends thucdon{
        public function tinhtongtien($sql){
            $link = $this->connect();
            $ketqua = mysql_query($sql, $link);
            $i = mysql_num_rows($ketqua);
            $TongTien=0;
            if($i>0){
                while($row = mysql_fetch_array($ketqua)){
                    $SoLuong = $row['SoLuong'];
                    $Gia = $row['Gia'];
                    $ThanhTien = $row['ThanhTien'];
                    $TongTien+=$ThanhTien;
                }
            return $TongTien;
            mysql_close($link);
            }
        }
    }
?>