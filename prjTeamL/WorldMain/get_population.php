<?php
header('Content-Type: application/json');

// 데이터베이스 연결 설정
$conn = mysqli_connect('localhost', 'root', 'admin#2024', 'WorldPopulationDB');
if (!$conn) {
    die(json_encode(['error' => '데이터베이스 연결 실패']));
}

$population_data = array();

// 테이블 이름 패턴 설정
$prefix = 'country_';

// 데이터베이스의 모든 테이블 가져오기
$tables_result = mysqli_query($conn, "SHOW TABLES LIKE '{$prefix}%'");
if ($tables_result) {
    while ($row = mysqli_fetch_array($tables_result)) {
        $table = $row[0];
        // 국가 이름 추출
        $country = ucwords(str_replace('_', ' ', substr($table, strlen($prefix)))); //country_ 제거 후 첫 글자 대문자로 변환

        // 각 테이블에서 최신 연도 인구수 가져오기
        $sql = "SELECT value AS population FROM `$table` ORDER BY year DESC LIMIT 1";
        $result = mysqli_query($conn, $sql);
        if ($result && $row_data = mysqli_fetch_assoc($result)) {
            $population_data[] = [
                'name' => $country,
                'population' => intval($row_data['population']),
            ];
        }
    }
    echo json_encode($population_data);
} else {
    echo json_encode(['error' => '테이블 조회 실패']);
}

mysqli_close($conn);
?>