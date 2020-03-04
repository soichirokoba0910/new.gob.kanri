<?php
 $usr ="test";
 $pass ="sakiyama0910";

 try{
  $dbh=new PDO('mysql:host=localhost;dbname=manabiya;charset=utf8', $usr, $pass);
  $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $sql ="INSERT INTO new_pepole(name,mail,birth,id,pass) VALUES (:name,:mail,:birth,:id,:pass)";
  $stmt =$dbh->prepare($sql);
  $stmt->bindValue(':name',$_POST['name'],PDO::PARAM_STR);
  $stmt->bindValue(':mail',$_POST['mail'],PDO::PARAM_STR);
  $stmt->bindValue(':birth',$_POST['birth'],PDO::PARAM_STR);
  $stmt->bindValue(':id',$_POST['id'],PDO::PARAM_STR);
  $stmt->bindValue(':pass',$_POST['pass'][0],PDO::PARAM_STR);  
  $stmt->execute();
  if($sql){
    echo "登録が完了しました";
  }
 } catch (PDOException $e) {
   echo "接続エラー:".$e->getMessage();
 }
?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <title>登録結果</title>
  </head>
  <body><a href="#">仕事登録ページへ</a></body>
</html>
