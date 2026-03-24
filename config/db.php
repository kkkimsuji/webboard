<?php
// 1. DB 접속 정보 설정 (변수로 관리하면 나중에 바꾸기 편해요)
$host = 'localhost';
$user = 'syaic12';
$pw   = 'syaic1212';
$db_name = 'syaic12';

// 2. MySQL 접속
$db = mysqli_connect($host, $user, $pw, $db_name);

// 3. 접속 오류 확인 및 한글 깨짐 방지
if (mysqli_connect_errno()) {
    // 실제 서비스 환경에서는 에러 내용을 로그에만 남기고 사용자에게는 간단히 표시합니다.
    error_log("MySQL 접속 오류: " . mysqli_connect_error());
    die("데이터베이스 접속에 실패했습니다. 관리자에게 문의하세요.");
}

// 4. 한글 깨짐 방지를 위한 인코딩 설정 (중요!)
mysqli_set_charset($db, "utf8mb4");

// 참고: HTML 태그(<link>)는 설정 파일인 db.php보다는 
// 각 페이지(board_list.php 등)의 <head> 안에 넣는 것이 웹 표준에 맞습니다.
?>
