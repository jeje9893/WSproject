<?php
session_start(); // 세션 시작
session_unset(); // 모든 세션 변수 해제
session_destroy(); // 세션 종료
header("Location: /WorldMain/index.html"); // 메인 페이지로 리디렉션
exit();
