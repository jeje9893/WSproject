<?php
$host = 'localhost'; // 데이터베이스 호스트
$db   = 'LoginData'; // 데이터베이스 이름
$user = 'root'; // 데이터베이스 사용자
$pass = '1128'; // 데이터베이스 비밀번호
$charset = 'utf8mb4'; // 문자셋 설정

$dsn = "mysql:host=$host;dbname=$db;charset=$charset"; // DSN(Data Source Name) 설정

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // 오류 모드를 예외로 설정
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // 기본 페치 모드를 연관 배열로 설정
    PDO::ATTR_EMULATE_PREPARES   => false, // 준비된 문 에뮬레이션 비활성화
];

// 데이터베이스 존재 여부 확인 및 생성
$dsnWithoutDB = "mysql:host=$host;charset=$charset";
try {
    $pdo = new PDO($dsnWithoutDB, $user, $pass, $options);
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `$db` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;");
    $pdo->exec("USE `$db`;");
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

try {
    $pdo = new PDO($dsn, $user, $pass, $options); // PDO 인스턴스 생성
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode()); // 예외 발생 시 메시지와 코드 전달
}

// 테이블 생성
try {
    // 'users' 테이블 생성
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS `users` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `username` VARCHAR(50) NOT NULL UNIQUE,
            `password` VARCHAR(255) NOT NULL,
            `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB;
    ");
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
