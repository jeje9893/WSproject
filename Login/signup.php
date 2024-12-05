<?php
session_start(); // 세션 시작
require 'db_config.php'; // 데이터베이스 설정 파일 포함

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username']; // 사용자 이름 입력값 받기
    $password = $_POST['password']; // 비밀번호 입력값 받기

    // 비밀번호 암호화
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // 사용자 삽입
    $stmt = $pdo->prepare('INSERT INTO users (username, password) VALUES (?, ?)'); // SQL 준비
    try {
        $stmt->execute([$username, $hashed_password]); // 사용자 정보 삽입
        $_SESSION['username'] = $username; // 세션에 사용자 이름 저장
        header("Location: /WorldMain/index.php"); // 메인 페이지로 리디렉션
        exit();
    } catch (PDOException $e) {
        // 기존 오류 메시지 대신 실제 오류 메시지 출력
        echo "회원가입 중 오류가 발생했습니다: " . $e->getMessage();
    }
}
