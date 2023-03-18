<!DOCTYPE html>
<html>
<!--http://syaic12.cafe24.com/kimsuji/board/mod_form.php -->
    <head>
    <link rel = "stylesheet" href = "table.css">
    </head>

    <body>
        <center>
        <div><h1>글수정</h1></div>
        <?php
         //DB 설정 파일 포함
         include "db.php";
        
         // 보여줄 글의 idx
         $idx = $_GET['idx'];
         $cp = $_GET['cp'];
 
         // 테이블에서 해당 글 조회
         $sql = "select * from sj_board
                 where idx = $idx";
         $res = mysqli_query($db, $sql);
 
         // 결과 얻기
         $row = mysqli_fetch_array($res);
        ?>
        <form name = "mod" action = "mod_proc.php" method = "post">
            <input type = "hidden" name = "idx" value = "<?=$idx?>">
            <input type = "hidden" name = "cp" value = "<?=$cp?>">
        
            <table class = "t">
                <tr>
                    <th>아이디</th>
                    <td><input type = "text" name = "userid" class = "id" value = "<?=$row['userid']?>" readonly></td>  
                </tr>
                <tr>
                    <th>제목</th>
                    <td><input type = "text" name = "title" style = "width:99%;"  value = "<?=$row['title']?>"></td>
                </tr>
                <tr>
                    <th>내용</th>
                    <td><textarea name = "content" cols = "50" rows = "20" style = "width: 99%;"><?=$row['content']?></textarea></td> 
                </tr>
            </table>
                <input type = "submit" class = "b2" value = "수정">
                <a href = "javascript:history.go(-1);"><input type = "button" class = "b2" value = "취소"></a>
        </center>
        </form>
    </body>
</html>
