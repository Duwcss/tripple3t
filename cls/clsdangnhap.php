<?php
    class login{
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

        public function mylogin($user, $pass){
            $pass=md5($pass);
            $sql = "select * from taikhoan where username='$user' and password='$pass' limit 1";
            $link = $this->connect();
            $ketqua = mysql_query($sql, $link);
            $i = mysql_num_rows($ketqua);
            if($i>0){
                while($row=mysql_fetch_array($ketqua)){
                    $id = $row['id'];
                    $username = $row['username'];
                    $password = $row['password'];
                    $hovaten = $row['hovaten'];
                    $email = $row['email'];
                    $phanquyen = $row['phanquyen'];
                    session_start();
                    $_SESSION['id'] = $id;
                    $_SESSION['user'] = $username;
                    $_SESSION['pass'] = $password;
                    $_SESSION['hovaten'] = $hovaten;
                    $_SESSION['email'] = $email;
                    $_SESSION['phanquyen'] = $phanquyen;
                    header('location:../QuanLyBepAn/trang-chu.php');
                }
            }
            else{
                echo '<script language="javascript">alert("Username hoặc Password không chính xác");</script>';
                echo '<script language="javascript">window.location="../QuanLyBepAn/dang-nhap.php";</script>';
            }
        }

        public function confirmlogin($id, $user, $pass, $phanquyen){
            $sql = "select id, username, password, phanquyen from taikhoan where id='$id' and username='$user' and password='$pass' and phanquyen='$phanquyen' limit 1";
            $link = $this->connect();
            $ketqua = mysql_query($sql, $link);
            $i = mysql_num_rows($ketqua);
            if($i>0){
                //if($phanquyen!=1){
                   // header('location:../QuanLyBepAn/dang-nhap.php');
                //}
            }
        }

        public function themtaikhoan($user, $pass, $hovaten, $email){
            $sql = "insert into taikhoan (username, password, hovaten, email) values ('$user', '$pass', '$hovaten', '$email')";
            $link = $this->connect();
            $ketqua = mysql_query($sql, $link);
            if($ketqua){
                echo '<script language="javascript">alert("Đăng ký thành công");</script>';
                echo '<script language="javascript">window.location="../QuanLyBepAn/dang-nhap.php";</script>';
            }
            else{
                echo '<script language="javascript">alert("Đăng ký không thành công");</script>';
                echo '<script language="javascript">window.location="../QuanLyBepAn/dang-ky.php";</script>';
            }
        }
    }
?>