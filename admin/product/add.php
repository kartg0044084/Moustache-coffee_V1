<?php
 require_once('../../connection/database.php');
  // 圖片上傳語法
 if(isset($_FILES['picture']['name']) && $_FILES['picture']['name'] != null){
    if (!file_exists('../../uploads/products')) mkdir('../../uploads/products', 0755, true);
        $path = $_FILES['picture']['name'];
    //取得副檔名
    $ext = pathinfo($path, PATHINFO_EXTENSION);
    //重新命名, 2位數加時間
    $filename = rand(10,100).date('His').".".$ext;
    move_uploaded_file($_FILES['picture']['tmp_name'],"../../uploads/products/".$filename);   // 搬移上傳檔案
  }

 if(isset($_POST['MM_insert']) && $_POST['MM_insert'] == "INSERT"){
   // 此處容易忘記
   $sql= "INSERT INTO product(picture, name, price, remain, description, product_categoryID) VALUES ( :picture, :name, :price, :remain, :description, :product_categoryID)";
   $sth = $db ->prepare($sql);
   $sth ->bindParam(":picture", $filename, PDO::PARAM_STR);
   $sth ->bindParam(":name", $_POST['name'], PDO::PARAM_STR);
   $sth ->bindParam(":price", $_POST['price'], PDO::PARAM_INT);
   $sth ->bindParam(":remain", $_POST['remain'], PDO::PARAM_STR);
   $sth ->bindParam(":description", $_POST['description'], PDO::PARAM_STR);
   $sth ->bindParam(":product_categoryID", $_POST['product_categoryID'], PDO::PARAM_INT);
   $sth -> execute();

   header("Location: list.php?product_categoryID=".$_POST['product_categoryID']);
 }
 ?>

<html><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script src="../js/validator.min.js"></script>
    <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="..\css\admin.css" rel="stylesheet" type="text/css">
  </head><body>
      <?php include_once('../template/nav.php'); ?>
    <div class="section">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center">
            <h1 class="text-left">產品管理</h1>
          </div>
        </div>
      </div>
    </div>
    <div class="section">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <ul class="breadcrumb">
              <li>
                <a href="#">主控台</a>
              </li>
              <li>
                <a href="#">產品管理</a>
              </li>
              <li class="active">新增一筆</li>
            </ul>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <hr>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <form class="form-horizontal" role="form" data-toggle="validator" action="add.php" method="POST" enctype="multipart/form-data"> <!-- enctype="multipart/form-data" 為圖片上傳必要格式-->
              <!-- 此處容易忘記 -->
              <div class="form-group">
                <div class="col-sm-2">
                  <label for="picture" class="control-label">產品圖片</label>
                </div>
                <div class="col-sm-10">
                  <input type="file" class="form-control" id="picture" name="picture" data-error="請輸入字元" required>
                  <div class="help-block"></div>
                </div>
              </div>

              <div class="form-group">
                <div class="col-sm-2">
                  <label for="name" class="control-label">產品名稱</label>
                </div>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="name" name="name" data-error="請輸入字元" required>
                  <div class="help-block"></div>
                </div>
              </div>

              <div class="form-group">
                <div class="col-sm-2">
                  <label for="price" class="control-label">價格</label>
                </div>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="price" name="price" data-error="請輸入字元" required>
                  <div class="help-block"></div>
                </div>
              </div>

              <div class="form-group">
                <div class="col-sm-2">
                  <label for="remain" class="control-label">保存期限</label>
                </div>
                <div class="col-sm-10">
                  <input type="date" class="form-control" id="remain" name="remain" data-error="請輸入字元" required>
                  <div class="help-block"></div>
                </div>
              </div>

              <div class="form-group">
                <div class="col-sm-2">
                  <label for="description" class="control-label">商品說明</label>
                </div>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="description" name="description" data-error="請輸入字元" required>
                  <div class="help-block"></div>
                </div>
              </div>

              <div class="col-sm-10 col-sm-offset-2 text-right">
                  <input type="hidden" name="product_categoryID" value="<?php echo $_GET['product_categoryID']; ?>">
                  <input type="hidden" name="MM_insert" value="INSERT">
                  <input type="hidden" name="createdDate" value="<?php echo date('Y-m-d H:i:s'); ?>">
                  <button type="submit" class="btn btn-primary">送出</button>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <footer class="section section-primary">
      <div class="container">
        <div class="row">
          <div class="col-sm-6">
            <h1>聖保羅廚房</h1>
            <p contenteditable="true">版權所有 © 2016 &nbsp; St Paul Kitchen All Right Reserved.</p>
          </div>
        </div>
      </div>
    </footer>

</body></html>
