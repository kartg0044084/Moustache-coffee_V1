<?php
session_start();
  // print_r($_SESSION['cart']);
if(isset($_POST['MM_update']) && $_POST['MM_update'] == "quantityEdit"){
	$id= $_POST['cartID'];//抓取購物車編號

	// if ($_POST['quantity']<=0)$_POST['quantity'] = 1;//如傳來值<=1則自動變為一
	$_SESSION['cart'][$id]['quantity'] = $_POST['quantity'];//接收my_cart_editphp[quantity]更新資訊
}
?>
<!doctype html>
<!-- Website ../template by freewebsite../templates.com -->
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Cake House-我的購物車</title>
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
					<h1>我的購物車</h1>

						<table id="order-tables">
            	<thead>
								<?php if(isset($_SESSION['cart']) && $_SESSION['cart'] != null){ ?>
									 <?php $totalprice = 0?>  <!--宣告初始=0 -->
									<?php for ($i=0; $i <count($_SESSION['cart']) ; $i++) {//有商品在購物車時顯示 ?>
            		<tr>
            			<th width="15%">商品圖片</th>
            			<th width="30%">商品名稱</th>
									<th width="10%" class="price">單價</th>
            			<th width="10%" class="quantity">數量</th>
            			<th width="10%" class="subtotal">小計</th>
                  <th width="8%">更新</th>
                  <th width="8%">刪除</th>
            		</tr>
            	</thead>
              <tbody>

	                <tr data-toggle="collapse" data-target="#demo1" class="accordion-toggle">
										<td data-title="商品圖片">
												<a href=""><img src="../../uploads/products/<?php echo $_SESSION['cart'][$i]['picture']; ?>" alt="" width="200" height="150"></a>
										</td>
										<td class="cart_description" data-title="商品名稱">
												<h4><a href=""><?php echo $_SESSION['cart'][$i]['name']; ?></a></h4>
										</td>
	                  <td data-title="單價">$NT <?php echo $_SESSION['cart'][$i]['price']; ?></td>
	                  <td class="quantity" data-title="數量"><?php echo $_SESSION['cart'][$i]['quantity']; ?></td>
										<td data-title="小計">$NT <?php $totalprice = $_SESSION['cart'][$i]['price'] * $_SESSION['cart'][$i]['quantity']; echo $totalprice ?></td>
	                  <td data-title="更新">
											<a href="my_cart_edit.php?cartID=<?php echo $i?>" class="btn btn-default update" style=""><i class="fa fa-upload"></i></a>
										</td>
										<td data-title="刪除">
											<a class="btn btn-default" href="cart_delete.php?cartID=<?php echo $i?>" ><i class="fa fa-times"></i></a>
										</td>
	                </tr>

									<tr>
										<!-- <?php  $totalprice += $totalprice?>上面宣告0+小計$totalprice -->
										<td colspan="6" style="text-align: right;font-weight:bold;">運費</td>
										<td style="text-align: left;font-weight:bold;">$NT<?php if ($totalprice>=1000){ $shipping = 0;}else {$shipping= 150;}  echo $shipping; ?></td>
									</tr>
									<tr>
										<td colspan="6" style="text-align: right;font-weight:bold;">總金額</td>
										<td style="text-align: left;font-weight:bold;"><?php echo $totalprice + $shipping; ?></td>
									</tr>
									<?php } ?>
								<?php }else{//未加入商品至購物車顯示 ?>
										<td colspan="7">
											目前購物車無商品，請<a href="../product_no_category.php">前往賣場</a>選購商品。
										</td>
									<?php } ?>

									<?php if(isset($_SESSION['cart']) && $_SESSION['cart'] != null){ ?>
									<tr>
										<td colspan="7" >
												<a href="order_confirm.php" class="edit-button cart">我要結帳</a>
									</tr>
								<?php }else{//未加入商品至購物車顯示 ?>
									<tr>
										<td colspan="7" >
												<a href="../product_no_category.php" class="edit-button cart">尚未購買商品</a>
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
