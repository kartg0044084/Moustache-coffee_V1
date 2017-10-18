<?php 
require_once('../../connection/database.php');
$sth=$db->query("DELETE FROM product_category WHERE product_categoryID=".$_GET['product_categoryID']);
 header("Location: list.php");
 ?>