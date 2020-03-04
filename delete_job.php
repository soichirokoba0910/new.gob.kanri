<?php
   $user ='jobtest1';
   $pass ='sakiyama0910';
 
   try{
     $dbh = new PDO('mysql:host=localhost;dbname=manabiya;charset=utf8', $user,$pass);
     $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
     $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
   } catch(PDOException $e){
     echo '接続エラー' . $e->getMessage();
   }
  $sql ="DELETE FROM jobs WHERE id=?";
  $stmt =$dbh->prepare($sql);
  $stmt ->bindValue('1',$_GET['id'],PDO::PARAM_INT);
  $stmt->execute();
  if($sql){
    echo "ID:".$_GET['id'].'を削除しました';
  }
  $dbh =null;
?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <title>新規登録結果</title>
  </head>
  <body><a href="main_job.php">戻る</a></body>
</html>
