<?php session_start(); ?>
<!--http://syaic12.cafe24.com/kimsuji/board/board_view.php -->
<!--완-->
<!DOCTYPE html>
<html>
    <head>
    <link rel = "stylesheet" href="table.css">
    </head>
  
    <body>
        <?php
        //DB 설정 파일 포함
        include "db.php";
        $ing_id = $_SESSION['userid'];
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
        <center>
        <div><h1>글보기</h1></div>
        
        <table class="t">
        <tr>
            <th style = "width: 10%"> 작성자 </th>
            <td style = "width: 15%;"><?=$row['userid']?></td> 
            <th> 작성일 </th>
            <td style = "width: 25%;"><?=$row['reg_date']?></td> 
            <th style = "width: 10%"> 조회 </th> 
            <?php 
            if($row['userid']!=$ing_id){?>
                <td><?=$row['hit']+1?></td> 
            <?} 
            else{?>
                <td><?=$row['hit']?></td>
            <?}?>
        </tr>
        <tr>
            <th>제목</th>
            <td class="left" colspan = "5"><?=$row['title']?></td>
        </tr>
        <tr>
            <th>내용</th>
            <td class="left" colspan= "5"><?=nl2br($row['content'])?></td>
        </tr>
        </table>
        
        <?php
            if ($row['userid']==$ing_id){?> 
                <div>
                <a href = "mod_form.php?idx=<?=$idx?>&cp=<?=$cp?>"><input type = "button" value = "수정"></a>
                <a href = "del_form.php?idx=<?=$idx?>"><input type = "button" value = "삭제"></a>
                </div>
                <? }?>
            <a href = "board_list.php?cp=<?=$cp?>"><input type = "button" value = "목록"></a>


        </center>
        <?php 
        if ($row['userid'] != $ing_id) {
            $hit = $row['hit'] + 1;
            $sql = "update sj_board set hit= $hit where idx = $idx";
            $res = mysqli_query($db, $sql);
            $row = mysqli_fetch_array($res);}
        mysqli_close($db);
        ?>
    
    </body>
</html>
