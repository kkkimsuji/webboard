<!DOCTYPE html>
<html>
<!--http://syaic12.cafe24.com/kimsuji/board/del_form.php  -->
    <head>
    <link rel = "stylesheet" href = "table.css">
    </head>
   
    <body>
        <center>
        <div><h1>삭제<h1></div>
        <?php
        $idx = $_REQUEST['idx'];
        ?>
        <form name = "del" action = "del_proc.php" method = "post">
            <input type = "hidden" name = "idx" value = "<?=$idx?>">
            <div><h3>정말로 삭제하시겠습니까?</h3></div>
            <div>
                <input type = "submit" class = "b2" value = "삭제">
                <a href = "javascript:history.go(-1);"><input type = "button" class = "b2" value = "취소"></a>
            </div>    
        </center>
        </form>      
    </body>
</html>
