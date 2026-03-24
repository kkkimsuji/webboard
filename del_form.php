<?php
session_start();
// 로그인 여부 확인이 필요하다면 여기에 추가할 수 있습니다.
$idx = isset($_REQUEST['idx']) ? (int)$_REQUEST['idx'] : 0;

if ($idx === 0) {
    echo "<script>alert('잘못된 접근입니다.'); history.back();</script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>게시글 삭제 확인</title>
    <link rel="stylesheet" href="css/table.css">
</head>
<body>
    <div class="container" style="text-align: center; margin-top: 50px;">
        <header>
            <h1>삭제 확인</h1>
        </header>

        <form name="del" action="del_proc.php" method="post">
            <input type="hidden" name="idx" value="<?= $idx ?>">
            
            <div class="message-box">
                <h3>정말로 이 게시글을 삭제하시겠습니까?</h3>
                <p style="color: red; font-size: 0.9em;">삭제된 데이터는 복구할 수 없습니다.</p>
            </div>

            <div class="btn-group">
                <button type="submit" class="b2">확인 및 삭제</button>
                <button type="button" class="b2" onclick="history.back();">취소</button>
            </div>
        </form>
    </div>
</body>
</html>
