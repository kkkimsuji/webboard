<?php
session_start();

// 1. 모든 세션 변수 초기화
$_SESSION = array();

// 2. 세션 쿠키 삭제 (브라우저에 남은 세션 ID 쿠키를 무효화)
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// 3. 세션 파괴
$res = session_destroy();

if ($res) {
    echo "<script>
            alert('로그아웃 되었습니다.');
            location.replace('login.html');
          </script>";
} else {
    // 혹시 모를 오류 발생 시
    echo "<script>
            location.replace('login.html');
          </script>";
}
?>
