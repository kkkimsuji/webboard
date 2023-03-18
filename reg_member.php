<!DOCTYPE html>
<html>
<!--http://syaic12.cafe24.com/kimsuji/board/reg_member.php -->
    <head>
    <link rel = "stylesheet" href = "table.css">
    </head>
    <body>
        <?php
        // mysql 접속
        $db = mysqli_connect('localhost','syaic12','syaic1212');
        if( !$db ){
            // 접속 오류
            echo "DBMS 접속 오류<br>";
            exit(0);
        }
        // 작업 db 선택
        if (!mysqli_select_db($db, 'syaic12')){
            //db 선택 오류
            echo "DB 선택오류 <br>";
            exit(0);
        }
        // 입력 데이터 가져오기
        $userid = $_REQUEST['userid'];
        $passwd = $_REQUEST['passwd'];
        $name = $_REQUEST['name'];
        $email = $_REQUEST['email'];

        // DB에 사용자 데이터 추가

        // 아이디 중복 확인
        $sql = "select * from sj_user where userid = '$userid'";
        $res = mysqli_query($db, $sql);
        if(mysqli_num_rows($res) > 0){?>
            <script>
                alert("이미 사용 중인 아이디입니다😢");
                location.replace('reg_member.html');
            </script>
        
        <?} 

        // 테이블에 추가
        $sql = "insert into sj_user values('$userid',password('$passwd'),'$name','$email',now())";
        $res = mysqli_query($db, $sql);
        if($res){
            ?>
            <script>
                alert("회원가입을 축하합니다😊");
                location.replace('login.html');
            </script>
        <?} else{?>
            <script>
                alert("회원가입 오류입니다😢");
                location.replace('reg_member.html');
            </script>
        <?}
        mysqli_close($db);
        ?>
        <a href = "login.html">로그인하기</a>
    </body>
</html>
