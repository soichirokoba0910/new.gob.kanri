<?php
  $user ='test';
  $pass ='sakiyama0910';

  try{
    $dbh = new PDO('mysql:host=localhost;dbname=manabiya;charset=utf8', $user,$pass);
    $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  } catch(PDOException $e){
    echo '接続エラー' . $e->getMessage();
  }
  

  $sql = "INSERT INTO jobs(month,day,title,place,importance,start,end,content) VALUES (:month,:day,:title,:place,:importance,:start,:end,:content)";
  $stmt = $dbh->prepare($sql);
  $stmt->bindValue(':month',$_POST['month'],PDO::PARAM_INT);
  $stmt->bindValue(':day',$_POST['day'],PDO::PARAM_INT);
  $stmt->bindValue(':title',$_POST['title'],PDO::PARAM_STR);
  $stmt->bindValue(':place',$_POST['place'],PDO::PARAM_STR);
  $stmt->bindValue(':importance',$_POST['importance'],PDO::PARAM_INT);
  $stmt->bindValue(':start',$_POST['start'],PDO::PARAM_STR);
  $stmt->bindValue(':end',$_POST['end'],PDO::PARAM_STR);
  $stmt->bindValue(':content',$_POST['content'],PDO::PARAM_STR);
  $stmt->execute();
  if($sql){
    echo '登録完了しました';
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
