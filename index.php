<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <!-- DB 세팅 -->
    <?php
    include "./connectDB.php";
    $connect = connectDB();
    $query = "select * from board order by number desc";   
    $result = mysqli_query($connect, $query);
    $total = mysqli_num_rows($result);  //result set의 총 레코드(행) 수 반환
    session_start();

    // 로그인 세션 관리
    if (isset($_SESSION['userid'])) {
    ?>
    <div id='login'>
        <b><?php echo $_SESSION['userid']; ?>님 반갑습니다.</b>
        <button onclick="location.href='./logout_action.php'">로그아웃</button>   
    </div>
        <br/>
    <?php
    } else {
    ?>
    <div id='login'>
        <b>로그인을 해주세요.</b>
        <button onclick="location.href='./login.php'" style="float:right; font-size:15.5px;">로그인</button>
        <br/>
    </div>
    <?php
    }
    ?>
    

    <p><b>게시판</b></p>

    <table align=center>
        <thead align="center">
            <tr>
                <td width="50" align="center">번호</td>
                <td width="500" align="center">제목</td>
                <td width="100" align="center">작성자</td>
                <td width="200" align="center">날짜</td>
                <td width="50" align="center">조회수</td>
            </tr>
        </thead>

        <tbody>
            <?php
            while ($rows = mysqli_fetch_assoc($result)) {   //result set에서 레코드(행)를 1개씩 리턴
                if ($total % 2 == 0) {
            ?>
                    <tr class="even">
                        <!--배경색 진하게-->
                    <?php } else {
                    ?>
                    <tr>
                        <!--배경색 그냥-->
                    <?php } ?>
                    <td width="50" align="center"><?php echo $total ?></td>
                    <td width="500" align="center">
                        <a href="read.php?number=<?php echo $rows['number'] ?>">
                            <?php echo $rows['title'] ?>
                    </td>
                    <td width="100" align="center"><?php echo $rows['id'] ?></td>
                    <td width="200" align="center"><?php echo $rows['date'] ?></td>
                    <td width="50" align="center"><?php echo $rows['hit'] ?></td>
                    </tr>
                <?php
                $total--;
            }
                ?>
        </tbody>
    </table>
    <div id="search_box">
    <form action="/db_board/search_result.php" method="get">
      <select name="catgo">
        <option value="title">제목</option>
        <option value="name">작성자</option>
        <option value="content">내용</option>
      </select>
      <input type="text" name="search" size="40" required="required" /> <button>검색</button>
    </form>
    </div>

    <div class=text>
        <font onClick="location.href='./write.php'">글쓰기</font>
    </div>
    
</body>

</html>