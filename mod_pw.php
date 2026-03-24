<?php
session_start();
include "db.php";

// 1. 로그인 여부 확인 (비로그인 시 접근 차단)
if (!isset($_SESSION['userid'])) {
    echo "<script>alert('로그인이 필요한 서비스입니다.'); location.replace('login.html');</script>";
    exit;
}

$userid = $_SESSION['userid'];

// 2. 사용자 정보 확인 (DB 조회 - 보안을 위해 따옴표 추가)
$sql = "SELECT * FROM sj_user WHERE userid = '" . mysqli_real_escape_string($db, $userid) . "'";
$res = mysqli_query($db, $sql);
$row = mysqli_fetch_array($res);

if (!$row) {
    echo "<script>alert('사용자 정보를 찾을 수 없습니다.'); history.back();</script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>비밀번호 변경</title>
    <link rel="stylesheet" href="table.css">
</head>
<body>
    <div class="container" style="text-align: center; margin-top: 50px;">
        <header>
            <h1>비밀번호 변경</h1>
        </header>

        <form name="mod_pw" action="mod_pw_proc.php" method="post" onsubmit="return validateForm()">
            <input type="hidden" name="userid" value="<?= htmlspecialchars($userid) ?>">
        
            <table class="t" style="margin: 0 auto;">
                <tr>
                    <th>새 비밀번호</th>
                    <td>
                        <input type="password" name="new_pw" id="new_pw" placeholder="새 비밀번호 입력" required autofocus>
                    </td>  
                </tr>
                <tr>
                    <th>비밀번호 확인</th>
                    <td>
                        <input type="password" name="confirm_pw" id="confirm_pw" placeholder="비밀번호 재입력" required>
                    </td>
                </tr>
            </table>

            <div class="btn-group" style="margin-top: 20px;">
                <button type="submit" class="b2">변경하기</button>
                <button type="button" class="b2" onclick="history.back();">취소</button>
            </div>
        </form>
    </div>

    <script>
    function validateForm() {
        var pw = document.getElementById("new_pw").value;
        var confirmPw = document.getElementById("confirm_pw").value;
        if (pw != confirmPw) {
            alert("비밀번호가 서로 일치하지 않습니다.");
            return false;
        }
        return true;
    }
    </script>
</body>
</html>
<?php mysqli_close($db); ?>
