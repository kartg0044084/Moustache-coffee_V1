<?php
require_once('../connection/database.php');
$sth=$db->query("SELECT*FROM page");
$pages=$sth->fetchAll(PDO::FETCH_ASSOC);

$sth2=$db->query("SELECT * FROM page WHERE pageID=".$_GET['pageID']."");
$page=$sth2->fetchAll(PDO::FETCH_ASSOC);
 ?>﻿
<!doctype html>
<!-- Website template by freewebsitetemplates.com -->
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>about - Frozen Yogurt Shop</title>
	<?php include("template/files.php"); ?>
</head>
<body>
	<div id="page">
		<?php include("template/header.php"); ?>
		<div id="body">
			<div class="header">
				<div>
					<h1>關於我們</h1>
				</div>
			</div>
			<div class="body">
			</div>
			<div class="footer">
				<div class="sidebar">

					<p>
            <?php foreach($pages as $row){ ?>
						<a href="about.php?pageID=<?php echo $row['pageID']; ?>" style="text-decoration:none;">
              <?php echo $row['title']; ?></a>
          <?php } ?>
					</p>
								</div>
				<div class="article">
          <?php foreach($page as $row){ ?>
					<?php echo $row['content']; ?>
        <?php } ?>
				</div>
			</div>
		</div>
		<?php include("template/footer.php"); ?>
	</div>
</body>
</html>
