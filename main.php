<?php
session_start();

// 1. 로그인 여부 확인 (세션이 없으면 로그인 페이지로 튕겨내기)
if (!isset($_SESSION['userid'])) {
    echo "<script>alert('로그인이 필요한 페이지입니다.'); location.replace('login.html');</script>";
    exit;
}

// 사용자 정보 변수에 담기 (출력할 때 편리함)
$userid = $_SESSION['userid'];
$name   = $_SESSION['name'] ?? '이름 없음';
$email  = $_SESSION['email'] ?? '이메일 정보 없음';
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>마이페이지 - <?= htmlspecialchars($name) ?>님</title>
    <link rel="stylesheet" href="table.css">
</head>
<body>
    <div class="container" style="text-align: center; margin-top: 50px;">
        <header>
            <h1>마이페이지</h1>
        </header>

        <section class="user-info" style="margin-bottom: 30px; line-height: 2;">
            <p><strong>아이디 :</strong> <?= htmlspecialchars($userid) ?></p>
            <p><strong>이름 :</strong> <?= htmlspecialchars($name) ?></p>
            <p><strong>이메일 주소 :</strong> <?= htmlspecialchars($email) ?></p>
        </section>

        <nav class="btn-group">
            <a href="board_list.php"><button type="button" class="b2">게시판</button></a>
            <a href="mod_pw.php"><button type="button" class="b2">PW변경</button></a>
            <a href="del_mem.php" onclick="return confirm('정말로 탈퇴하시겠습니까?');">
                <button type="button" class="b2" style="background-color: #ff4d4d; color: white;">탈퇴하기</button>
            </a>
        </nav>
    </div>
</body>
</html>
