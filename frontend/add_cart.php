<?php
session_start();

$is_existed = "false";
// 判斷商品是否重複
if(isset($_SESSION['cart']) && $_SESSION['cart'] != null){
  for ($i=0; $i <count($_SESSION['cart']) ; $i++) {
    if ($_POST['productID'] == $_SESSION['cart'][$i]['productID']) {
      $is_existed = "true";
      goto_previousPage($is_existed);
    }
  }
}
if($is_existed == "false"){
  $temp['productID']  = $_POST['productID'];
  $temp['name']  = $_POST['name'];
  $temp['price']  = $_POST['price'];
  $temp['productID']  = $_POST['productID'];
    $temp['quantity']  = $_POST['quantity'];
  // 將陣列資料加入到session Cart 中
  $_SESSION['cart'][] = $temp;
  goto_previousPage($is_existed);
}
// 1讀取傳入 $url[0] and $_POST['productID']值
    function goto_previousPage($is_existed){
      $url =  explode('?',$_SERVER['HTTP_REFERER']);
      $location = $url[0];
      $location.="?productID=".$_POST['productID'];
      $location.="&Existed=".$is_existed;

      header(sprintf('Location:%s', $location));
    }
 ?>
