<?php
require_once('../template/login_check.php');
require_once('../../connection/database.php');

$limit=2;
// 判斷目前第幾頁，若沒有page參數就預設為1
if (isset($_GET["page"])) {$page = $_GET["page"]; } else {$page=1; };
// 計算要從第幾筆開始
$start_from = ($page-1) * $limit;
$sth=$db->query("SELECT * FROM customer_order WHERE status=".$_GET['status']." ORDER BY createdDate DESC LIMIT ".$start_from.",". $limit);
$customer_order=$sth->fetchAll(PDO::FETCH_ASSOC);
$totalRows = count($customer_order);

if ($_GET['status'] == 0) {
  $status = "新訂單";
}else if ($_GET['status'] == 1) {
  $status = "已付款";
}else if ($_GET['status'] == 2) {
  $status = "出貨中";
}else if ($_GET['status'] == 3) {
  $status = "已出貨";
}else if ($_GET['status'] == 4) {
  $status = "已送達(交易完成)";
}else if ($_GET['status'] == 99) {
  $status = "取消訂單";
}
 ?>
<html>
<head>
    <meta charset="utf-8">
    <title>list</title>
     <?php include_once('../template/header.php'); ?>
  </head>
  <body>
   <?php include_once('../template/nav.php'); ?>
    <div class="section">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center">
            <h1 class="text-left">訂單管理-<?php echo $status?></h1>
          </div>
        </div>
      </div>
    </div>
    <div class="section">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <ul class="breadcrumb">
              <li>
                <a href="#">主控台</a>
              </li>
              <li>
                <a href="#" class="active"> <?php echo $status?></a>
              </li>
            </ul>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <a href="add.php" class="btn btn-default">新增一筆</a>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <table class="table">
              <thead>
                <tr>
                  <th>訂單日期</th>
                  <th>訂單編號</th>
                  <th>訂購人</th>
                  <th>行動電話</th>
                  <th>地址</th>
                  <th>總金額</th>
                  <th>訂單狀態</th>
                  <th>訂單明細</th>
                  <th>刪除</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($customer_order  as $row){ ?>
                <tr>
                  <td><?php echo $row['orderDate'] ?></td>
                  <td><?php echo $row['orderNO'] ?></td>
                  <td><?php echo $row['name'] ?></td>
                  <td><?php echo $row['phone'] ?></td>
                  <td><?php echo $row['address'] ?></td>
                  <td><?php echo $row['totalprice'] ?></td>
                  <td><?php echo $status ?></td>
                  <td><a href="edit.php?customer_orderID=<?php echo $row['customer_orderID'];?>">訂單明細</a></td>
                  <td><a href="delete.php?customer_orderID=<?php echo $row['customer_orderID'];?>" onclick="if(!confirm('是否刪除此筆資料？')){return false;};">刪除</a></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="section">
      <div class="container">
        <?php  if($totalRows > 0){
            $sth = $db->query("SELECT * FROM customer_order WHERE status=".$_GET['status']." ORDER BY orderDate DESC ");
            $data_count = count($sth ->fetchAll(PDO::FETCH_ASSOC));
            $total_pages = ceil($data_count / $limit);
           ?>
        <div class="row">
          <div class="col-md-12 text-center">
            <ul class="pagination">
              <?php   if($page > 1){ ?>
                <li>
                  <a href="list.php?page=<?php echo $page-1;?>">上一頁</a>
                </li>
                <?php }else{ ?>
                  <li>
                    <a href="#">上一頁</a>
                  </li>
                  <?php } ?>
              <?php for ($i=1; $i<=$total_pages; $i++) { ?>

              <li>
                <a href="list.php?page=<?php echo $i;?>"><?php echo $i;?></a>
              </li>
              <?php } ?>
              <?php if($page < $total_pages){ ?>
              <li>
                <a href="list.php?page=<?php echo $page+1;?>">下一頁</a>
              </li>
              <?php }else{ ?>
                <li>
                  <a href="#">下一頁</a>
                </li>
                <?php } ?>
            </ul>
          </div>
        </div>
        <?php } ?>
      </div>
    </div>
    <footer class="section section-primary">
      <div class="container">
        <div class="row">
          <div class="col-sm-6">
            <h1>聖保羅廚房</h1>
            <p contenteditable="true">版權所有 © 2016 &nbsp; St Paul Kitchen All Right Reserved.</p>
          </div>
        </div>
      </div>
    </footer>


</body></html>
