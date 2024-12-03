<?php

// ...existing code...

// 데이터베이스 연결 정보 변수로 분리
$host = 'localhost';
$user = 'root';
$password = '1128';
$dbname = 'WorldPopulationDB';

if (isset($_GET['action'])) {
    $action = $_GET['action'];
    if ($action == 'createDB') {
        // 데이터베이스 생성
        $conn = new mysqli($host, $user, $password); // 변경된 부분
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "CREATE DATABASE $dbname";
        if ($conn->query($sql) === TRUE) {
            echo "데이터베이스가 성공적으로 생성되었습니다.";

            // 테이블 생성
            $conn->select_db($dbname);
            $tableSql = "CREATE TABLE population_table (
                id INT AUTO_INCREMENT PRIMARY KEY,
                country VARCHAR(100),
                year INT,
                population BIGINT
            )";
            if ($conn->query($tableSql) === TRUE) {
                echo " 테이블이 성공적으로 생성되었습니다.";
            } else {
                echo " 테이블 생성 오류: " . $conn->error;
            }
        } else {
            echo "데이터베이스 생성 오류: " . $conn->error;
        }
        $conn->close();
    } elseif ($action == 'loadXML') {
        // XML 데이터를 데이터베이스에 저장
        $conn = new mysqli($host, $user, $password, $dbname); // 변경된 부분
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $xml = simplexml_load_file('UNdata_Export_20241128_044942230.xml');
        $firstCountry = (string)$xml->record[0]->children()->Country;
        echo "첫 번째 country 값: " . $firstCountry . "<br>";

        // 준비된 문(statement) 생성
        $stmt = $conn->prepare("INSERT INTO population_table (country, year, population) VALUES (?, ?, ?)");
        $stmt->bind_param("sis", $country, $year, $population);

        $xml = simplexml_load_file('UNdata_Export_20241128_044942230.xml');
        foreach ($xml->record as $record) {
            // 데이터 삽입 준비
            foreach ($record->children() as $child) {
                if ((string)$child['name'] === 'Country or Area') {
                    $country = (string)$child;
                } elseif ((string)$child['name'] === 'Value') {
                    $population = (int)$child;
                } elseif ((string)$child['name'] === 'Year') { // 추가된 부분
                    $year = (int)$child;
                }
                // 필요한 경우 다른 필드도 처리
            }
            // $year = (int)$record->year; // 제거된 부분
            $stmt->execute();
        }

        $stmt->close();
        echo "XML 데이터가 성공적으로 저장되었습니다.";
        $conn->close();
    } elseif ($action == 'showData') { // 수정된 부분
        // XML 파일 읽기
        $xml = simplexml_load_file('UNdata_Export_20241128_044942230.xml');

        $targetNames = ['Country or Area', 'Year', 'Value']; //이 부분 수정 중
        foreach ($xml->record as $record) {
            if ((string)$field['name'] === $targetName) {
                echo "Field with name '{$targetName}' has value: " . (string)$field . PHP_EOL;
            }
        }
    }
}

// ...existing code...
