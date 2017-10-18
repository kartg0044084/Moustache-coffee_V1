<?php
require_once('../../connection/database.php');
$sth=$db->query('SELECT*FROM product_category');
$categories=$sth->fetchAll(PDO::FETCH_ASSOC);
 ?>
<html><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="..\css\admin.css" rel="stylesheet" type="text/css">
  </head><body>
    <?php include_once('../template/nav.php'); ?>
    <div class="section">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center">
            <h1 class="text-left">產品分類管理</h1>
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
                <a href="#" class="active">產品分類管理</a>
              </li>
            </ul>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
             <a href="add.php" class="btn btn-default">新增一筆</a>
            <hr>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <table class="table">
              <thead>
                <tr>
                  <th>編號</th>
                  <th>分類名稱</th>
                  <th>圖片名稱</th>
                  <th>編輯</th>
                  <th>刪除</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($categories as $row){ ?>
                <tr>
                  <td><?php echo $row['product_categoryID']; ?></td>
                  <td><a href="../product/list.php?product_categoryID=<?php echo $row['product_categoryID']; ?>"><?php echo $row['category']; ?></a></td>
                  <td></td>
                  <td><a href="edit.php?product_categoryID=<?php echo $row['product_categoryID']; ?>" >編輯</a></td>
                  <td><a href="delete.php?product_categoryID=<?php echo $row['product_categoryID']; ?>" onclick="if(!confirm('是否刪除此筆資料？')){return false;};" class="btn btn-default">刪除</a></td>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="section">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center">
            <ul class="pagination">
              <li>
                <a href="#">上一頁</a>
              </li>
              <li>
                <a href="#">1</a>
              </li>
              <li>
                <a href="#">2</a>
              </li>
              <li>
                <a href="#">3</a>
              </li>
              <li>
                <a href="#">4</a>
              </li>
              <li>
                <a href="#">5</a>
              </li>
              <li>
                <a href="#">下一頁</a>
              </li>
            </ul>
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


</body></html>
