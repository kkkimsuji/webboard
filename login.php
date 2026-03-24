<?php
session_start();
include "db.php";

// 1. 입력 데이터 가져오기 (POST 권장 및 보안 처리)
$userid = isset($_POST['userid']) ? mysqli_real_escape_string($db, $_POST['userid']) : '';
$passwd = isset($_POST['passwd']) ? $_POST['passwd'] : '';

if (!$userid || !$passwd) {
    echo "<script>alert('아이디와 비밀번호를 모두 입력해주세요.'); history.back();</script>";
    exit;
}

// 2. DB에서 사용자 확인
// MySQL의 password() 함수는 버전에 따라 지원되지 않을 수 있으니 확인이 필요합니다.
$sql = "SELECT * FROM sj_user WHERE userid = '$userid' AND passwd = password('$passwd')";
$res = mysqli_query($db, $sql);

if (mysqli_num_rows($res) > 0) {
    // 3. 회원 인증 성공
    $row = mysqli_fetch_array($res);
    
    // 세션 변수 설정 (리다이렉트 전에 완료해야 함)
    $_SESSION['userid'] = $row['userid'];
    $_SESSION['name']   = $row['name'];
    $_SESSION['email']  = $row['email'];
    // 비밀번호를 세션에 저장하는 것은 보안상 권장하지 않지만, 기존 로직 유지를 위해 남겨둡니다.
    $_SESSION['passwd'] = $row['passwd']; 

    echo "<script>location.replace('board_list.php');</script>";
} else {
    // 4. 로그인 실패
    echo "<script>
            alert('일치하는 회원을 찾을 수 없습니다.\\n다시 로그인해주세요.');
            history.back();
          </script>";
}

mysqli_close($db);
?>
