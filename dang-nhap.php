<?php 
    include('cls/clsdangnhap.php'); 
    $p = new login();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/dang-nhap.css">
    <title>Đăng nhập</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <form id="form1" name="form1" method="post">
                <center><img src="img/logo.jpg" alt="logo"></center>
                <table width="550" border="0" align="center" cellpadding="5" cellspacing="0" class="col-md-6 col-md-offset-3">
                    <tbody>
                        <tr>
                            <td width="150" align="left" valign="midle"><Strong>Username</Strong></td>
                            <td width="350" align="left" valign="midle">
                                <input type="text" name="txtuser" id="txtuser" size="50">
                            </td>
                        </tr>
                        <tr>
                            <td align="left" valign="midle"><Strong>Password</Strong></td>
                            <td align="left" valign="midle">
                                <input type="password" name="txtpass" id="txtpass" size="50">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center" valign="middle">
                                <input type="submit" name="nut" id="nut" value="Đăng Nhập">
                                <input type="reset" name="reset" id="reset" value="Reset">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="padding-top: 10px;">
                                <a href="#" style="float: left;">Quên mật khẩu?</a>
                                <a href="http://localhost:8080/QuanLyBepAn/dang-ky.php" style="float: right;">Tạo tài khoản</a>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div align="center">
                    <?php
                        switch($_POST['nut']){
                            case 'Đăng Nhập':{
                                $user = $_REQUEST['txtuser'];
                                $pass = $_REQUEST['txtpass'];
                                if($user!='' && $pass!=''){
                                    $p -> mylogin($user, $pass);
                                }
                                else{
                                    echo '<script language="javascript">alert("Vui lòng nhập đầy đủ thông tin");</script>';
                                    echo '<script language="javascript">window.location="../QuanLyBepAn/dang-nhap.php";</script>';
                                }
                                break;
                            }
                        }
                    ?>
                </div>
            </form>
        </div>
    </div>
</body>
</html>