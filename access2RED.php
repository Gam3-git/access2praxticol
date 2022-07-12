<?php date_default_timezone_set("Asia/Bangkok");

session_start();
$id_ses = $_SESSION["userPa"];
$name_ses = $_SESSION["userN"];
$Po_ses = $_SESSION["userPo"];
$Dep_ses = $_SESSION["userDep"];

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
    <title>Acce2RRED</title>
   
<script type="text/javascript" src="rcase/rcase.js"></script>
<script type="text/javascript">

            $(document).ready(function(){
                
            if($.isEmptyObject($("#caseT").val())){ $("#caseT").focus(); } else { $("#obt7").focus(); }
            $('#R_Btn').prop('disabled', true);
            $('#PR_Btn').prop('disabled', true);
            court_text();
            search_jud();

            $("#form_r").hide(); $("#form_p").hide(); $("#obt14").hide();
            $("#quit_case").click(function(){ 
                window.location.href ="_logout.php";
              });

           $("#caseT").keypress(function(e) {
            if (e.keyCode == 13) {
                e.preventDefault(); 
                $("#caseBtn").click();
                } });   

            $("#caseBtn").click(function(){ 
                $("#caseT").blur();
                search_casered();
              });

            $("#obt7").change(function(){ 
                $("#obt7").blur();
                $("#obt8").focus();
                $('#PR_Btn').prop('disabled', false);
              });

              $("#obt8").keypress(function(){ 
                $("#obt8").blur();
                $("#obt9").focus();
              });

              $("#obt9").keypress(function(){ 
                $("#obt9").blur();
                $("#obt10").focus();
              });

              $("#obt10").keypress(function(){ 
                $("#obt10").blur();
                if($("#obt14").is(':visible')){$("#obt11").focus();}else{ $("#PR_Btn").focus();}
              });

              $("#obt11").keypress(function(){ 
                $("#obt11").blur();
                $("#PR_Btn").focus();
              });


            $("#PR_Btn").click(function(){ 
              $("#PR_Btn").prop('disabled', true).blur();
              $("#R_Btn").prop('disabled', false).focus();
              red_num();
                });

            $("#R_Btn").click(function(){ 
              $('#R_Btn').prop('disabled', true);
              update_red();
                });

              $("#EditR_Btn").click(function(){ 
                window.open("/access2praxticol/rcase/config_red.php","_blank");
              });

              $("#menu_case").click(function(){
                window.open("/access2praxticol/_portal.php","_self"); });

              $("#readde_case").click(function(){
                window.open("/access2praxticol/access2Detail_red.php","_self"); });

            //  var dep_check = $("#userDep").val();
              if ( $("#userDep").val() == 25 || $("#userDep").val() == 6 ){ $("#EditR_Btn").prop('disabled', false); }
              else { $("#EditR_Btn").prop('disabled', true); }
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
                    <input type="hidden" id="userNa" name="userNa" value="<?php echo $name_ses;?>">
                    <input type="hidden" id="userDep" name="userDep" value="<?php echo $Dep_ses;?>">
                    <input class="btn-danger" type="button" name="quit_case" id="quit_case" value="ออกจากระบบ">
                    <input class="btn-light" type="button" name="menu_case" id="menu_case" value="กลับหน้าหลัก">
                    <input class="btn-light" type="button" name="redde_case" id="readde_case" value="ลงสารบบแดง">
                  </td></tr></tbody></table>
        </div></div>


        <div class="row no-gutters">
        <div class="col-12">
                <table style="height: 100%; width: 100%"><tbody><tr>
                    <td class="text-light bg-dark text-center">
                    <p style="font-size:30px;">ออกแดงเลขคดีดำ
                    <input type="text" name="caseT" id="caseT"  value=""> 
                    <input type="button" name="caseBtn" id="caseBtn" value="ค้นหา"></p> 
                    </td></tr></tbody></table>
        </div></div>

        <div class="row">

        <div class="col-12 mt-2">
                <form name = "form1" id="form1" method="post">
                <table class="table table-bordered table-sm text-left">
                <tbody>
                    <tr><td style="width: 12%">หมายเลขคดีดำ : </td><td style="width: 18%"><a style="font-size:20px;" id="obt1" name="obt1"> </a></td>
                    <td style="width: 10%">ประเภทคดี : </td><td style="width: 20%"><a style="font-size:20px;" id="obt2" name="obt2"> </a></td>
                    <td style="width: 8%">ข้อหา : </td><td style="width: 32%"><a style="font-size:20px;" id="obt3" name="obt3"> </a></td></tr>
                    <tr><td style="width: 12%">วันนัดหน้า : </td><td style="width: 18%"><a style="font-size:20px;" id="obt4" name="obt4"> </a></td>
                    <td style="width: 10%">โจทก์/ผู้ร้อง </td><td style="width: 20%"><a style="font-size:20px;" id="obt5" name="obt5"> </a></td>
                    <td style="width: 8%">จำเลย /<br>ผู้ตาย </td><td style="width: 32%"><a style="font-size:20px;" id="obt6" name="obt6"> </a></td></tr>
                </tbody>
                </table></form></div>
     
        <div class="col-12 text-light bg-dark">
        <p style="font-size:20px;">กรอกรายละเอียดข้อมูลคดีเสร็จ</p>
        </div>
        <div class="col-12 mt-2">
                <form name = "form2" id="form2" method="post">
                                <p style="font-size:20px;">
                                <label for="obt7">ผู้พิพากษาตัดสิน : </label> 
                                <select style="font-size:20px; width: 35%" id="obt7" name="obt7">
                                <option selected>  -- เลือกข้อมูล -- </option>
                                 </select>
                                 <label for="obt8">องค์คณะ : </label> 
                                <select style="font-size:20px; width: 35%" id="obt8" name="obt8">
                                <option selected>  -- เลือกข้อมูล -- </option>
                                </select>
                            </p> <p style="font-size:20px;">
                                <label for="obt9">คดีเสร็จเพราะ : </label>
                                <select style="font-size:20px; width: 35%" id="obt9" name="obt9">
                                    <option selected>  -- เลือกข้อมูล -- </option>
                                </select>
                                <label for="obt10">ฝ่ายชนะ : </label>
                                <select style="font-size:20px; width: 35%" id="obt10" name="obt10">
                                <option selected>  -- เลือกข้อมูล -- </option>
                                </select> </p> 
                                <p style="font-size:20px;" id="obt14" name="obt14">
                                <label for="obt11">อัตราโทษ : </label>
                                <select style="font-size:20px; width: 35%" id="obt11" name="obt11">
                                    <option value="1" selected>1 : ไม่เกิน 10 ปี</option>
                                    <option value="2">2 : เกิน 10 ปี</option>
                                </select> 
                                (อัตราโทษตอนเริ่มต้นฟ้อง) </p>  
                               </form></div>

        <div class="col-12 text-light bg-dark">
                <form class="mt-4" name = "form3" id="form3" method="post">
                                <p style="font-size:20px;">
                                <input class="btn-warning" type="button" name="PR_Btn" id="PR_Btn" value="ออกเลขแดง"  style="font-size:20px;" >
                                <label for="obt12">หมายเลขคดีแดง</label> 
                                <input class="text-danger" type="text" style="font-size:20px; width:7%" id="obt12" name="obt12"  value="">  
                                <input class="text-danger" type="text" style="font-size:20px; width:5%" id="obt13" name="obt13"  value="">  
                                <label for="obt14"> วันตัดสิน</label> 
                                <input class="text-danger" type="text" style="font-size:20px;" id="obt15" name="obt15"  value=""> 
                                <input class="btn-danger" type="button" name="R_Btn" id="R_Btn" value="บันทึกข้อมูลคดีเสร็จ" style="font-size:20px;" >
                                <input class="btn-light" type="button" name="EditR_Btn" id="EditR_Btn" value="ตั้งค่าเลขแดง" style="font-size:20px;" >
                                </p></form>
        </div>

         <div class="col-12 mt-2">
                <form name = "form_r" id="form_r" method="post">
                                <p style="font-size:20px;">ผลการตัดสินจำเลย</p> 
                                <div class="col-12 mt-3">
                                <table class="table table-bordered table-sm" name="objTable_r" id="objTable_r"></table>
                                </div>
                               </form>
                <form name = "form_p" id="form_p" method="post">
                                <p style="font-size:20px;">วันนัดพิจารณาของคดี</p> 
                                <div class="col-12 mt-3 data_butt">
                                <table class="table table-bordered table-sm" name="objTable_p" id="objTable_p"></table>
                                </div>
                               </form>
            </div>
         
</div>
</body>
</html>