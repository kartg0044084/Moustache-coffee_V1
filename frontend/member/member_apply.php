<?php
require_once('../../connection/database.php');
  session_start();
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
<script type="text/javascript">
  function refresh_code() {
    document.getElementById('imgcode').src="captcha.php";
  }
</script>
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
					<h1>加入會員</h1>
					<div class="row">
	          <div class="col-md-12">
					<form action="apply_success.php" method="post" data-toggle="validator">
						<div class="form-group">
							<div class="col-sm-2">
								<label for="account" class="control-label">帳號</label>
							</div>
							<div class="col-sm-10">
								<input type="email" class="form-control" id="account" name="account"  style="margin-bottom:10px;" data-error="請輸入E-mail做為帳號" required>
								<div class="help-block with-errors"></div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-2">
								<label for="Password" class="control-label">密碼</label>
							</div>
							<div class="col-sm-10">
								<input type="password" class="form-control" id="password" name="password" data-minlength="6" required data-error="請輸入至少6個英文數字做為密碼">
								<div class="help-block with-errors"></div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-2">
								<label for="ConfirmPas" class="control-label">確認密碼</label>
							</div>
							<div class="col-sm-10">
								<input type="password" class="form-control" id="password" name="password" data-match="#password" data-match-error="密碼不符，請重新輸入">
								<div class="help-block with-errors"></div>
							</div>
						</div>

            <div class="form-group">
							<div class="col-sm-2">
								<label for="ConfirmPas" class="control-label">生日</label>
							</div>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="birthday" name="birthday"  data-match-error="生日不符，請重新輸入">
								<div class="help-block with-errors"></div>
							</div>
						</div>

						<div class="form-group">
							<div class="col-sm-2">
								<label for="phone" class="control-label">聯絡電話</label>
							</div>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="phone" name="phone" data-error="請輸入聯絡電話" required>
								<div class="help-block with-errors"></div>
							</div>
						</div>

            <div class="form-group">
							<div class="col-sm-2">
								<label for="phone" class="control-label">驗證碼</label>
							</div>
            <div class="form-group">
              <div class="col-sm-10">
        <input type="text" class="form-control" id="checkword" name="checkword" size="10" maxlength="10" data-error="請輸入驗證碼" required>
        <div class="help-block with-errors"></div>
        <p>請輸入下圖字樣：</p><p><img id="imgcode" src="captcha.php" onclick="refresh_code()" /><br />
           點擊圖片可以更換驗證碼
        </p>
  </div>
</div>
						<div class="form-group">
							<div class="col-sm-12 text-center" style="margin-bottom:10px;">
								<input type="checkbox" id="Agree" data-error="請勾選我同意會員條款" required>
        我同意Cake House <a href="../about.php?pageID=3" target="_blank">會員條款</a>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-12 text-center">
								<input type="hidden" class="form-control" id="CreatedDate" name="CreatedDate" value="<?php echo date("Y-m-d H:i:s"); ?>">
								<button type="submit" class="btn btn-default" style="width:200px;">確認送出</button>
							</div>
						</div>
					</form>
					<hr>
					<h1>社群登入</h1>
					<form action="apply_success.php" style="width:50%">
						<input class="facebook" type="submit" value="facebook 註冊" id="submit">
					</form>
					</div>
				</div>
				</div>

			</div>
		</div>
		<?php require_once("../template/footer.php"); ?>
	</div>
</body>
</html>
