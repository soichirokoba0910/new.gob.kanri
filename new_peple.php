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
    パスワード:<input type="password" name="pass[]" value="">
    <br>
    確認用パスワード:<input type="passward" name="pass[]" value="">
    <br>
    <input type="submit" name="submit" value="登録する" class="bottan">
    <input type="reset" name="reset" value="取り消し" class="bottan">
    </form>
    <?php
    if($_POST){
      if(empty($_POST['name'])){
        echo '<p>※名前を入力してください</p>';
      }
      if(empty($_POST['mail'])){
        echo "<p>※メールアドレスを入力してください</p>";
      }
      if(empty($_POST['birth'])){
        echo "<p>※生年月日を入力してください</p>";
      }
      if(empty($_POST['id'])){
        echo "<p>※会員IDを入力してください</p>";
      }
      if(empty($_POST['pass'][0])||empty($_POST['pass'][1])){
        echo "<p>※パスワードを入力してください</p>";
      } elseif(!($_POST['pass'][0]==$_POST['pass'][1])){
        echo "<p>※パスワードが異なります</p>";
      }
    }
    ?>
  </body>
</html>
