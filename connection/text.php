<?php 
require_once('database.php');
$sth=$db->query('SELECT*FROM news');
$all_news=$sth->fetchAll(PDO::FETCH_ASSOC);
print_r($all_news);

echo $all_news[0]['content'];
 ?>