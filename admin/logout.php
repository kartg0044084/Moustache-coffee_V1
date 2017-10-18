<?php 
session_start();
unset($_SESSION['account']);
$msg='您以成功登出';
header('Location: login.php?msg='.$msg);
?>