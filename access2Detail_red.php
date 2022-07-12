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
    <!-- <link href="bootstrap/bootstrap-datepicker-thai/css/datepicker.css" rel="stylesheet">
    <script type="text/javascript" src="bootstrap/bootstrap-datepicker-thai/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="bootstrap/bootstrap-datepicker-thai/js/bootstrap-datepicker-thai.js"></script>
    <script type="text/javascript" src="bootstrap/bootstrap-datepicker-thai/js/locales/bootstrap-datepicker.th.js"></script> -->
    
    <title>Acce2RRED</title>
   
<script type="text/javascript" src="rcase/rcase.js"></script>
<script type="text/javascript">

            $(document).ready(function(){
                            
            court_text();
            detail_casetemp();

           $("#caseT").keypress(function(e) {
            if (e.keyCode == 13) {
                e.preventDefault(); 
                $("#caseBtn").click();
                } });   

            $("#caseBtn").click(function(){ 
                $("#caseT").blur();
                search_redDe();
              });

            $("#obt7").keypress(function(e) {
            if (e.keyCode == 13) {
                e.preventDefault(); 
                $("#B_DeBtn").click();
                } }); 

              $("#B_DeBtn").click(function(){ 
                Swal.fire({
                    title: "แทนสารบบด้วยรูปแบบที่เลือก",
                    showDenyButton: true,
                    showCancelButton: false,
                    confirmButtonText: 'ปิด',
                    confirmButtonColor: '#000',
                    denyButtonText: 'ใช่',
                    denyButtonColor: '#FF0000',
                  }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.close(); 
                    } else if (result.isDenied) {
                      $("#obt8").val($("#obt7").val());
                    }
                })
              });

            $("#obt10").keypress(function(e) {
            if (e.keyCode == 13) {
                e.preventDefault(); 
                $("#R_DeBtn").click();
                } }); 

              $("#R_DeBtn").click(function(){ 
                Swal.fire({
                    title: "แทนสารบบด้วยรูปแบบที่เลือก",
                    showDenyButton: true,
                    showCancelButton: false,
                    confirmButtonText: 'ปิด',
                    confirmButtonColor: '#000',
                    denyButtonText: 'ใช่',
                    denyButtonColor: '#FF0000',
                  }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.close(); 
                    } else if (result.isDenied) {
                      $("#obt11").val($("#obt10").val());
                    }
                })
              });

            $("#obt9").click(function(){ 
              if ( $("#obt9").val() === "" ) {$("#obt9").val(new Date().toLocaleDateString("th-TH")) }
            });
            
            $("#obt12").click(function(){ 
              if ( $("#obt12").val() === "" ) {$("#obt12").val(new Date().toLocaleDateString("th-TH")) }
            });

            $("#B_saveBtn").click(function(){ 
              if ( $("#obt9").val() === "" ) {$("#obt9").val(new Date().toLocaleDateString("th-TH")) }
              if ( $("#obt8").val() === "" ) { Swal.fire('ไม่มีข้อมูลสารบบดำ') }
              else { add_detail(1); }
            });

            $("#R_saveBtn").click(function(){ 
              if ( $("#obt12").val() === "" ) {$("#obt12").val(new Date().toLocaleDateString("th-TH")) }
              if ( $("#obt11").val() === "" ) { Swal.fire('ไม่มีข้อมูลสารบบแดง') }
              else { add_detail(2); }
            });
            

            $("#menu_case").click(function(){
                window.open("/access2praxticol/_portal.php","_self"); });
              
            $("#quit_case").click(function(){ 
                window.location.href ="_logout.php"; });

            });

</script>
<style> 
			body {font-family: 'Sarabun-Regular' !important;} 
</style>
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
                    <input type="hidden" id="userNa" name="userNa" value="<?php echo $name_ses;?>">
                    <input class="btn-danger" type="button" name="quit_case" id="quit_case" value="ออกจากระบบ">
                    <input class="btn-light" type="button" name="menu_case" id="menu_case" value="กลับหน้าหลัก">
                  </td></tr></tbody></table>
        </div></div>


        <div class="row no-gutters">
        <div class="col-12">
                <table style="height: 100%; width: 100%"><tbody><tr>
                    <td class="text-light bg-dark text-center">
                    <p style="font-size:25px;">ค้นหาคดีดำ
                    <input type="text" name="caseT" id="caseT"  value="" autofocus> 
                    <input type="button" name="caseBtn" id="caseBtn" value="ค้นหา"></p> 
                    </td></tr></tbody></table>
        </div></div>

        <div class="row">

        <div class="col-12 mt-2">
                <form name = "form1" id="form1" method="post">
                <table class="table table-bordered table-sm text-left">
                <tbody>
                    <tr><td style="width: 12%">หมายเลขคดีดำ : </td><td style="width: 18%"><a id="obt1" name="obt1"> </a></td>
                    <td style="width: 10%">ประเภทคดี : </td><td style="width: 20%"><a id="obt2" name="obt2"> </a></td>
                    <td style="width: 8%">ข้อหา : </td><td style="width: 32%"><a  id="obt3" name="obt3"> </a></td></tr>
                    <tr><td style="width: 12%">หมายเลขคดีแดง : </td><td style="width: 18%"><a style="color:red;" id="obt4" name="obt4"> </a></td>
                    <td style="width: 10%">โจทก์/ผู้ร้อง </td><td style="width: 20%"><a id="obt5" name="obt5"> </a></td>
                    <td style="width: 8%">จำเลย /<br>ผู้ตาย </td><td style="width: 32%"><a id="obt6" name="obt6"> </a></td></tr>
                </tbody>
                </table></form>
          </div></div>

        <div class="row">
                <div class="col-6 text-light bg-dark">
                <form name = "form2" id="form2" method="post">
                <p style="font-size:20px;">บันทึกสารบบความ
                  <label for="">|| เลือกรหัส : </label>
                  <select style="font-size:15px; width: 35%" id="obt7" name="obt7">
                      <option selected>  -- เลือกข้อมูล -- </option>
                  </select>
                  <input class="btn-danger" type="button" name="B_DeBtn" id="B_DeBtn" value="+">
                </p>
                <textarea style="min-width: 100%;" id="obt8" name="obt8" rows="15"></textarea>
                <p class="mt-2" style="font-size:15px;">วันที่พิมพ์ : <input type="text" name="obt9" id="obt9"  value=""> 
                <input type="button" name="B_saveBtn" id="B_saveBtn" value="บันทึก"> 
                <input type="hidden" id="dateb" name="dateb" value="">
                </p>
                </form></div>
                <div class="col-6 text-light bg-dark">
                <form name = "form3" id="form3" method="post">
                <p style="font-size:20px;">บันทึกสารบบคำพิพากษา
                <label for="">|| เลือกรหัส : </label>
                  <select style="font-size:15px; width: 35%" id="obt10" name="obt10">
                      <option selected>  -- เลือกข้อมูล -- </option>
                  </select>
                  <input class="btn-danger" type="button" name="R_DeBtn" id="R_DeBtn" value="+">
                </p>
                <textarea style="color:red; min-width: 100%;" id="obt11" name="obt11" rows="15"></textarea> 
                <p class="mt-2" style="font-size:15px;"> วันที่พิมพ์ : <input style="color:red;" type="text" name="obt12" id="obt12"  value=""> 
                <input type="button" name="R_saveBtn" id="R_saveBtn" value="บันทึก"></p>
                </form></div>
        </div>
</body>
</html>