<?php
require_once('../template/login_check.php');
require_once('../../connection/database.php');
if(isset($_POST['MM_update']) && $_POST['MM_update'] == "UPDATE"){
  $sql= "UPDATE news SET publishedDate =:publishedDate,
            title = :title,
            content = :content,
            updatedDate = :updatedDate WHERE newsID=:newsID";
  $sth = $db ->prepare($sql);

  $sth ->bindParam(":publishedDate", $_POST['publishedDate'], PDO::PARAM_STR);
  $sth ->bindParam(":title", $_POST['title'], PDO::PARAM_STR);
  $sth ->bindParam(":content", $_POST['content'], PDO::PARAM_STR);
  $sth ->bindParam(":updatedDate", $_POST['updatedDate'], PDO::PARAM_STR);
  $sth ->bindParam(":newsID", $_POST['newsID'], PDO::PARAM_INT);
  $sth -> execute();

  header('Location: list.php');
}

$sth=$db->query("SELECT*FROM news WHERE newsID=".$_GET['newsID']);
$news=$sth->fetch(PDO::FETCH_ASSOC);
 ?>
<html>
<head>
    <meta charset="utf-8">
    <title>list</title>
    <?php include_once('../template/header.php'); ?>
  </head>
  <script type="text/javascript">
    $( function() {
    $( "#published_date" ).datepicker({
      dateFormat : "yy年mm月dd日"});
          tinymce.init({
        selector: 'textarea',
        height: 500,
        theme: 'modern',
        plugins: 'print preview fullpage powerpaste searchreplace autolink directionality advcode visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount tinymcespellchecker a11ychecker imagetools mediaembed  linkchecker contextmenu colorpicker textpattern help',
        toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',
        image_advtab: true,
        templates: [
          { title: 'Test template 1', content: 'Test 1' },
          { title: 'Test template 2', content: 'Test 2' }
        ],
        content_css: [
          '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
          '//www.tinymce.com/css/codepen.min.css'
        ]
       });
  } );
  </script>
  <body>
      <?php include_once('../template/nav.php'); ?>
    <div class="section">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center">
            <h1 class="text-left">近期活動管理</h1>
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
                <a href="#">近期活動管理</a>
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
             <form class="form-horizontal" role="form" data-toggle="validator" action="edit.php" method="POST">
              <!--action="add.php" method="POST" form使用post方式回傳到本頁add.php -->

              <div class="form-group">
                <div class="col-sm-2">
                  <label for="publishedDate" class="control-label">發佈日期</label>
                </div>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="publishedDate" name="publishedDate"  value="<?php echo $news['publishedDate'];?>" data-error="請輸入字元" required>
                  <div class="help-block"></div>
                </div>
              </div>

              <div class="form-group">
                <div class="col-sm-2">
                  <label for="title" class="control-label">標題</label>
                </div>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="title" name="title" value="<?php echo $news['title'];?>"data-error="請輸入字元" required>
                  <div class="help-block"></div>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-2">
                  <label for="content" class="control-label">內容</label>
                </div>
                <div class="col-sm-10">
                  <textarea class="form-control" id="content" name="content"><?php echo $news['content'];?></textarea>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-10 col-sm-offset-2 text-right">
                  <input type="hidden" name="newsID" value="<?php echo $news['newsID']; ?>">
                  <!-- 隱藏表單 透過 newsID 更新(由上往下跑) 完成更新 -->
                   <input type="hidden" name="MM_update" value="UPDATE"> <!--form表單隱藏欄位-->
                   <input type="text" name="createdDate" value="<?php echo date('Y-m-d H:i:s'); ?>">
                  <button type="submit" class="btn btn-primary">送出</button>
                   <a href="list.php" class="btn btn-primary">返回</a>
                </div>
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
</body>
</html>
