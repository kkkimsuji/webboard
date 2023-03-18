<?php session_start(); ?>

<!DOCTYPE html>
<html>
    <head><link rel = "stylesheet" href = "table.css"></head>
    <body>
    <?php
    include "db.php";

    $userid = $_SESSION["userid"];

    $sql = "delete from sj_user where userid = $userid";
    $res = mysqli_query($db, $sql);

    if($res){
        unset($_SESSION["userid"]);
        unset($_SESSION["passwd"]);
        unset($_SESSION["email"]);?>
        <script>
            alert("성공적으로 탈퇴되었습니다");
            location.replace('login.html');   
        </script>
    <?} else{?>
        <script>
            alert("탈퇴 오류입니다");
            location.replace('javascript:history.go(-1)');    
        </script>
    <?}
    mysqli_close($db);
    ?>
    </body>
</html>
