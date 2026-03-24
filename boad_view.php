<?php
session_start();
include "db.php";

// 1. 파라미터 체크 및 필터링 (보안 강화)
$idx = isset($_GET['idx']) ? mysqli_real_escape_string($db, $_GET['idx']) : null;
$cp = isset($_GET['cp']) ? mysqli_real_escape_string($db, $_GET['cp']) : 1;
$ing_id = $_SESSION['userid'] ?? '';

if (!$idx) {
    echo "<script>alert('잘못된 접근입니다.'); history.back();</script>";
    exit;
}

// 2. 조회수 업데이트 로직 (상단 배치 - 화면 출력 전 데이터 처리)
$sql_check = "SELECT * FROM sj_board WHERE idx = '$idx'";
$res = mysqli_query($db, $sql_check);
$row = mysqli_fetch_array($res);

if ($row && $row['userid'] != $ing_id) {
    $new_hit = $row['hit'] + 1;
    mysqli_query($db, "UPDATE sj_board SET hit = $new_hit WHERE idx = '$idx'");
    $row['hit'] = $new_hit; // 화면에 즉시 반영
}
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>글보기 - <?=$row['title']?></title>
    <link rel="stylesheet" href="css/table.css"> </head>
<body>
    <div class="container"> <header>
            <h1>글보기</h1>
        </header>
        
        <table class="t">
            <tr>
                <th style="width: 15%">작성자</th>
                <td style="width: 20%"><?=htmlspecialchars($row['userid'])?></td> 
                <th style="width: 15%">작성일</th>
                <td style="width: 30%"><?=$row['reg_date']?></td> 
                <th style="width: 10%">조회</th> 
                <td><?=$row['hit']?></td>
            </tr>
            <tr>
                <th>제목</th>
                <td class="left" colspan="5"><?=htmlspecialchars($row['title'])?></td>
            </tr>
            <tr>
                <th>내용</th>
                <td class="left content-area" colspan="5"><?=nl2br(htmlspecialchars($row['content']))?></td>
            </tr>
        </table>
        
        <div class="btn-group">
            <?php if ($row['userid'] == $ing_id): ?>
                <a href="mod_form.php?idx=<?=$idx?>&cp=<?=$cp?>"><button type="button">수정</button></a>
                <a href="del_form.php?idx=<?=$idx?>"><button type="button">삭제</button></a>
            <?php endif; ?>
            <a href="board_list.php?cp=<?=$cp?>"><button type="button">목록</button></a>
        </div>
    </div>
</body>
</html>
<?php mysqli_close($db); ?>
