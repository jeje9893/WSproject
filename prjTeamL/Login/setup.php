<?php
$host = 'localhost'; // 데이터베이스 호스트
$db   = 'LoginData'; // 데이터베이스 이름
$user = 'root'; // 데이터베이스 사용자
$pass = 'admin#2024'; // 데이터베이스 비밀번호
$charset = 'utf8mb4'; // 문자셋 설정

$dsn = "mysql:host=$host;charset=$charset"; // DSN(Data Source Name) 설정

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // 오류 모드를 예외로 설정
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // 기본 페치 모드를 연관 배열로 설정
    PDO::ATTR_EMULATE_PREPARES   => false, // 준비된 문 에뮬레이션 비활성화
];

try {
    // 데이터베이스 연결
    $pdo = new PDO($dsn, $user, $pass, $options);

    // 데이터베이스 생성
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `$db` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;");

    // 생성된 데이터베이스 사용
    $pdo->exec("USE `$db`;");

    // 테이블 생성
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS `users` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `username` VARCHAR(50) NOT NULL UNIQUE,
            `password` VARCHAR(255) NOT NULL,
            `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB;
    ");

    // 'id' 필드가 AUTO_INCREMENT로 설정되어 있는지 확인 및 수정
    $pdo->exec("ALTER TABLE `users` MODIFY `id` INT AUTO_INCREMENT PRIMARY KEY;");

    echo "데이터베이스와 테이블이 성공적으로 생성되었습니다."; // 성공 메시지 출력
} catch (\PDOException $e) {
    echo "설치 중 오류 발생: " . $e->getMessage(); // 오류 메시지 출력
}
