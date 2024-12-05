<?php

// ...existing code...

// 데이터베이스 연결 정보 변수로 분리
$host = 'localhost';
$user = 'root';
$password = '1128';
$dbname = 'WorldPopulation';

// mysqli 예외 모드 비활성화
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
try {
    // 연결 설정 (데이터베이스를 지정하지 않음)
    $conn = new mysqli($host, $user, $password);
    $conn->set_charset("utf8mb4");
    
    // 데이터베이스 생성
    $createDbSQL = "CREATE DATABASE IF NOT EXISTS `$dbname` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
    $conn->query($createDbSQL);
    
    // 데이터베이스 선택
    $conn->select_db($dbname);
} catch (mysqli_sql_exception $e) {
    die("데이터베이스 연결 또는 생성 오류: " . $e->getMessage());
}

// action 파라미터에 따른 처리
if(isset($_GET['action'])) {
    if($_GET['action'] == 'makeDB') {
        // XML 파일 경로
        $xmlFile = 'UNdata_Export_20241128_044942230.xml';
        
        if (!file_exists($xmlFile)) {
            die("XML 파일이 존재하지 않습니다.");
        }
        
        // XML 파일 로드
        $xml = simplexml_load_file($xmlFile) or die("Error: Cannot create object");
        
        foreach($xml->item as $item) {
            // 필드 이름에 따라 데이터 추출 (필요에 따라 인덱스 조정)
            $country = $conn->real_escape_string((string)$item->field[0]);
            $year = (int)$item->field[1];
            $value = (float)$item->field[2];
            
            // 국가별 테이블 이름 생성 (공백을 언더스코어로 대체)
            $tableName = preg_replace('/\s+/', '_', $country);
            
            // 테이블 생성
            $createTableSQL = "CREATE TABLE IF NOT EXISTS `$tableName` (
                `year` INT NOT NULL,
                `value` FLOAT NOT NULL,
                PRIMARY KEY (`year`)
            )";
            
            if ($conn->query($createTableSQL) === TRUE) {
                // 데이터 삽입
                $insertSQL = "INSERT INTO `$tableName` (`year`, `value`) VALUES ($year, $value)
                              ON DUPLICATE KEY UPDATE `value` = $value";
                if(!$conn->query($insertSQL)){
                    echo "데이터 삽입 오류 ($tableName): " . $conn->error . "\n";
                }
            } else {
                echo "테이블 생성 오류 ($tableName): " . $conn->error . "\n";
            }
        }
        
        echo "데이터베이스 및 국가별 테이블이 성공적으로 생성 및 업데이트되었습니다.";
        exit();
    }
    
    if($_GET['action'] == 'showData') {
        // XML 파일 경로
        $xmlFile = 'UNdata_Export_20241128_044942230.xml';
        
        if (!file_exists($xmlFile)) {
            die("XML 파일이 존재하지 않습니다.");
        }
        
        // SimpleXML을 이용해 XML 파일 로드
        $xml = simplexml_load_file($xmlFile) or die("Error: Cannot create object");
        
        // HTML 테이블 생성
        $table = '<table border="1"><tr><th>Country of Area</th><th>Year</th><th>Value</th></tr>';
        
        foreach($xml->item as $item) {
            $country = '';
            $year = '';
            $value = '';
            
            foreach($item->field as $field) {
                $name = (string)$field['name'];
                $content = (string)$field;
                
                if($name === 'Country of Area') {
                    // 콘솔 출력 디버깅
                    echo "<script>console.log('Country: " . addslashes($content) . "');</script>";
                    $country = htmlspecialchars($content);
                }
                if($name === 'Year') {
                    $year = htmlspecialchars($content);
                }
                if($name === 'Value') {
                    $value = htmlspecialchars($content);
                }
            }
            
            $table .= "<tr><td>{$country}</td><td>{$year}</td><td>{$value}</td></tr>";
        }
        
        $table .= '</table>';
        
        echo $table;
        exit();
    }

    // ...existing 'fetchData' 액션...
}

?>

