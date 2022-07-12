<?php 
date_default_timezone_set("Asia/Bangkok");
session_start();
$id_ses = $_SESSION["userPa"];
$name_ses = $_SESSION["userN"];
$Po_ses = $_SESSION["userPo"];

if(!isset($_SESSION["userPa"])){
    header("location:_logout.php");
    exit();
} 

?>
<html>
<head>
    <meta http-equiv="Content-Type" charset="UTF-8">
    <meta name="viewport" content="text/html, width=device-width, initial-scale=1.0">
    <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="fontawesome/css/all.css" rel="stylesheet">
    <script src="jquery/jquery-3.5.1.min.js"></script>
    <script src="jquery/sweetalert2.all.min.js"></script>
    <script src="bootstrap/dist/js/bootstrap.min.js"></script>
    <title>Acce2Ecms</title>
    <style> 

			  @font-face {
			  font-family: 'Kanit-Regular';
			  src:  url(bootstrap/dist/font/Kanit-Regular/Kanit-Regular.woff) format('woff'), 
				    url(bootstrap/dist/font/Kanit-Regular/Kanit-Regular.ttf)  format('truetype'), 
				    url(bootstrap/dist/font/Kanit-Regular/Kanit-Regular.svg#Kanit-Regular) format('svg'),
                    url(bootstrap/dist/font/Kanit-Regular/Kanit-Regular.eot) format('embedded-opentype');
			  font-weight: normal;
			  font-style: normal;
						}

			body {font-family: 'Kanit-Regular' !important;} 
         </style>
<script type="text/javascript">
            $(document).ready(function(){

                $.getJSON('court.json', function(msg) { 
                $("#courtN").html(msg.courtN); });

			$("#1Btn").click(function(){
			    window.open("/access2praxticol/access2RED.php", "_self"); });
            $("#2Btn").click(function(){
				window.open("/access2praxticol/access2Detail_red.php", "_self"); });
            $("#3Btn").click(function(){
                window.open("/access2praxticol/access2dms.php","_self"); });

            $("#MTBtn").click(function(){
			window.open("http://smkc.coj.go.th/th/weblink/item/index/id/184", "_blank"); });

            $("#quit_case").click(function(){ 
                window.location.href ="_logout.php";
              });
			
            });

</script>
<body>
<div class="container">
<div class="row">
        <div class="col-12 mb-2">
                    <table style="height: 100%; width: 100%"><tbody><tr>
                    <td class="text-warning bg-dark text-center">  
                    <p style="font-size:20px;" name="courtN" id="courtN"></p>
                    <p class="h3">งานข้อมูลคดี</p>  
                    <span name="userN" id="userN"><?php echo $name_ses. " ตำแหน่ง " .$Po_ses;?></span>
                    <input type="hidden" id="userId" name="userId" value="<?php echo $id_ses;?>">
                    <input class="btn-danger" type="button" name="quit_case" id="quit_case" value="ออกจากระบบ"> 
                </td></tr></tbody></table>
</div></div>



    <div class="row justify-content-center">

        <div class="col-6 text-center">
        <button class="btn btn-lg btn-warning btn-lg btn-block mt-3" name="3Btn" id="3Btn"><span><i class="fa-solid fa-file-arrow-up fa-2x"></i></span><br>ระบบแสกน(กรณีตั้งต้นคดี)</button>
        </div>
        <div class="col-6 text-center">
        <button class="btn btn-lg btn-Danger btn-lg btn-block mt-3" name="1Btn" id="1Btn"><span><i class="fa-solid fa-book fa-2x"></i></span><br>ระบบออกเลขแดง</button>
        <button class="btn btn-lg btn-secondary btn-lg btn-block mt-3" name="2Btn" id="2Btn" ><span><i class="fa-solid fa-book-open fa-2x"></i></span><br>ระบบบันทึกสารบบดำ/แดง</button>
        </div>
       
    </div>
    <div class="row justify-content-center mt-4">
        <div class="col-12 text-center">
        <button class="btn btn-lg btn-primary btn-lg btn-block" name="MTBtn" id="MTBtn" ><span><i class="fa-solid fa-scale-balanced fa-1x"></i></span>  ระบบงานส่วนกลาง</button>
    </div></div>
</div>
</body>
</html>