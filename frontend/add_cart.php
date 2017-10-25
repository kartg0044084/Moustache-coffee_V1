<!-- 為product_content判斷頁 -->
<?php
session_start();

$is_existed = "false";
// 2判斷商品是否重複
if(isset($_SESSION['cart']) && $_SESSION['cart'] != null){
  for ($i=0; $i <count($_SESSION['cart']) ; $i++) {
    if ($_POST['productID'] == $_SESSION['cart'][$i]['productID']) {
      $is_existed = "true";
      goto_previousPage($is_existed);
    }
  }
}
if($is_existed == "false"){
  // 將接收的商品資料儲存temp 陣列
  $temp['productID']  = $_POST['productID'];
  $temp['name']  = $_POST['name'];
  $temp['picture']  = $_POST['picture'];
  $temp['price']  = $_POST['price'];
  $temp['productID']  = $_POST['productID'];
  $temp['quantity']  = $_POST['quantity'];
  if ($_POST['quantity']<=0)$temp['quantity'] = 1;//如傳來值<=1則自動變為一
  // 將陣列資料加入到session cart 中
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
