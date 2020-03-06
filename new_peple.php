<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <title>新規登録ページ</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <h1>新規登録ページ</h1>
    <?php  //他に必要か？　いらないものある？?>
    <form action="new_peple_login.php" method="POST" >
    名前:<input type="text" name="name" value="<?php  if(!empty($_POST['name']))  echo $_POST['name'] ; ?>">
    <br>
    メールアドレス:<input type="text" name="mail" value="<?php  if(!empty($_POST['mail']))  echo $_POST['mail'] ;?>">
    <br>
    生年月日:<input type="date" name="birth" value="<?php if(!empty($_POST['birth'])) echo $_POST['birth'];?>">
    <br>
    <?php //IDとパスは何桁が望ましい？　パス2個目は確認用 ?>
    会員ID:<input type="text" name="id" value="<?php if(!empty($_POST['id'])) echo $_POST['id'];?>">
    <br>
    パスワード:<input type="password" name="pass1" value="">
    <br>
    確認用パスワード:<input type="password" name="pass2" value="">
    <p>※パスワードは半角英数字をそれぞれ1文字以上含んだ8文字以上で設定してください</p>
    <input type="submit" name="submit" value="登録する" class="bottan">
    <input type="reset" name="reset" value="取り消し" class="bottan">
    </form>
  </body>
</html>
