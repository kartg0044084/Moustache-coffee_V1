<?php
session_start();
$id = $_GET['cartID'];
unset($_SESSION['cart']);
 header('Location: my_cart.php');
 ?>
