<?php

include "./connectDB.php";
$connect = connectDB();

$number = $_GET['number'];
$query = "select id from board where number = $number";
$result = $connect->query($query);
$rows = mysqli_fetch_assoc($result);

$userid = $rows['id'];

session_start();
$URL = "./index.php";
?>

<?php
// 세션 체크
if (!isset($_SESSION['userid'])) {
?> <script>
        alert("권한이 없습니다.");
        location.replace("<?php echo $URL ?>");
    </script>
<!-- 세션 확인후 삭제 진행 -->
<?php } else if ($_SESSION['userid'] == $userid) {
    $query1 = "delete from board where number = $number";
    $result1 = $connect->query($query1); ?>
    <script>
        alert("게시글이 삭제되었습니다.");
        location.replace("<?php echo $URL ?>");
    </script>

<?php } else { ?>
    <script>
        alert("권한이 없습니다.");
        location.replace("<?php echo $URL ?>");
    </script>
<?php }
?>