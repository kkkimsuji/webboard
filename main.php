<?php session_start(); ?>
<!DOCTYPE html>
<!--http://syaic12.cafe24.com/kimsuji/board/main.php-->
<html>
    <head>
    <link rel = "stylesheet" href = "table.css">
    </head>

    <body>
    <center>
        <div><h1>마이페이지<h1></div>

        <?php
        echo "아이디 : {$_SESSION['userid']}<br>";
        echo "이름 : {$_SESSION['name']}<br>";
        echo "이메일 주소 : {$_SESSION['email']}<br>";
        ?>

        <a href = "board_list.php"><input type = "button" class = "b2" value = "게시판"></a>
        <a href = "mod_pw.php"><input type = "button" class = "b2" value = "PW변경"></a>
        <a href = "del_mem_proc.php"><input type = "button" class = "b2" value = "탈퇴하기"> </a>
    </center>
    </body>
</html>
