<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
    include "./connectDB.php";
    $connect = connectDB();
    $number = $_GET['number'];
    $query = "select title, content, date, id from board where number = $number";
    $result = $connect->query($query);
    $rows = mysqli_fetch_assoc($result);

    $title = $rows['title'];
    $content = $rows['content'];
    $userid = $rows['id'];

    session_start();

    $URL = "./index.php";

    if (!isset($_SESSION['userid'])) {
    ?> <script>
            alert("권한이 없습니다.");
            location.replace("<?php echo $URL ?>");
        </script>
    <?php   } else if ($_SESSION['userid'] == $userid) {
    ?>
        <form method="POST" action="modify_action.php">
            <table class='modify_table' align=center width=auto border=0 cellpadding=2>
                <tr>
                    <td class='modify_td'>
                        <p><b>게시글 수정하기</b></p>
                    </td>
                </tr>
                <tr>
                    <td bgcolor=white>
                        <table class="table2">
                            <tr>
                                <td>작성자</td>
                                <td><input type="hidden" name="id" value="<?= $_SESSION['userid'] ?>"><?= $_SESSION['userid'] ?></td>
                            </tr>

                            <tr>
                                <td>제목</td>
                                <td><input type=text name=title size=87 value="<?= $title ?>"></td>
                            </tr>

                            <tr>
                                <td>내용</td>
                                <td><textarea name=content cols=75 rows=15><?= $content ?></textarea></td>
                            </tr>

                        </table>

                        <center>
                            <input type="hidden" name="number" value="<?= $number ?>">
                            <input style="height:26px; width:47px; font-size:16px;" type="submit" value="작성">
                        </center>
                    </td>
                </tr>
            </table>
        </form>
    <?php   } else {
    ?> <script>
            alert("권한이 없습니다.");
            location.replace("<?php echo $URL ?>");
        </script>
    <?php   }
    ?>
</body>

</html>