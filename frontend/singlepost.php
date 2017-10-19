<?php
require_once('../connection/database.php');
$sth=$db->query("SELECT*FROM news WHERE newsID=".$_GET['newsID']);
$news=$sth->fetch(PDO::FETCH_ASSOC);
$sth2=$db->query("SELECT*FROM news ORDER BY publishedDate DESC");
$latest_news=$sth2->fetch(PDO::FETCH_ASSOC);

?>
<!doctype html>
<!-- Website template by freewebsitetemplates.com -->
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>singlepost - Cake House</title>
	<?php require_once("template/files.php"); ?>
</head>
<body>
	<div id="page">
		<?php require_once("template/header.php"); ?>
		<div id="body">
			<div class="header">
				<div>
					<h1>Single Post</h1>
				</div>
			</div>
			<div class="singlepost">
				<div class="featured">
					<h1><?php echo $news['title']; ?></h1>
					<span><?php echo $news['publishedDate']; ?></span>
					<p><?php echo $news['content']; ?></p>
					<a href="news.php" class="load">back to blog</a>
				</div>
				<div class="sidebar">
					<h1>最新消息</h1>
					<h2><?php echo $latest_news['title']; ?></h2>
					<span><?php echo $latest_news['publishedDate']; ?></span>
					<p><?php echo $latest_news['content']; ?></p>
					<a href="singlepost.php?newsID=<?php echo $latest_news['newsID'];?>" class="more">Read More</a>
				</div>
			</div>
		</div>
		<?php require_once("template/footer.php"); ?>
	</div>
</body>
</html>
