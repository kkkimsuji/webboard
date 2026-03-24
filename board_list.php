<?php
session_start();
include "db.php";

// 1. 페이징 설정 및 계산 (상단 로직 집중)
$rows_per_page = 10;
$cur_page = isset($_GET['cp']) ? (int)$_GET['cp'] : 1; // 숫자로 강제 형변환 (보안)
if ($cur_page < 1) $cur_page = 1;

// 전체 글 개수 조회
$sql_count = "SELECT COUNT(*) FROM sj_board";
$res_count = mysqli_query($db, $sql_count);
$row_count = mysqli_fetch_array($res_count);
$total_rows = $row_count[0];

// 전체 페이지 수 계산
$total_page = ceil($total_rows / $rows_per_page);
if ($cur_page > $total_page && $total_page > 0) $cur_page = $total_page;

// 현재 페이지의 시작 위치
$start = ($cur_page - 1) * $rows_per_page;

// 2. DB 데이터 가져오기
$sql_list = "SELECT idx, userid, title, reg_date, hit 
             FROM sj_board ORDER BY idx DESC LIMIT $start, $rows_per_page";
$res_list = mysqli_query($db, $sql_list);
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>자유게시판</title>
    <link rel="stylesheet" href="css/table.css">
</head>
<body>
    <div class="container" style="text-align: center;">
        <header>
            <h1>게시판</h1>
            <p>접속자 : <strong><?= htmlspecialchars($_SESSION['userid'] ?? '비회원') ?></strong></p>
        </header>

        <nav class="menu-bar">
            <a href="main.php"><button type="button" class="b3">MyPage👤</button></a>
            <a href="write.php"><button type="button" class="b3">Write✍🏻</button></a>
            <a href="logout.php"><button type="button" class="b3">Logout🔒</button></a>
        </nav>
        
        <table class="t">
            <thead>
                <tr>
                    <th style="width: 10%">번호</th>
                    <th style="width: 15%">작성자</th> 
                    <th>제목</th> 
                    <th style="width: 25%">작성일</th>
                    <th style="width: 10%">조회</th>   
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_array($res_list)): ?>
                <tr>
                    <td><?= $row['idx'] ?></td>
                    <td><?= htmlspecialchars($row['userid']) ?></td>
                    <td class="left">
                        <a href="board_view.php?idx=<?= $row['idx'] ?>&cp=<?= $cur_page ?>">
                            <?= htmlspecialchars($row['title']) ?>
                        </a>
                    </td>
                    <td><?= $row['reg_date'] ?></td>
                    <td><?= $row['hit'] ?></td>
                </tr>
                <?php endwhile; ?>
                
                <?php if (mysqli_num_rows($res_list) == 0): ?>
                <tr>
                    <td colspan="5">등록된 게시글이 없습니다.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
        
        <div class="pagination">
            <?php 
            $prev = $cur_page - 1;
            $next = $cur_page + 1;

            if ($prev > 0): ?>
                <a href="board_list.php?cp=<?= $prev ?>">&lt;</a>
            <?php endif; ?>

            <?php for ($j = 1; $j <= $total_page; $j++): ?>
                <?php if ($j == $cur_page): ?>
                    <span class="current-page" style="font-weight: bold; color: red;"><?= $j ?></span>
                <?php else: ?>
                    <a href="board_list.php?cp=<?= $j ?>"><?= $j ?></a>
                <?php endif; ?>
            <?php endfor; ?>

            <?php if ($next <= $total_page): ?>
                <a href="board_list.php?cp=<?= $next ?>">&gt;</a>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
<?php mysqli_close($db); ?>
