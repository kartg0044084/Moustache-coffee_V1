<?php 
require_once('../../connection/database.php');
$sth=$db->query("DELETE FROM customer_order WHERE customer_orderID=".$_GET['customer_orderID']);
 header('Location: list.php');
 ?>