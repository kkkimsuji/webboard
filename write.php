<?php session_start(); ?>
<!DOCTYPE html>
<html>
<!--http://syaic12.cafe24.com/kimsuji/board/write.php  -->

    <head>
    <link rel = "stylesheet" href = "table.css">
    </head>

    <body>
        <form name = "write" action = "write_proc.php" method = "post">
        <center>
        <div><h1>글 작성<h1></div>
        <table class = "t">
            <tr>
                <th>아이디</th>
                    <td><input type = "text" name = "userid" class = "id" value = "<?=$_SESSION['userid']?>" readonly></td>
            </tr>
            <tr>
                <th>제목</th>
                    <td><input type = "text" name = "title" style = "width:99%" required></td>
                </tr>
                <tr>
                    <th>내용</th>
                    <td><textarea name = "content" cols = "50" rows = "20" style = "width:99%"></textarea></td> 
                </tr>
        </table>
        <div>
            <input type = "submit" class = "b2" value = "작성"><a href = "javascript:history.go(-1);">
            <input type = "button" class = "b2" value = "취소"></a>
        </div>
      
        </center>
        </form>
    </body>
</html>
