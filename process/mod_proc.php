<?php
session_start();
include "db.php";

// 1. 로그인 여부 및 입력 데이터 확인
$userid = $_SESSION['userid'] ?? '';
$new_pw = isset($_POST['new_pw']) ? $_POST['new_pw'] : '';

if (!$userid || !$new_pw) {
    echo "<script>alert('잘못된 접근이거나 데이터가 누락되었습니다.'); history.back();</script>";
    exit;
}

// 2. 보안 처리 (SQL Injection 방지)
$safe_userid = mysqli_real_escape_string($db, $userid);
$safe_pw = mysqli_real_escape_string($db, $new_pw);

// 3. 비밀번호 업데이트 (기존 login.php에서 사용한 password() 함수와 일치시킴)
// 주의: 최근 MySQL 버전에서는 password() 대신 password_hash() 권장하지만, 기존 로직 유지를 위해 유지함
$sql = "UPDATE sj_user SET passwd = password('$safe_pw') 
        WHERE userid = '$safe_userid'";

$res = mysqli_query($db, $sql);

if ($res) {
    // 성공 시 세션의 비밀번호 정보도 업데이트 (필요한 경우)
    $_SESSION['passwd'] = $new_pw; 
    
    echo "<script>
            alert('비밀번호가 성공적으로 변경되었습니다.');
            location.replace('main.php'); 
          </script>";
} else {
    echo "<script>
            alert('변경 중 오류가 발생했습니다. 관리자에게 문의하세요.');
            history.back();
          </script>";
}

mysqli_close($db);
?>
