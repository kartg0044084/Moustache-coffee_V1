<?php
session_start();
require_once('../../connection/database.php');
$sql= "INSERT INTO customer_order(memberID, orderNO, orderDate, name, phone, mobilephone, email, address, totalprice, shipping, createdDate) VALUES ( :memberID, :orderNO, :orderDate, :name, :phone, :mobilephone, :email, :address, :totalprice, :shipping, :createdDate)";
$sth = $db ->prepare($sql);
$sth ->bindParam(":memberID", $_POST['memberID'], PDO::PARAM_INT);
$sth ->bindParam(":orderNO", $_POST['orderNO'], PDO::PARAM_STR);
$sth ->bindParam(":orderDate", $_POST['orderDate'], PDO::PARAM_STR);
$sth ->bindParam(":name", $_POST['name'], PDO::PARAM_STR);
$sth ->bindParam(":phone", $_POST['phone'], PDO::PARAM_STR);
$sth ->bindParam(":mobilephone", $_POST['mobilephone'], PDO::PARAM_STR);
$sth ->bindParam(":email", $_POST['email'], PDO::PARAM_STR);
$sth ->bindParam(":address", $_POST['address'], PDO::PARAM_STR);
$sth ->bindParam(":totalprice", $_POST['totalprice'], PDO::PARAM_INT);
$sth ->bindParam(":shipping", $_POST['shipping'], PDO::PARAM_INT);
$sth ->bindParam(":createdDate", $_POST['createdDate'], PDO::PARAM_STR);
$sth -> execute();
// 取得最新一筆customer_order的id值
$sth2 = $db->query("SELECT * FROM customer_order WHERE memberID = ".$_POST['memberID']." ORDER BY createdDate DESC");
$last_order = $sth2->fetch(PDO::FETCH_ASSOC);

//寫入訂單明細order_details
for($i = 0; $i <count($_SESSION['cart']);$i++){
$sql= "INSERT INTO order_details(customer_orderID, productID, picture, name, price, quantity, createdDate) VALUES ( :customer_orderID, :productID, :picture, :name, :price, :quantity, :createdDate)";
$sth = $db ->prepare($sql);
 $sth ->bindParam(":customer_orderID", $last_order['customer_orderID'], PDO::PARAM_INT);//寫入上頭$last_order儲存的customer_order
$sth ->bindParam(":productID", $_SESSION['cart'][$i]['productID'], PDO::PARAM_INT);
$sth ->bindParam(":picture", $_SESSION['cart'][$i]['picture'], PDO::PARAM_STR);
$sth ->bindParam(":name", $_SESSION['cart'][$i]['name'], PDO::PARAM_STR);
$sth ->bindParam(":price", $_SESSION['cart'][$i]['price'], PDO::PARAM_INT);
$sth ->bindParam(":quantity",$_SESSION['cart'][$i]['quantity'], PDO::PARAM_INT);
$sth ->bindParam(":createdDate", $_SESSION['createdDate'], PDO::PARAM_STR);
$sth -> execute();
}
unset($_SESSION['cart']);
//寄訂單完成信給會員(給管理者)之後要補程式
 ?>
<!doctype html>
<!-- Website ../template by freewebsite../templates.com -->
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Cake House-訂購成功</title>
	<?php require_once("../template/files2.php"); ?>
</head>
<body>
	<div id="page">
		<?php require_once("../template/header2.php"); ?>
		<div id="body" class="contact">
			<div class="header">
				<div>
					<h1>訂購成功</h1>
				</div>
			</div>
			<div class="body">

			</div>
			<div class="footer">
				<div id="MemberForm">

					<h3>
						您已成功訂購商品，請至「<a href="my_orders.php">我的訂單</a>」查詢訂單進度。
					</h3>
				</div>
			</div>
		</div>
		<?php require_once("../template/footer.php"); ?>
	</div>
</body>
</html>
