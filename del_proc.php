<!DOCTYPE html>
<html>
<!--http://syaic12.cafe24.com/kimsuji/board/del_proc.php -->
    <head>
        <link rel = "stylesheet" href = "table.css">
    </head>
   
    <body>
        <?php
        include "db.php";
   
        // 입력 데이터 가져오기
        $idx = $_REQUEST['idx'];
       
        // 레코드 삭제
        $sql = "delete from sj_board where idx = $idx"; 
        $res = mysqli_query($db, $sql);
        if($res){?>
            <script>
                alert("글이 성공적으로 삭제되었습니다");
                location.replace("board_list.php?cp=<?=$cp?>");   
            </script>
        <?} else{?>
            <script>
                alert("삭제오류입니다");
                location.replace('javascript:history.go(-1)');    
            </script>
        <?}
        mysqli_close($db);
        ?>
    </body>
</html>
