<?php
session_start();
include "db.php";

// 1. 로그인 여부 확인 (세션 보안)
$userid = $_SESSION['userid'] ?? '';

if (!$userid) {
    echo "<script>alert('로그인이 필요한 서비스입니다.'); location.replace('login.html');</script>";
    exit;
}

// 2. 입력 데이터 가져오기 및 보안 처리
// $_REQUEST 대신 $_POST를 사용하여 데이터 출처를 명확히 합니다.
$title   = isset($_POST['title'])   ? mysqli_real_escape_string($db, $_POST['title'])   : '';
$content = isset($_POST['content']) ? mysqli_real_escape_string($db, $_POST['content']) : '';

if (!$title || !$content) {
    echo "<script>alert('제목과 내용을 모두 입력해주세요.'); history.back();</script>";
    exit;
}

// 3. DB에 게시글 저장
// 컬럼명을 명시적으로 적어주면 테이블 구조가 바뀌어도 에러를 방지할 수 있습니다.
// (idx, userid, title, content, hit, reg_date 순서로 가정)
$sql = "INSERT INTO sj_board (userid, title, content, hit, reg_date) 
        VALUES ('$userid', '$title', '$content', 0, NOW())";

$res = mysqli_query($db, $sql);

if ($res) {
    echo "<script>
            alert('글이 성공적으로 등록되었습니다👍');
            location.replace('board_list.php');
          </script>";
} else {
    // 쿼리 실패 시 에러 로그를 남기거나 사용자에게 알림
    echo "<script>
            alert('글 등록 중 오류가 발생했습니다. 관리자에게 문의하세요.');
            history.back();
          </script>";
}

mysqli_close($db);
?>
