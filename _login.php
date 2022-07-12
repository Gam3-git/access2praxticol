<?php 
    session_start();
    if(isset($_POST["usern"])&& isset($_POST["pass"])){
        $json = file_get_contents('court.json');
        $dataj = json_decode($json, true);
        $db = $dataj['dbA'];
        $driverdb = $dataj['driverA'];
        $conn = new PDO($driverdb."Dbq=$db", null, null);
        $UserN = $_POST["usern"];
        $Pass = $_POST["pass"];
        $TableN = 'User';
        $FiledN1 = 'User_user';
        $FiledN2 = 'User_password';
        $query = "SELECT * FROM $TableN WHERE $FiledN1 = '$UserN' AND $FiledN2 = '$Pass'";
        $result = $conn->prepare($query);
        $result->execute();
        $row = $result->fetchAll(PDO::FETCH_ASSOC);
        if(!empty(count($row))){
            $res = ArrayEncodeTH2D($row);
            $_SESSION["userN"] = $res['User_IDentify'];
            $_SESSION["userPo"] = $res['User_Tum'];
            $_SESSION["userPa"] = $res['User_user'];
            $_SESSION["userDep"] = $res['Dep'];
            session_write_close();
            header('Location: ./access2dms.php');
        } else {
            echo "<script type=\"text/javascript\">alert(\"รหัสผู้ใช้หรือรหัสผ่านไม่ถูกต้อง\"); window.history.back();</script>";
        }
            
    } else {
        echo "<script type=\"text/javascript\">alert(\"รหัสผู้ใช้หรือรหัสผ่านไม่ถูกต้อง\"); window.history.back();</script>";
        
    }
    function ConvertUTF8($value){
        return iconv('TIS-620', 'UTF-8',$value);
    }
    function ConvertTIS620($value){
        return iconv('UTF-8','TIS-620',$value);
    }
    function ArrayEncodeTH($ar){ // for 1D
        $rows = array();
        foreach ($ar as $key => $value) {
                $key = ConvertUTF8($key);
                $value = ConvertUTF8($value); 
                $rows[$key] = $value;    
        }
        return $rows;
    }
    function ArrayEncodeTH2D($arr){  // for 2D
        $rows = array();
        if($arr)
            foreach($arr as $row ) {
                $rows = ArrayEncodeTH($row);
            }
        return $rows;
    }    
?>