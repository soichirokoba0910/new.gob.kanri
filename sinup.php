  
<?php
 $usr ="test";
 $pass ="sakiyama0910";

 try{
  $dbh=new PDO('mysql:host=localhost;dbname=manabiya;charset=utf8', $usr, $pass);
  $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch(PDOException $e){
  echo '接続エラー' . $e->getMessage();
  }
?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <title>ログインページ</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <h1>ログイン</h1>
    <form action="login.php" method="POST">
      会員ＩＤ:<input type="text" name="id" value="">
      <br>
      パスワード:<input type="password" name="pass" value="">
      <br>
      <input type="submit" name="submit" value="ログイン" class="bottan">
      <input type="reset" name="reset" value="取り消し" class="bottan">
    </form>
    <h6>まだ登録してない方は<a href="new_peple.php">こちら</a></h6>
  </body>
</html>
