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
        $new_pw = $_POST['new_pw'];
        $userid = $_SESSION['userid'];
   
        // 레코드 수정
        $sql = "update sj_user set passwd = '$new_pw'
                where userid = $_SESSION[userid]";

        $res = mysqli_query($db, $sql);
        if($res){?>
        <script>
            alert("비밀번호가 변경되었습니다.");
            location.replace('board_list.php');
        </script>
           
        <?} else{?>
            <script>
                alert("변경 오류입니다.");
                location.replace('javascript:history.go(-1)');
            </script>
        <?   
        }
        mysqli_close($db);
        ?>
    </body>
</html>
