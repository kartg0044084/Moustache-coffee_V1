<?php
session_start();
require('../../connection/database.php');

$sth = $db->query("SELECT * FROM member WHERE Account='".$_POST['account']."' AND Password='".$_POST['password']."'");

$member = $sth->fetch(PDO::FETCH_ASSOC);

if($member != NULL){
  $_SESSION['Account'] = $member['Account'];
  header('Location: member_edit.php');
}else{
  header('Location: login_error.php');
}
 ?>
