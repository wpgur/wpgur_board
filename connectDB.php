<?php
function connectDB() 
{
    $mysql_host = 'localhost:3308';
    $mysql_user = 'root';
    $mysql_password = '';
    $mysql_db = 'db_board';
 
    $connect = mysqli_connect($mysql_host,$mysql_user, $mysql_password, $mysql_db) or die("connect failed");
 
    if($connect) { return $connect; }
    else { return 0; }
}
?>
