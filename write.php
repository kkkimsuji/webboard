<?php
session_start();

// 1. 로그인 여부 확인 (비로그인 시 글쓰기 금지)
if (!isset($_SESSION['userid'])) {
    echo "<script>alert('로그인이 필요한 서비스입니다.'); location.replace('login.html');</script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>글 작성 - 게시판</title>
    <link rel="stylesheet" href="table.css">
</head>
<body>
    <div class="container" style="text-align: center; margin-top: 50px;">
        <header>
            <h1>글 작성</h1>
        </header>

        <form name="write" action="write_proc.php" method="post">
            <table class="t" style="margin: 0 auto; width: 80%;">
                <tr>
                    <th style="width: 20%;">작성자</th>
                    <td>
                        <input type="text" name="userid" class="id" 
                               value="<?= htmlspecialchars($_SESSION['userid']) ?>" readonly 
                               style="background-color: #f0f0f0; border: 1px solid #ddd; padding: 5px;">
                    </td>
                </tr>
                <tr>
                    <th>제목</th>
                    <td>
                        <input type="text" name="title" style="width: 98%; padding: 5px;" 
                               placeholder="제목을 입력하세요" required autofocus>
                    </td>
                </tr>
                <tr>
                    <th>내용</th>
                    <td>
                        <textarea name="content" rows="15" style="width: 98%; padding: 5px;" 
                                  placeholder="내용을 입력하세요" required></textarea>
                    </td> 
                </tr>
            </table>

            <div class="btn-group" style="margin-top: 20px;">
                <button type="submit" class="b2">작성 완료</button>
                <button type="button" class="b2" onclick="history.back();">취소</button>
            </div>
        </form>
    </div>
</body>
</html>
