<?php
            if(isset($_GET["caseB"])){
            $CaseT = array();
            $json = file_get_contents('court.json');
            $dataj = json_decode($json, true);
            $db = $dataj['dbA'];
            $driverdb = $dataj['driverA'];
            $conn = new PDO($driverdb."Dbq=$db", null, null);
            $CaseB = $_GET["caseB"];
            // $CaseB = "อ1/63";
            $TableN = 'แผนกรับฟ้อง';
            $FiledN = 'หมายเลขดำที่/พศ';
            $query = ConvertTIS620("SELECT * FROM [$TableN] WHERE [$FiledN] = '$CaseB'");
            $result = $conn->prepare($query);
            $result->execute();
            $row = $result->fetchAll(PDO::FETCH_ASSOC);
            $res = ArrayEncodeTH2D($row);
            //  print_r ($res);
             // echo "<br> Number of Row(s) : " . count($row) . "<br>";
             // $text = $res[0]['หมายเลขดำที่/พศ']." ".
             //         $res[0]['ข้อหา']." ".
             //         $res[0]['โจทก์']." ".
             //         $res[0]['จำเลย']." ".
             //         $res[0]['วันเดือนปีรับฟ้อง']." ".
             //         $res[0]['ความa']." ".
             //         $res[0]['ความ']." ".
             //         $res[0]['หมายเลขแดงที่'];
             // echo json_encode($text);
            if(!empty($res)){
                echo json_encode($res);
            }else{
                $res = null;
                echo json_encode($res);
            }
            
        } else {
            $res = null;
            echo json_encode($res);
        }

        function ConvertUTF8($value){
            return iconv('TIS-620', 'UTF-8',$value);
        }
        function ConvertTIS620($value){
            return iconv('UTF-8','TIS-620',$value);
        }
        function ArrayEncodeTH($ar){ 
            $rows = array();
            foreach ($ar as $key => $value) {
                    $key = ConvertUTF8($key);
                    $value = ConvertUTF8($value); 
                    $rows[$key] = $value;    
            }
            return $rows;
        }
        function ArrayEncodeTH2D($arr){  
            $rows = array();
            if($arr)
                foreach($arr as $row ) {
                    $rows[] = ArrayEncodeTH($row);
                }
            return $rows;
        }    
?>