<?php
require_once('../../connection/database.php');
$sth=$db->query("SELECT * FROM customer_order WHERE customer_orderID=".$_GET['no']);
$customer_order=$sth->fetch(PDO::FETCH_ASSOC);

$sth2=$db->query("SELECT * FROM order_details WHERE customer_orderID=".$_GET['no']);
$order_details=$sth2->fetchAll(PDO::FETCH_ASSOC);

 ?>
<!doctype html>
<!-- Website ../template by freewebsite../templates.com -->
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Cake House-我的訂單</title>
	<?php require_once("../template/files2.php"); ?>
</head>
<body>
	<div id="page">
		<?php require_once("../template/header2.php"); ?>
		<div id="body" class="contact">
			<div class="header">
				<div>
					<h1>會員專區</h1>
				</div>
			</div>
			<div class="body">

			</div>
			<div class="footer">
				<ul class="Category">
					<li><a href="member_edit.php">會員資料修改</a></li>
					<li><a href="my_cart.php">我的購物車</a></li>
					<li><a href="my_orders.php">我的訂單</a></li>
				</ul>
				<div id="OrderForm">
					<h1>訂單編號:</h1>
					<a href="my_orders.php" class="btn btn-default" style="margin-bottom:20px;">回我的訂單</a>
						<table id="order-tables">
            	<thead>
            		<tr>
            			<th width="15%">商品圖片</th>
            			<th width="30%">商品名稱</th>
									<th width="10%" class="price">單價</th>
            			<th width="10%" class="quantity">數量</th>
            			<th width="10%" class="subtotal">小計</th>
            		</tr>
            	</thead>
              <tbody>
                <?php foreach($order_details as $row){ ?>
                <tr data-toggle="collapse" data-target="#demo1" class="accordion-toggle">
									<td data-title="商品圖片">
											<a href="../product_content.php?productID=<?php echo $row['productID']; ?>"><img src="../../uploads/products/<?php echo $row['picture']; ?>" alt="" width="200" height="150"></a>
									</td>
									<td class="cart_description" data-title="商品名稱">
											<h4><a href=""><?php echo $row['productID']; ?><?php echo $row['name']; ?></a></h4>
									</td>
                  <td data-title="單價"><?php echo $row['price']; ?></td>
                  <td data-title="數量"><?php echo $row['quantity']; ?></td>
									<td data-title="小計">$NT<?php echo $row['price'] * $row['quantity']; ?></td>
                </tr>
              <?php } ?>

              </tbody>
            </table>

				</div>

			</div>
		</div>
		<?php require_once("../template/footer.php"); ?>
	</div>
</body>
</html>
