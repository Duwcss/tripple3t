<!DOCTYPE html>
<html lang="en">
<head>
    <title>Trang Chủ</title>
    <style>
        .img_aside1 img,
        .img_aside2 img {
            width: 100%;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }

        .aside1 p{
            font-size: 35px;
            line-height: 1.6;
        }
        .aside2 p{
            font-size: 18px;
            line-height: 1.6;
        }
        @media (max-width: 767px){
            h3,h1{text-align: center}
            .aside1 p, .aside2 p{ font-size: 16px; line-height: 16px; text-align: center}
        }
    </style>
<?php include("header.php"); ?>
    <!--===================MAIN=====================-->
    <div class="container-fluid">
        <div class="row">
            <img class="img_banner" src="img/vegetables-set-left-black-slate.jpg" style="border-radius: 50px;">
        </div>
        
        <div class="row mt-5">
            <div class="img_aside1 col-xl-4 col-lg-4 col-md-4 col-sm-12">
                <img src="img/DSC00047-683x1024.jpg" alt="">
            </div>
            <div class="aside1 col-xl-8 col-lg-8 col-md-8 col-sm-12">
                <h3><strong>Tripple3T có gì đặc biệt?</strong></h3>
                <p>Chúng mình là một gian bếp "như Quê nhà bạn" và là một nhà hàng "hiện đại nhưng lưu giữ những điều cũ kỹ". Bạn sẽ được chăm sóc bằng những món ăn quen thuộc từ các vùng miền Việt Nam, nấu lên từ rau củ quả tươi, một bữa ăn 100% thuần thực vật được nảy lên từ đất. Cùng với những điệu nhạc Jazz trong một không gian hiện đại xen lẫn xưa cũ, chúng mình tin bạn sẽ thấy thoải mái vô cùng.</p>
            </div>
        </div>

        <div class="row mt-5">
            <div class="aside2 col-xl-8 col-lg-8 col-md-4 col-sm-12">
                <h3><strong>Những món ăn thương nhớ</strong></h3>
                <h1><strong>Quá Ngon!</strong></h1>
                <p>Những món ăn tại Tripple3T được sắp xếp một cách hữu ý như lời gợi ý khéo léo cách để bạn bắt đầu một ngày mới và khép lại một ngày dài nhưng vẫn được cảm thấy ăn đầy – sống trọn vẹn từng khoảnh khắc!Những món này “NGON Á!!!” là những món đã được Bếp trưởng đầu tư sự sáng tạo trong từng công thức nấu và được quý khách đánh giá là “món phải ăn” tại Vị Quê Kitchen. Bạn thử liền nha!</p>
            </div>
            <div class="img_aside2 col-xl-4 col-lg-4 col-md-8 col-sm-12">
                <img src="img/photo-1504674900247-0877df9cc836.jpg" alt="">
            </div>
        </div>
    </div>

<?php include("footer.php"); ?>