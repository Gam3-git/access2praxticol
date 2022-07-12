<?php date_default_timezone_set("Asia/Bangkok"); session_start(); session_destroy(); ?>
<html>
<head>
    <meta http-equiv="Content-Type" charset="UTF-8">
    <meta name="viewport" content="text/html, width=device-width, initial-scale=1.0">
    <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="css/custome.css" rel="stylesheet">
    <script src="jquery/sweetalert2.all.min.js"></script>
    <title>Acce2Ecms</title>
    
<script src="jquery/jquery-3.5.1.min.js"></script>
<script type="text/javascript">
            $(document).ready(function(){
                $.getJSON('court.json', function(msg) { 
                $("#courtN").html(msg.courtN);
                });

            

            // Swal.fire({ title: 'ระบบตั้งต้นคดีขัดข้อง อยู่หว่างส่วนกลางแก้ไข', icon: 'warning', 
            //     text: 'สามารถแนบเอกสารโดยตรงที่ระบบ ecms ',showConfirmButton: true}); 

            });
</script>
<body>
    <div class="container-fluid">
    <div class="row justify-content-center">
    <div class="col-5 text-center">
    <form method="post" action="_login.php">
	<img class="mb-3" src="img/coj1.png" alt width="180" >
	<h1 class="h3 mb-3 font-weight-normal">
    <p name="courtN" id="courtN"></p></h1>
	<p class="h6 mb-3 font-weight-normal">กรุณาเข้าสู่ระบบ </p>
	<input type="text" id="usern" name="usern" class="form-control" placeholder="รหัสผู้ใช้งาน" required="" autofocus>
	<input type="password" id="pass" name="pass" class="form-control" placeholder="รหัสผ่าน" required="">
	<button class="btn btn-lg btn-outline-primary mt-3" type="submit">เข้าสู่ระบบ</button><br>
	<p class="mt-3 bg-primary text-light"><br>ระบบงานข้อมูลคดี || ระบบแสกน || สำหรับตัังตนคดี<br>_</p>
	</form></div></div></div>
</body>
</html>