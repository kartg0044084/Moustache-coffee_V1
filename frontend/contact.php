<?php
require_once('../connection/database.php');
if(isset($_POST['MM_insert']) && $_POST['MM_insert'] == "INSERT"){
$to      = "kartg0044084@gmail.com";

  		$header  = 'Content-type: text/html; charset=iso-8859-1'."\r\n";
  		$header .= "From: kartg0044084@gmail.com";

  		$subject = "[Moustache coffee] 客戶意見";
  		$body    = "您有一封來自 Moustache coffee 公司的客戶意見,<br><br>";
  		$body   .= "內容如下<br>";
  		$body   .= "<table>
                    <tr><td>公司名稱:</td><td>Moustache coffee</td></tr>
                    <tr><td>聯絡人:</td><td>".$_POST['name']."</td></tr>
                    <tr><td>聯絡電話:</td><td>".$_POST['phone']."</td></tr>
                    <tr><td>E-mail:</td><td>".$_POST['email']."</td></tr>
                    <tr><td>詢問內容:</td><td>".$_POST['content']."</td></tr>
										<tr><td>時間:</td><td>".$_POST['createdDate']."</td></tr>
                    </table><br>";
  		$body   .= "請您盡快與客戶聯繫";

  		mail($to, $subject, $body, $header);
}
 ?>
 <script>
 $(function(){
	 $('#submit').click(function(){
		 alert("感謝你的寶貴意見");
	 });
 });
 </script>
<!doctype html>
<!-- Website template by freewebsitetemplates.com -->
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>contact - Cake House</title>
	<?php require_once("template/files.php"); ?>
</head>
<body>
	<div id="page">
		<?php require_once("template/header.php"); ?>
		<div id="body" class="contact">
			<div class="header">
				<div>
					<h1>Contact</h1>
				</div>
			</div>
			<div class="body">
				<div>
					<div>

						<h1>UNIT 0123 , ABC BUILDING, BUSSINESS PARK</h1>
						<p>If you're having problems editing this website template, then don't hesitate to ask for help on the Forums.</p>
					</div>
				</div>
			</div>
			<div class="footer">
				<div class="contact">
					<h1>聯絡我們</h1>
					<form class="form-horizontal" role="form" data-toggle="validator" action="contact.php" method="POST">
						<input type="text" id="name" name="name" value="name" onblur="this.value=!this.value?'Name':this.value;" onfocus="this.select()" onclick="this.value='';">
						<input type="phone" id="phone" name="phone" value="phone" onblur="this.value=!this.value?'Name':this.value;" onfocus="this.select()" onclick="this.value='';">
						<input type="email" id="email" name="email" value="email" onblur="this.value=!this.value?'Email':this.value;" onfocus="this.select()" onclick="this.value='';">
						<textarea type="text" id="content" name="content" cols="50" rows="7">請輸入您寶貴的意見</textarea>
						<input type="text" id="createdDate" name="createdDate" value="<?php echo date('Y-m-d H:i:s'); ?>">
						<input type="hidden" name="MM_insert" value="INSERT"> <!--form表單隱藏欄位-->
						<input type="submit" value="Send" id="submit">
					</form>
				</div>
				<div class="section">
					<h1>WE’D LOVE TO HEAR FROM YOU.</h1>
					<p>If you're having problems editing this website template, then don't hesitate to ask for help on the Forums.</p>
				</div>
			</div>
		</div>
		<?php require_once("template/footer.php"); ?>
	</div>
</body>
</html>
