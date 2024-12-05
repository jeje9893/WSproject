<?php
session_start(); // 세션 시작
require 'db_config.php'; // 데이터베이스 설정 파일 포함

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$username = $_POST['username']; // 사용자 이름 입력값 받기
	$password = $_POST['password']; // 비밀번호 입력값 받기

	// 사용자 조회
	$stmt = $pdo->prepare('SELECT * FROM users WHERE username = ?'); // SQL 준비
	$stmt->execute([$username]); // 사용자 이름으로 쿼리 실행
	$user = $stmt->fetch(); // 사용자 데이터 가져오기

	if ($user && password_verify($password, $user['password'])) { // 비밀번호 검증
		$_SESSION['username'] = $username; // 세션에 사용자 이름 저장
		header("Location: /WorldMain/index.html"); // 메인 페이지로 리디렉션
		exit();
	} else {
		echo "잘못된 사용자 이름 또는 비밀번호입니다."; // 오류 메시지 출력
	}
}
