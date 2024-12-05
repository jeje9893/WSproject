<?php
// 데이터베이스 연결 설정
$servername = "localhost";
$username = "root";
$password = "1128";
$dbname = "WorldPopulationDB";

// 데이터베이스 연결 생성
$conn = new mysqli($servername, $username, $password, $dbname);

// 연결 확인
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// XML 파일 로드
$xml = simplexml_load_file('Population.xml') or die("Error: Cannot create object");

// 각 record 요소 반복
foreach ($xml->data->record as $record) {
    $country = '';
    $year = '';
    $value = '';

    // 각 field 요소 반복
    foreach ($record->field as $field) {
        $name = (string)$field['name'];
        if ($name == 'Country or Area') {
            $country = (string)$field;
        } elseif ($name == 'Year') {
            $year = (string)$field;
        } elseif ($name == 'Value') {
            $value = (string)$field;
        }
    }

    // 국가명이 있는 경우에만 처리
    if ($country != '') {
        // 테이블명 생성 (공백과 특수문자 제거)
        $tableName = 'country_' . strtolower(preg_replace('/[^A-Za-z0-9]/', '_', $country));

        // 테이블이 존재하지 않으면 생성
        $createTableSQL = "CREATE TABLE IF NOT EXISTS `$tableName` (
            id INT AUTO_INCREMENT PRIMARY KEY,
            year INT(4) UNIQUE,
            value BIGINT(20)
        )";

        if ($conn->query($createTableSQL) === TRUE) {
            // 데이터 삽입 또는 업데이트 준비
            $stmt = $conn->prepare("INSERT INTO `$tableName` (year, value) VALUES (?, ?) ON DUPLICATE KEY UPDATE value = VALUES(value)");
            $stmt->bind_param("ii", $year, $value);

            // 데이터 삽입 또는 업데이트 실행
            if ($stmt->execute()) {
                if ($stmt->affected_rows == 1) {
                    echo "New record created successfully in table $tableName for year $year<br>";
                } elseif ($stmt->affected_rows == 2) {
                    echo "Existing record updated in table $tableName for year $year<br>";
                }
            } else {
                echo "Error inserting/updating data: " . $stmt->error . "<br>";
            }

            $stmt->close();
        } else {
            echo "Error creating table: " . $conn->error . "<br>";
        }
    }
}

// 연결 종료
$conn->close();
