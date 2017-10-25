<?php
session_start();
    //  print_r($_SESSION['cart']);
    // unset($_SESSION['cart']);

require_once('../connection/database.php');
$sth2=$db->query("SELECT * FROM product WHERE productID=".$_GET['productID']." ORDER BY createdDate DESC");
$product=$sth2->fetch(PDO::FETCH_ASSOC);
 ?>
<!doctype html>
<!-- Website template by freewebsitetemplates.com -->
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>product - Cake House</title>
	<?php require_once("template/files.php"); ?>
	<link rel="stylesheet" href="../assets/css/cart.css">
	<script type="text/javascript" src="../assets/js/jquery.js"></script>

	<script type="text/javascript">
		$(function () {
			$('.quantity-button').click(function () {
        // 找到fa-plus就+1,找到fa-minus就-1
        var quantity = 1;
        quantity = $('input[name="quantity"]').val();
        if($(this).find('i').hasClass('fa-plus')){
          quantity++;
          console.log("加數量="+quantity);
        }else {
          if(quantity >1) quantity--;
          // 判斷數量是否大於一才減一
          console.log("減數量="+quantity);
        }
        $('input[name="quantity"]').val(quantity);
			});
		});
	</script>
<?php
  if (isset($_GET['Existed']) && $_GET['Existed'] != null) {
    if ($_GET['Existed'] == 'true') {
      echo "<script>alert('此商品已存在購物車，請至我的購物車修改數量。')</script>";
    }else{
        echo "<script>alert('成功加入購物車')</script>";
    }
  }
 ?>
</head>
<body>
	<div id="page">
		<?php require_once("template/header.php"); ?>
		<div id="body">
			<div class="header">
				<div>
					<h1>產品介紹</h1>
				</div>
			</div>
			<div class="wrapper">
				<ol class="breadcrumb">
				  <li><a href="../index.php"><i class="fa fa-home" aria-hidden="true"></i></a></li>
				  <li><a href="#">蛋糕</a></li>

          <form data-toggle="validator" action="add_cart.php" method="post">

				  <li class="active"><?php echo $product['name']; ?></li>

				</ol>
				<div id="Product">

					<div class="content-left">
					</div>
					<div class="content-right">
						<h2><a href="#"><img src="../uploads/products/<?php echo $product['picture'];?>" alt=""></a></h2>
						<form class="" action="add_cart.php" method="post">
							<table id="ProductTable">
								<tr>
									<td width="20%">價格：</td>
									<td class="price">

										<?php echo $product['price']; ?>
									</td>
								</tr>
								<tr>
									<td>數量：</td>
									<td>
										<div class="quantity-button">
											<i class="fa fa-minus" aria-hidden="true"></i>
										</div>
										<input type="text" name="quantity" value="1">
										<div class="quantity-button">
											<i class="fa fa-plus" aria-hidden="true"></i>
										</div>
									</td>
								</tr>
								<tr>
                  <input type="hidden" name="name" value="<?php echo $product['name']; ?>">
                  <input type="hidden" name="picture" value="<?php echo $product['picture']; ?>">
                  <input type="hidden" name="price" value="<?php echo $product['price']; ?>">
                  <input type="hidden" name="productID" value="<?php echo $product['productID']; ?>">
                    <input type="hidden" name="quantity" value="<?php echo $product['quantity']; ?>">
									<td colspan="2"><input type="submit" class="cart" value="加入購物車"></td>
								</tr>
							</table>
						</form>
					</div>
					<div class="clearboth"></div>
					<hr>
					<p>商品說明</p>
          <?php echo $product['description']; ?>
				</div>
			</div>
		</div>
		<?php require_once("template/footer.php"); ?>
	</div>
</body>
</html>
