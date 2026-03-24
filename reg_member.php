<?php
// 처리 전용 파일이므로 HTML 태그는 제거하는 것이 좋습니다.
include "db.php";

// 1. 데이터 수신 및 유효성 검사
$userid = isset($_POST['userid']) ? mysqli_real_escape_string($db, $_POST['userid']) : '';
$passwd = isset($_POST['passwd']) ? $_POST['passwd'] : '';
$name   = isset($_POST['name'])   ? mysqli_real_escape_string($db, $_POST['name'])   : '';
$email  = isset($_POST['email'])  ? mysqli_real_escape_string($db, $_POST['email'])  : '';

if (!$userid || !$passwd || !$name || !$email) {
    echo "<script>alert('모든 항목을 입력해주세요.'); history.back();</script>";
    exit;
}

// 2. 아이디 중복 확인
$sql_check = "SELECT userid FROM sj_user WHERE userid = '$userid'";
$res_check = mysqli_query($db, $sql_check);

if (mysqli_num_rows($res_check) > 0) {
    echo "<script>
            alert('이미 사용 중인 아이디입니다😢');
            history.back();
          </script>";
    exit; // 중복 시 아래 코드가 실행되지 않도록 반드시 exit를 써야 합니다.
}

// 3. 회원 정보 저장 (password() 함수는 login.php와 동일하게 유지)
// 컬럼명을 명시해주는 것이 나중에 테이블 구조가 바뀌어도 오류가 안 나서 더 좋습니다.
$sql_insert = "INSERT INTO sj_user (userid, passwd, name, email, reg_date) 
               VALUES ('$userid', password('$passwd'), '$name', '$email', NOW())";

$res_insert = mysqli_query($db, $sql_insert);

if ($res_insert) {
    echo "<script>
            alert('회원가입을 축하합니다😊');
            location.replace('login.html');
          </script>";
} else {
    echo "<script>
            alert('회원가입 중 오류가 발생했습니다. 관리자에게 문의하세요.');
            history.back();
          </script>";
}

mysqli_close($db);
?>
