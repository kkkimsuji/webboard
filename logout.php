<?php session_start();
$res = session_destroy();
if($res){?>
<script>
    alert("로그아웃 되었습니다.");
    location.replace('login.html');
</script>
<?}?>
