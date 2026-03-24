<?php
session_start();
include "db.php";

// 1. 로그인 여부 및 데이터 수신 확인
$ing_id = $_SESSION['userid'] ?? '';
$idx = isset($_POST['idx']) ? (int)$_POST['idx'] : 0;
$cp = isset($_POST['cp']) ? (int)$_POST['cp'] : 1;
$title = isset($_POST['title']) ? mysqli_real_escape_string($db, $_POST['title']) : '';
$content = isset($_POST['content']) ? mysqli_real_escape_string($db, $_POST['content']) : '';

if (!$ing_id || !$idx) {
    echo "<script>alert('잘못된 접근입니다.'); location.replace('board_list.php');</script>";
    exit;
}

// 2. 작성자 본인 확인 (매우 중요!)
$sql_check = "SELECT userid FROM sj_board WHERE idx = $idx";
$res_check = mysqli_query($db, $sql_check);
$row = mysqli_fetch_array($res_check);

if (!$row || $row['userid'] !== $ing_id) {
    echo "<script>alert('본인의 글만 수정할 수 있습니다.'); history.back();</script>";
    exit;
}

// 3. 레코드 수정 실행
$sql_update = "UPDATE sj_board SET 
                title = '$title', 
                content = '$content' 
               WHERE idx = $idx";

$res_update = mysqli_query($db, $sql_update);

if ($res_update) {
    echo "<script>
            alert('글이 성공적으로 수정되었습니다.');
            location.replace('board_list.php?cp=$cp');
          </script>";
} else {
    echo "<script>
            alert('수정 중 오류가 발생했습니다.');
            history.back();
          </script>";
}

mysqli_close($db);
?>
