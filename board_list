<?php session_start();?>

<!--https://syaic12.cafe24.com/_myAdmin/index.php -->
<!--http://syaic12.cafe24.com/kimsuji/board/board_list.php -->
<!--완-->
<!DOCTYPE html>
<html>
    <head>
    <link rel="stylesheet" href="table.css">
    </head>
    <body>
        <?php
        //DB 설정 파일 포함
        include "db.php";
        
        //전체 글 개수 조회
        $sql = "select count(*) from sj_board";
        $res = mysqli_query($db, $sql);
        $row = mysqli_fetch_array($res);
        $total_rows = $row[0];

        //페이지 당 글의 수s
        $rows_per_page = 10;

        //전체 페이지 수
        $total_page = ceil($total_rows/$rows_per_page);  //ceil: 올림
        // 현재 페이지 얻기
        $cur_page = $_GET['cp'];
        if(!$cur_page) $cur_page = 1;
        // 현재 페이지의 첫 글의 위치
        $start = $rows_per_page * ($cur_page - 1);

        // DB에 글 목록 조회
        $sql = "select idx, userid, title, reg_date, hit 
                from sj_board order by idx desc limit $start, $rows_per_page";
        $res = mysqli_query($db, $sql);

        // 결과 테이블의 행의 수 얻기
        $num_rows = mysqli_num_rows($res);
        ?>
        <center>
        <div><h1>게시판</h1></div>
        <div>접속자 : <?=$_SESSION['userid']?></div>

        <a href = "main.php"><input type = "button" class="b3" value = "MyPage👤"></a>
        <a href = "write.php"><input type = "button" class="b3" value = "Write✍🏻"></a>
        <a href = "logout.php"><input type = "button" class="b3" value = "Logout🔒"></a>
        
        <table  class="t">
        <tr>
            <th style="width: 10%"> 번호 </th>
            <th style="width: 15%"> 작성자 </th> 
            <th> 제목 </th> 
            <th style="width: 25%"> 작성일 </th>
            <th style="width: 10%"> 조회 </th>   
        </tr>

        <?php for ( $i = 0 ; $i < $num_rows ; $i++ ){
            $row = mysqli_fetch_array($res);?>
        <tr>
            <td><?= $row['idx']?></td>
            <td><?= $row['userid']?></td>
            <td class="left">
                <a href = "board_view.php?idx=<?=$row['idx']?>&cp=<?=$cur_page?>"><?= $row['title']?></a></td>
            <td><?= $row['reg_date']?></td>
            <td><?= $row['hit']?></td>
        </tr>
     
        <?php } 
            $prev = $cur_page - 1;
            $next = $cur_page + 1; ?>
        </table>
        
        <div id="b">
            <?php if($prev >0) {?>
            <a href = "board_list.php?cp=<?=$prev?>"><?="<"?></a>
            <?} 
            for($j = 1; $j <= $total_page; $j++){
                if ($j == $cp){?>
                <span style="text-weight:bold"><?=$j?></span>
                
                <?}
                else{ ?>
                <a href="board_list.php?cp=<?=$j?>"><?=$j?></a>
                <?php } 
            }
            if($next <= $total_page) {?>
            <a href = "board_list.php?cp=<?=$next?>"><?=">"?></a>
            <?} ?>
        </div>
        </center>
       
        
        <?php 
        mysqli_close($db);
        ?>
        
    </body>
</html>
