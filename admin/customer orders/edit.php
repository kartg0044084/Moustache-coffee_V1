<?php
require_once('../template/login_check.php');
require_once('../../connection/database.php');

if(isset($_POST['MM_update']) && $_POST['MM_update'] == "UPDATE"){
  // 此處容易忘記
  $sql= "UPDATE customer_order SET status =:status,
            updatedDate = :updatedDate,
            customer_orderID = :customer_orderID, WHERE customer_orderID=:customer_orderID";
   $sth = $db ->prepare($sql);

   $sth ->bindParam(":status", $_POST['status'], PDO::PARAM_INT);
   $sth ->bindParam(":updatedDate", $_POST['updatedDate'], PDO::PARAM_STR);
   $sth ->bindParam(":customer_orderID", $_POST['customer_orderID'], PDO::PARAM_INT);
   $sth -> execute();

  header('Location: list.php?status='.$_POST['status']);
 }

$sth=$db->query("SELECT*FROM customer_order WHERE customer_orderID=".$_GET['customer_orderID']);
$customer_order =$sth->fetch(PDO::FETCH_ASSOC);
 ?>
<html>
<head>
    <meta charset="utf-8">
    <title>list</title>
    <?php include_once('../template/header.php'); ?>
  </head>
  <script type="text/javascript">
    $( function() {
    $( "#published_date" ).datepicker({
      dateFormat : "yy年mm月dd日"});
  } );
  </script>
  <body>
      <?php include_once('../template/nav.php'); ?>
    <div class="section">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center">
            <h1 class="text-left">訂單管理</h1>
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
                <a href="#">訂單管理</a>
              </li>
              <li class="active">修改訂單</li>
            </ul>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <hr>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
             <form class="form-horizontal" role="form" data-toggle="validator" action="edit.php" method="POST" >
              <!--action="add.php" method="POST" form使用post方式回傳到本頁add.php -->

              <div class="form-group">
                <div class="col-sm-2">
                  <label for="orderDate" class="control-label">訂單日期</label>
                </div>
                <div class="col-sm-10">
                  <?php echo $customer_order ['orderDate'];?>
                </div>
              </div>

              <div class="form-group">
                <div class="col-sm-2">
                  <label for="orderNO" class="control-label">訂單編號</label>
                </div>
                <div class="col-sm-10">
                  <?php echo $customer_order ['orderNO'];?>
                </div>
              </div>

          <div class="form-group">
            <div class="col-sm-2">
              <label for="status" class="control-label">訂單狀態</label>
            </div>
            <div class="col-sm-10">
            <input type="radio" id="status" name="status" value="0"<?php if($customer_order ['status'] == 0) echo "checked"; ?>>新訂單
            <input type="radio" id="status" name="status" value="1"<?php if($customer_order ['status'] == 1) echo "checked"; ?>>已付款
            <input type="radio" id="status" name="status" value="2"<?php if($customer_order ['status'] == 2) echo "checked"; ?>>出貨中
            <input type="radio" id="status" name="status" value="3"<?php if($customer_order ['status'] == 3) echo "checked"; ?>>已出貨
            <input type="radio" id="status" name="status" value="4"<?php if($customer_order ['status'] == 4) echo "checked"; ?>>已送達(交易完成)
            <input type="radio" id="status" name="status" value="99"<?php if($customer_order ['status'] == 99) echo "checked"; ?>>取消訂單
            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-2">
              <label for="name" class="control-label">訂購人</label>
            </div>
            <div class="col-sm-10">
              <?php echo $customer_order ['name'];?>
            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-2">
              <label for="phone" class="control-label">電話</label>
            </div>
            <div class="col-sm-10">
              <?php echo $customer_order ['phone'];?>
            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-2">
              <label for="address" class="control-label">地址</label>
            </div>
            <div class="col-sm-10">
              <?php echo $customer_order ['address'];?>
            </div>
          </div>

              <div class="form-group">
                <div class="col-sm-10 col-sm-offset-2 text-right">
                  <input type="hidden" name="customer_orderID" value="<?php echo $customer_order ['customer_orderID']; ?>">
                  <!-- 隱藏表單 透過 customer_orderID 更新(由上往下跑) 完成更新 -->
                   <input type="hidden" name="MM_update" value="UPDATE"> <!--form表單隱藏欄位-->
                   <input type="text" name="createdDate" value="<?php echo date('Y-m-d H:i:s'); ?>">
                  <button type="submit" class="btn btn-primary">送出</button>
                   <a href="list.php" class="btn btn-primary">返回</a>
                </div>
              </div>
            </form>
          </div>
        </div>
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
</body>
</html>
