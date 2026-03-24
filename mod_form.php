<?php
session_start();
include "db.php";

// 1. 파라미터 체크 및 로그인 확인
$idx = isset($_GET['idx']) ? (int)$_GET['idx'] : 0;
$cp = isset($_GET['cp']) ? (int)$_GET['cp'] : 1;
$ing_id = $_SESSION['userid'] ?? '';

if (!$idx || !$ing_id) {
    echo "<script>alert('잘못된 접근입니다.'); location.replace('board_list.php');</script>";
    exit;
}

// 2. 해당 글 조회 및 권한 확인
$sql = "SELECT * FROM sj_board WHERE idx = $idx";
$res = mysqli_query($db, $sql);
$row = mysqli_fetch_array($res);

// 글이 없거나, 작성자와 로그인한 사용자가 다를 경우 차단
if (!$row || $row['userid'] !== $ing_id) {
    echo "<script>alert('본인의 글만 수정할 수 있습니다.'); history.back();</script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>글 수정 - <?= htmlspecialchars($row['title']) ?></title>
    <link rel="stylesheet" href="table.css">
</head>
<body>
    <div class="container" style="text-align: center;">
        <header>
            <h1>글 수정</h1>
        </header>

        <form name="mod" action="mod_proc.php" method="post">
            <input type="hidden" name="idx" value="<?= $idx ?>">
            <input type="hidden" name="cp" value="<?= $cp ?>">
        
            <table class="t" style="margin: 0 auto; width: 80%;">
                <tr>
                    <th style="width: 20%;">아이디</th>
                    <td>
                        <input type="text" name="userid" class="id" 
                               value="<?= htmlspecialchars($row['userid']) ?>" readonly style="background-color: #f0f0f0;">
                    </td>  
                </tr>
                <tr>
                    <th>제목</th>
                    <td>
                        <input type="text" name="title" style="width: 98%;" 
                               value="<?= htmlspecialchars($row['title']) ?>" required>
                    </td>
                </tr>
                <tr>
                    <th>내용</th>
                    <td>
                        <textarea name="content" rows="15" style="width: 98%;" required><?= htmlspecialchars($row['content']) ?></textarea>
                    </td> 
                </tr>
            </table>

            <div class="btn-group" style="margin-top: 20px;">
                <button type="submit" class="b2">수정 완료</button>
                <button type="button" class="b2" onclick="history.back();">취소</button>
            </div>
        </form>
    </div>
</body>
</html>
<?php mysqli_close($db); ?>
