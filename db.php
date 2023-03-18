<link rel = "stylesheet" href = "table.css">

<?php
// mysql 접속
$db = mysqli_connect('localhost','syaic12','syaic1212');
if( !$db ){
    // 접속 오류
    echo "DBMS 접속 오류<br>";
    exit(0);
}
// 작업 db 선택
if (!mysqli_select_db($db, 'syaic12')){
    //db 선택 오류
    echo "DB 선택오류 <br>";
    exit(0);
}
?>
