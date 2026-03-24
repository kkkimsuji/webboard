<?php
session_start();
include "db.php";

// 1. 필수 데이터 및 로그인 확인
$idx = isset($_POST['idx']) ? (int)$_POST['idx'] : 0;
$ing_id = $_SESSION['userid'] ?? '';

if (!$idx || !$ing_id) {
    echo "<script>alert('잘못된 접근입니다.'); location.replace('board_list.php');</script>";
    exit;
}

// 2. 작성자 본인 확인 (중요!)
// DB에서 해당 글의 작성자를 가져와 현재 로그인한 아이디와 비교합니다.
$sql_check = "SELECT userid FROM sj_board WHERE idx = $idx";
$res_check = mysqli_query($db, $sql_check);
$row = mysqli_fetch_array($res_check);

if (!$row || $row['userid'] !== $ing_id) {
    echo "<script>alert('본인의 글만 삭제할 수 있습니다.'); history.back();</script>";
    exit;
}

// 3. 레코드 삭제 실행
$sql_del = "DELETE FROM sj_board WHERE idx = $idx";
$res_del = mysqli_query($db, $sql_del);

if ($res_del) {
    echo "<script>
            alert('글이 성공적으로 삭제되었습니다.');
            location.replace('board_list.php');
          </script>";
} else {
    echo "<script>
            alert('삭제 처리 중 오류가 발생했습니다.');
            history.back();
          </script>";
}

mysqli_close($db);
?>
