<!DOCTYPE html>
<html>
<!--http://syaic12.cafe24.com/kimsuji/board/mod_form.php -->
    <head>
    <link rel = "stylesheet" href = "table.css">
    </head>

    <body>
        <center>
        <div><h1>비밀번호 변경</h1></div>
        <?php
         //DB 설정 파일 포함
         include "db.php";
        
         // 
         $userid = $_SESSION['userid'];
        
         // 테이블에서 해당 아이디 조회
         $sql = "select * from sj_user
                 where userid = $userid";
         $res = mysqli_query($db, $sql);
 
         // 결과 얻기
         $row = mysqli_fetch_array($res);
        ?>
        <form name = "mod_pw" action = "mod_pw_proc.php" method = "post">
            <input type = "hidden" name = "userid" value = "<?=$userid?>">
        
            <table>
                <tr>
                    <th>새 비밀번호</th>
                    <td><input type = "password" name = "new_pw" ></td>  
                </tr>
            </table>
                <input type = "submit" class = "b2" value = "변경">
                <a href = "javascript:history.go(-1);"><input type = "button" class = "b2" value = "취소"></a>
        </center>
        </form>
    </body>
</html>
