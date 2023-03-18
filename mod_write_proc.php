<!DOCTYPE html>
<html>
<!--http://syaic12.cafe24.com/kimsuji/board/mod_proc.php -->
    <head>
    <link rel = "stylesheet" href = "table.css">
    </head>
  
    <body>
        <?php
        include "db.php";
        
        // 입력 데이터 가져오기
        $idx = $_REQUEST['idx'];
        $cp = $_REQUEST['cp'];
        $title = $_REQUEST['title'];
        $content = $_REQUEST['content'];
   
        // 레코드 수정
        $sql = "update sj_board set title = '$title', content= '$content'
                where idx = $idx"; 
        $res = mysqli_query($db, $sql);
        if($res){?>
        <script>
            alert("글이 성공적으로 수정되었습니다");
            location.replace("board_list.php?cp=<?=$cp?>");
        </script>
           
        <?} else{?>
            <script>
                alert("수정 오류입니다.");
                location.replace('javascript:history.go(-1)');
            </script>
        <?   
        }
        mysqli_close($db);
        ?>
    </body>
</html>
