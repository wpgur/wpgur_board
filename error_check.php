<!-- 
php 오류날때 오류를 체크해주는 코드 

include "./error_check.php"; 로 사용할 수 있다 
-->

<?php
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
?>