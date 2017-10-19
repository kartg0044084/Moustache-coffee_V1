<?php
require_once('../connection/database.php');
$limit=4;
// 判斷目前第幾頁，若沒有page參數就預設為1
if (isset($_GET["page"])) {$page = $_GET["page"]; } else {$page=1; };
// 計算要從第幾筆開始
$start_from = ($page-1) * $limit;
$sth=$db->query("SELECT*FROM news ORDER BY publishedDate DESC LIMIT ".$start_from.",". $limit);
$news=$sth->fetchAll(PDO::FETCH_ASSOC);
$sth2=$db->query("SELECT*FROM news ORDER BY publishedDate DESC");
$latest_news=$sth2->fetch(PDO::FETCH_ASSOC);
$totalRows = count($news);
 ?>
<!doctype html>
<!-- Website template by freewebsitetemplates.com -->
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>blog - Cake House</title>
	<?php require_once("template/files.php"); ?>
</head>
<body>
	<div id="page">
		<?php require_once("template/header.php"); ?>
		<div id="body">
			<div class="header">
				<div>
					<h1>最新消息</h1>
				</div>
			</div>
			<div class="blog">
				<div class="featured">
					<ul>
						<?php foreach($news as $row){ ?>
						<li>
							<div>
								<h1><?php echo $row['title'] ?></h1>
								<span><?php echo $row['publishedDate'] ?></span>
								<!-- echo mb_substr函式 宣告字串0~100結束 顯示 -->
								<p><?php echo mb_substr( $row['content'],0,100,"utf-8")."..."; ?></p>
								<a href="singlepost.php?newsID=<?php echo $row['newsID'];?>" class="more">Read More</a>
							</div>
						</li>
					<?php } ?>
					</ul>
					<a href="news.php" class="load">Load More</a>
				</div>
				<div class="sidebar">
          <h1>最新消息</h1>
					<h2><?php echo $latest_news['title'] ?></h2>
					<span><?php echo $latest_news['publishedDate'] ?></span>
					<p><?php echo $latest_news['content'] ?></p>
					<a href="singlepost.php?newsID=<?php echo $latest_news['newsID'];?>" class="more">Read More</a>
				</div>
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
                  <a href="news.php?page=<?php echo $page-1;?>">上一頁</a>
                </li>
                <?php }else{ ?>
                  <li>
                    <a href="#">上一頁</a>
                  </li>
                  <?php } ?>
              <?php for ($i=1; $i<=$total_pages; $i++) { ?>

              <li>
                <a href="news.php?page=<?php echo $i;?>"><?php echo $i;?></a>
              </li>
              <?php } ?>
              <?php if($page < $total_pages){ ?>
              <li>
                <a href="news.php?page=<?php echo $page+1;?>">下一頁</a>
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
		<?php require_once("template/footer.php"); ?>
	</div>
</body>
</html>
