<?php
require_once('../../connection/database.php');
session_start();

if((!empty($_SESSION['check_word'])) && (!empty($_POST['checkword']))){  //判斷此兩個變數是否為空

     if($_SESSION['check_word'] == $_POST['checkword']){ //判斷此兩個變數是否相同

          $_SESSION['check_word'] = ''; //比對正確後，清空將check_word值

          $sql= "INSERT INTO member(account, password, createdDate, phone, birthday) VALUES ( :account, :password, :createdDate, :phone, :birthday)";
          $sth = $db ->prepare($sql);
          $sth ->bindParam(":account", $_POST['account'], PDO::PARAM_STR);
          $sth ->bindParam(":password", $_POST['password'], PDO::PARAM_STR);
            $sth ->bindParam(":birthday", $_POST['birthday'], PDO::PARAM_STR);
          $sth ->bindParam(":createdDate", $_POST['createdDate'], PDO::PARAM_STR);
        	$sth ->bindParam(":phone", $_POST['phone'], PDO::PARAM_STR);
          $sth -> execute();

          $to      = "kartg0044084@gmail.com";

            		$header  = 'Content-type: text/html; charset=iso-8859-1'."\r\n";
            		$header .= "From: kartg0044084@gmail.com";

            		$subject = "[Moustache coffee] 客戶意見";
            		$body    = "您有一封來自 ".$company." 公司的客戶意見,<br><br>";
            		$body   .= "恭喜加入Moustache coffee，請至<a href:'http://120.124.165.116/c/no05/Moustache-coffee_V1/frontend/member/member_login.php'>按我</a><br>";

            		mail($to, $subject, $body, $header);

     }else{
         echo '<p> </p><p> </p><a href="login_error.php">Error輸入錯誤，將於一秒後跳轉(按此也可返回)</a>';
         echo '<meta http-equiv="refresh" content="0; url=login_error.php">';
     }
}


 ?>
<!doctype html>
<!-- Website ../template by freewebsite../templates.com -->
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Cake House-會員申請</title>
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
				<div id="MemberForm">
					<h2>申請會員成功!</h2>
					<p>
						您已成功加入會員，請至 <a href="member_login.php">登入頁</a>，登入您的帳號，方可進行購物。
					</p>
				</div>
			</div>
		</div>
		<?php require_once("../template/footer.php"); ?>
	</div>
</body>
</html>
