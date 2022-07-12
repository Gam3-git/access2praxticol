
function court_text(){
    $.getJSON('court.json', function(msg) { 
        $("#courtN").html(msg.courtN);
    });
}

function search_case(){
    $('#form2')[0].reset();
    $('#form3')[0].reset();
    $.ajax({
        type: "POST",
        url: "caseb.php?caseB="+$("#caseB").val(),
        beforeSend: function() {
            Swal.fire({
                title: 'กำลังค้นหาข้อมูล...',
                icon: 'warning',
                allowEscapeKey: false,
                // allowOutsideClick: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading()
                  }
            });
        },
        success: function(result){
        var jsonData = JSON.parse(result);
        if(jsonData == null){
            Swal.fire({ title: "ไม่พบข้อมูล", icon: "error", showConfirmButton: false, timer: 1000,});
            $("#uploadBtn").attr("disabled", true);
            $("#showBtn").attr("disabled", true);
        } else {
            // console.log(jsonData);
            Swal.fire({ icon: "success", showConfirmButton: false, timer: 1000,});
            if(jsonData[0]['ผ/ฝ']=="ต."){
                $("#obt1").val(jsonData[0]['หมายเลขดำที่/พศ']);
                $("#obt2").val(jsonData[0]['หมายเหตุb']);
                $("#obt3").val(jsonData[0]['โจทก์']);
                $("#obt4").val(jsonData[0]['จำเลย']);
                $("#obt5").val(null);
                $("#obt6").val(jsonData[0]['ผู้ร้อง']);
                $("#obt7").val("หมายข้ามเขต");
                $("#obt8").val("-");
                $("#obt9").val("คำร้อง");
            } else {
                $("#obt1").val(jsonData[0]['หมายเลขดำที่/พศ']);
                $("#obt2").val(jsonData[0]['ข้อหา']);
                $("#obt3").val(jsonData[0]['โจทก์']);
                $("#obt4").val(jsonData[0]['จำเลย']);
                datecase =  jsonData[0]['วันเดือนปีรับฟ้อง'].split("-");
                datecase[2] = datecase[2].substring(2, 0);
                datecase[0] = parseInt(datecase[0]) + 543;
                $("#obt5").val(datecase[2]+"/"+datecase[1]+"/"+(datecase[0]));
                $("#obt6").val(jsonData[0]['ความa']);
                $("#obt7").val(jsonData[0]['ความ']);
    
                if(jsonData[0]['หมายเลขแดงที่'] != 0){
                    var redcase = jsonData[0]['ผ/ฝ']+Math.floor(jsonData[0]['หมายเลขแดงที่'])+'/'+Math.floor(jsonData[0]['พศa']);
                }else {
                    var redcase = "-";
                }
                $("#obt8").val(redcase);
        
                if(jsonData[0]['คำฟ้อง/คำร้อง'] == 1){ $("#obt9").val("คำฟ้อง");
                } else {$("#obt9").val("คำร้อง");}
            }
            
        $("#uploadBtn").removeAttr("disabled");
        $("#showBtn").removeAttr("disabled");
        }
    }, 
    error:function(msg){
        console.log( "error:", msg );
    }
});

}

function upload_case(){
    $.getJSON('court.json', function(msg) { 
        var ip = msg.ip; 
        let strUrl = "http://"+ip+":8080/pxapi/api/v1/dmsDocuments/createDocConnec?api_key=praXis";
        //Set value
        let documentName =  $("#obt1").val();
        let documentVarchar01 = $("#obt3").val();
        let documentVarchar02 = $("#obt4").val();
        let documentVarchar03 = $("#obt9").val();
        let documentVarchar04 = $("#obt6").val();
        let documentVarchar06 = $("#obt8").val();
        let documentVarchar07 = $("#obt7").val();
        let documentText02 = $("#obt2").val();
        let documentDate01 = $("#obt5").val();
        let dms_user_id = $("#userId").val(); //รหัสเชื่อมโยง coj
        //send data
        let body_ = '{"documentName":"' + documentName + '","documentVarchar03": "' + documentVarchar03+ '","documentVarchar04":"' + documentVarchar04+ '","documentVarchar01":"' + documentVarchar01+ '","documentVarchar02":"' + documentVarchar02+ '","version":"1","documentText02":"' + documentText02+ '","documentDate01":"' + documentDate01+ '","documentVarchar06":"' + documentVarchar06+ '","documentVarchar07":"' +documentVarchar07+ '","createdBy":"1"}';
        console.log("call-url:" + strUrl);
        console.log("body: "+ body_);
        $.ajax({
        type: "POST",
        dataType: "json",
        contentType: "application/json",
        url: strUrl,
        data: body_,
        success: function(msg){
            let url_ = "https://"+ip+"/praxticol85-coj/?mode=add&docid=" + msg + "&cojId=" + dms_user_id + "&map=1";
            window.open(url_);
        }, 
        error:function(msg){
            console.log( "error:", msg );
        }
        });
    });       
}

function show_case(){
    $.getJSON('court.json', function(msg) { 
        var ip = msg.ip; 
        let dms_user_id = $("#userId").val(); //รหัสเชื่อมโยง coj
        let documentName =  $("#obt1").val();
        let url_ = "https://"+ip+"/praxticol85-coj/?casenumber=" + documentName + "&type=" + 1 + "&cojId="  + dms_user_id + "&map=1";
        
        window.open(url_);
    });    
}

