<?php session_start(); ?>
<!DOCTYPE html>
<!--http://syaic12.cafe24.com/kimsuji/board/login.php  -->
<html>
    <head>
        <link rel = "stylesheet" href = "table.css">
    </head>
  
    <body>
        <?php
        //DB 설정 파일 포함
        include "db.php";
        
        // 입력 데이터 가져오기
        $userid = $_REQUEST['userid'];
        $passwd = $_REQUEST['passwd'];
        $email = $_REQUEST['email'];
        
        // DB에 사용자 확인
        $sql = "select * from sj_user 
                where userid = '$userid' and passwd = password('$passwd')";
        $res = mysqli_query($db, $sql);

        if(mysqli_num_rows($res)>0){
            // 회원 인증 성공
            $row = mysqli_fetch_array($res);?>
            <script>
                location.replace('board_list.php');
            </script>
            <?
                $_SESSION['userid'] = $row['userid'];
                $_SESSION['name'] = $row['name'];
                $_SESSION['email'] =$row['email'];
                $_SESSION['passwd'] =$row['passwd'];
            
        } else {?>
            <script>
                alert(" 일치하는 회원을 찾을 수 없습니다.\n 다시 로그인해주세요.");
                location.replace('javascript:history.go(-1)');
            </script>
        <?}   
        mysqli_close($db);
        ?>
    </body>
</html>
