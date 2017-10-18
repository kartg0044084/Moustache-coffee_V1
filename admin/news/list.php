<?php 
require_once('../template/login_check.php');
require_once('../../connection/database.php');
$limit=2;
// 判斷目前第幾頁，若沒有page參數就預設為1
if (isset($_GET["page"])) {$page = $_GET["page"]; } else {$page=1; };
// 計算要從第幾筆開始
$start_from = ($page-1) * $limit;
$sth=$db->query("SELECT*FROM news ORDER BY publishedDate DESC LIMIT ".$start_from.",". $limit);
$news=$sth->fetchAll(PDO::FETCH_ASSOC);
$totalRows = count($news);
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
            <h1 class="text-left">近期活動管理</h1>
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
                <a href="#" class="active">近期活動管理</a>
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
                  <th>發布日期</th>
                  <th>新聞標題</th>
                  <th>Last Name</th>
                  <th>編輯</th>
                  <th>刪除</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($news as $row){ ?>
                <tr>
                  <td><?php echo $row['publishedDate'] ?></td>
                  <td><?php echo $row['title'] ?></td>
                  <td><?php echo $row['content'] ?></td>
                  <td><a href="edit.php?newsID=<?php echo $row['newsID'];?>">編輯</a></td>
                  <td><a href="delete.php?newsID=<?php echo $row['newsID'];?>" onclick="if(!confirm('是否刪除此筆資料？')){return false;};">刪除</a></td>
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
            $sth = $db->query("SELECT * FROM news ORDER BY PublishedDate DESC ");
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
