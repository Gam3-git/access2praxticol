<?php date_default_timezone_set("Asia/Bangkok");

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="jquery/sweetalert2.all.min.js"></script>
    <link href="css/custome.css" rel="stylesheet">
    <title>Acce2Ecms</title>
   
<script type="text/javascript" src="court_ecms.js"></script>
<script type="text/javascript">

            $(document).ready(function(){
            court_text();
            
            $("#uploadBtn").attr("disabled", true);
            $("#showBtn").attr("disabled", true);

            $("#caseB").keypress(function(event) {
                if (event.keyCode == 13) {
                    event.preventDefault(); 
                    $("#caseBtn").click();
                
                } });
            

            $("#quit_case").click(function(){ 
                window.location.href ="_logout.php";
              });

            $("#caseBtn").click(function(){
                search_case();  
            });

            $("#uploadBtn").click(function(){
                upload_case();  });

            $("#showBtn").click(function(){
                show_case();    });

            $("#DBtn").click(function(){
                window.open("http://10.37.76.250:9090/access2praxticol/access2RED.php","_self"); });

            $("#menu_case").click(function(){
                window.open("/access2praxticol/_portal.php","_self"); });
 

            });

</script>
</head>
<body>
<div class="container">

        <div class="row no-gutters">
        <div class="col-12">
                    <table style="height: 100%; width: 100%"><tbody><tr>
                    <td class="text-warning bg-dark text-center">
                    <p style="font-size:20px;" name="courtN" id="courtN"></p>
                    <span name="userN" id="userN"><?php echo $name_ses. " ตำแหน่ง " .$Po_ses;?></span>
                    <input type="hidden" id="userId" name="userId" value="<?php echo $id_ses;?>">
                    <input class="btn-danger" type="button" name="quit_case" id="quit_case" value="ออกจากระบบ">
                    <input class="btn-light" type="button" name="menu_case" id="menu_case" value="กลับหน้าหลัก">
                </td></tr></tbody></table>
        </div></div>


        <div class="row no-gutters">
        <div class="col-12">
                <table style="height: 100%; width: 100%"><tbody><tr>
                    <td class="text-light bg-dark text-center">
                    <p style="font-size:30px;">ค้นหาหมายเลขคดีดำ
                    <input type="text" name="caseB" id="caseB" placeholder="พ.1/61,อ1/63,ผบE1/2563" value="" autofocus> 
                    <input type="button" name="caseBtn" id="caseBtn" value="ค้นหา"></p> 
                    </td></tr></tbody></table>
        </div></div>

        <div class="row no-gutters">
        <div class="col-6">
                <form name = "form2" id="form2" method="post">
                <table style="height: 100%; width: 100%"><tbody>
                                <tr><td class="text-right"> 
                                <p style="font-size:20px;"><label for="obt1">หมายเลขคดีดำ</label>
                                <input type="text" size="30" style="font-size:20px;" id="obt1" name="obt1"  value=""> </p> 
                                </td></tr>
                                <tr><td class="text-right"> 
                                <p style="font-size:20px;"><label for="obt2">ข้อหา</label> 
                                <input type="text" size="30" style="font-size:20px;" id="obt2" name="obt2"  value=""> </p> 
                                </td></tr>
                                <tr><td class="text-right"> 
                                <p style="font-size:20px;"><label for="obt3">โจทก์</label> 
                                <input type="text" size="30" style="font-size:20px;" id="obt3" name="obt3"  value=""> </p>  
                                </td></tr>
                                <tr><td class="text-right"> 
                                <p style="font-size:20px;"><label for="obt4">จำเลย</label> 
                                <input type="text" size="30" style="font-size:20px;" id="obt4" name="obt4"  value=""> </p>  
                    </td></tr></tbody></table></form>
        </div><div class="col-6">
                <form name = "form3" id="form3" method="post">
                <table style="height: 100%; width: 100%"><tbody>
                                <tr><td class="text-right">
                                <p style="font-size:20px;"><label for="obt8">หมายเลขคดีแดง</label> 
                                <input type="text" style="font-size:20px;" id="obt8" name="obt8"  value=""> </p>  
                                </td></tr>
                                <tr><td class="text-right"> 
                                <p style="font-size:20px;"><label for="obt7"> ประเภทคดี 
                                <input type="text" style="font-size:20px;" id="obt7" name="obt7"  value=""> </p> 
                                </td></tr>
                                <tr><td class="text-right"> 
                                <p style="font-size:20px;"><label for="obt6"> ความ
                                <input type="text" style="font-size:20px;" id="obt6" name="obt6"  value=""> </p>  
                                </td></tr>
                                <tr><td class="text-right"> 
                                <p style="font-size:20px;"><label for="obt9"> คำฟ้อง/คำร้อง
                                <input type="text" style="font-size:20px;" id="obt9" name="obt9"  value=""> </p>  
                                </td></tr>
                                <tr><td class="text-right"> 
                                <p style="font-size:20px;"><label for="obt5"> วันรับฟ้อง
                                <input type="text" style="font-size:20px;" id="obt5" name="obt5"  value=""> </p>  
                                </td></tr></tbody></table></form>
        </div></div>

                <div class="row no-gutters">
                <div class="col-12">
                <form name = "form4" id="form4" method="post">
                <table style="height: 100%; width: 100%"><tbody>
                                <tr><td class="text-center">
                                <input class="btn-danger" type="button" name="uploadBtn" id="uploadBtn" value="   อัพโหลด   "  style="font-size:20px;" >
                                <input class="btn-success" type="button" name="showBtn" id="showBtn" value="  แสดงเอกสาร  "  style="font-size:20px;" >
                                </td></tr></tbody></table></form>
                </div>
                </div>
               
</div>
</body>
</html>