<?php session_start(); ?>
<!DOCTYPE html>
<html>
<!--http://syaic12.cafe24.com/kimsuji/board/write_proc.php -->
    <head>
    <link rel = "stylesheet" href = "table.css">
    </head>
    <body>
        <?php
        include "db.php";
    
        // 입력 데이터 가져오기
        $userid = $_SESSION['userid'];
        $passwd = $_REQUEST['passwd'];
        $title = $_REQUEST['title'];
        $content = $_REQUEST['content'];
   
        // 테이블에 추가
        $sql = "insert into sj_board
        values(null, '$userid', '$title', '$content',0,now(), '')";
        $res = mysqli_query($db, $sql);
        if($res){?>
            <script>
                alert("글이 성공적으로 등록되었습니다👍");
                location.replace('board_list.php');
            </script>
 
        <?} else{?>
            <script>
                alert("글 등록에 실패하였습니다😢");
                location.replace('write.php');
            </script>
    
        <?}
        mysqli_close($db);
        ?>       
        <a href = "board_list.php"> 목록</a>  
    </body>
</html>
