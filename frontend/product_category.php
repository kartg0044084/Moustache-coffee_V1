<?php
require_once('../connection/database.php');

$sth=$db->query("SELECT * FROM product_category WHERE product_categoryID=".$_GET['product_categoryID']." ORDER BY createdDate DESC");
$categorie=$sth->fetchAll(PDO::FETCH_ASSOC);

$sth3=$db->query("SELECT * FROM product_category");
$categories=$sth3->fetchAll(PDO::FETCH_ASSOC);

$sth2=$db->query("SELECT * FROM product WHERE product_categoryID=".$_GET['product_categoryID']." ORDER BY createdDate DESC");
$all_product=$sth2->fetchAll(PDO::FETCH_ASSOC);
 ?>
<!doctype html>
<!-- Website template by freewebsitetemplates.com -->
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>product - Cake House</title>
	<?php require_once("template/files.php"); ?>
</head>
<body>
	<div id="page">
		<?php require_once("template/header.php"); ?>
		<div id="body">
			<div class="header">
				<div>
					<h1>Products</h1>
				</div>
			</div>
			<div class="wrapper">
				<ol class="breadcrumb">
				  <li><a href="product_no_category.php"><i class="fa fa-home" aria-hidden="true"></i></a></li>
					<?php foreach($categorie as $row){ ?>
				  <li class="active"><a href="#"><?php echo $row['category']; ?></a></li>
					<?php } ?>
				</ol>
				<ul class="Category">

					<?php foreach($categories as $row){ ?>
					<li><a href="product_category.php?product_categoryID=<?php echo $row['product_categoryID']; ?>"><?php echo $row['category']; ?></a></li>
				<?php } ?>

				</ul>
				<ul id="Products">

					<li>
						<?php foreach($all_product as $row){ ?>
						<a href="product_content.php?productID=<?php echo $row['productID']; ?>"><img src="../uploads/products/<?php echo $row['picture'];?>" width="200" height="150" alt=""></a>
						<a href="product_content.php?productID=<?php echo $row['productID']; ?>"><h2><?php echo $row['name']; ?></h2></a>
						<?php } ?>
					</li>

				</ul>
			</div>
		</div>
		<?php require_once("template/footer.php"); ?>
	</div>
</body>
</html>
