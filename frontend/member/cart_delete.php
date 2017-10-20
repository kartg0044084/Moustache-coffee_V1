<?php
session_start();
$id = $_GET['cartID'];
unset($_SESSION['cart'][$id]);
$_SESSION['cart']= array_values($_SESSION['cart']);//重新整理陣列，以0開始遞增
 header('Location: my_cart.php');
 ?>
