<?php
session_start();
include "db.php";

// 1. 로그인 체크 (세션이 없으면 실행 방지)
if (!isset($_SESSION["userid"])) {
    echo "<script>alert('로그인이 필요합니다.'); location.replace('login.html');</script>";
    exit;
}

$userid = $_SESSION["userid"];

// 2. SQL 쿼리 보안 처리 (문자열은 반드시 따옴표로 감싸야 합니다)
// 또한, 실제 운영시에는 회원 상태만 변경(soft delete)하기도 하지만, 여기선 직접 삭제를 유지합니다.
$sql = "DELETE FROM sj_user WHERE userid = '" . mysqli_real_escape_string($db, $userid) . "'";
$res = mysqli_query($db, $sql);

if ($res) {
    // 3. 모든 세션 정보 삭제 및 세션 파괴 (가장 확실한 로그아웃)
    $_SESSION = array(); // 모든 세션 변수 초기화
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    session_destroy(); // 세션 자체를 완전히 파괴
    ?>
    <script>
        alert("성공적으로 탈퇴되었습니다. 그동안 이용해주셔서 감사합니다.");
        location.replace('login.html');
    </script>
    <?php
} else {
    ?>
    <script>
        alert("탈퇴 처리 중 오류가 발생했습니다. 관리자에게 문의하세요.");
        history.back();
    </script>
    <?php
}

mysqli_close($db);
?>
