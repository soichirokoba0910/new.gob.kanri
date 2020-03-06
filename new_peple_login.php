<?php
 $usr ="test";
 $pass ="sakiyama0910";

 try{
  $dbh=new PDO('mysql:host=localhost;dbname=manabiya;charset=utf8', $usr, $pass);
  $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

 } catch (PDOException $e) {
   echo "接続エラー:".$e->getMessage();
 }
 ?>
 <!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <title>登録結果</title>
    <link rel="stylesheet" href="style.css">
  </head>
<?php
    function return1(){
      echo '<a href="new_peple.php">戻る</a>';
    }

   if(empty($_POST['name'])){
     echo '<p>※名前を入力してください</p>';
     return1();
     return false;
   }
   if(empty($_POST['mail'])){
     echo "<p>※メールアドレスを入力してください</p>";
     return1();
     return false;
   } elseif (!$email = filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
    echo '<p>※メールアドレスが不正です。</p>';
    return1();
    return false;
  }
   if(empty($_POST['birth'])){
     echo "<p>※生年月日を入力してください</p>";
     return1();
     return false;
   }
   if(empty($_POST['id'])){
     echo "<p>※会員IDを入力してください</p>";
    return1();
    return false;
   }
   if(empty($_POST['pass1'])||empty($_POST['pass2'])){
     echo "<p>※パスワードを入力してください</p>";
     return1();
     return  false;
   } elseif(!($_POST['pass1']==$_POST['pass2'])){
     echo "<p>※パスワードが異なります</p>";
     return1();
     return false;
   }
   if (preg_match('/\A(?=.*?[a-z])(?=.*?\d)[a-z\d]{8,100}+\z/i', $_POST['pass1'])) {
    $password = password_hash($_POST['pass1'], PASSWORD_DEFAULT);
  } else {
    echo '<p>※パスワードは半角英数字をそれぞれ1文字以上含んだ8文字以上で設定してください</p>';
    return1();
    return false;
  }

  $sql ="INSERT INTO new_pepole(name,mail,birth,id,pass) VALUES (:name,:mail,:birth,:id,:pass)";
  $stmt =$dbh->prepare($sql);
  $stmt->bindValue(':name',$_POST['name'],PDO::PARAM_STR);
  $stmt->bindValue(':mail',$_POST['mail'],PDO::PARAM_STR);
  $stmt->bindValue(':birth',$_POST['birth'],PDO::PARAM_STR);
  $stmt->bindValue(':id',$_POST['id'],PDO::PARAM_STR);
  $stmt->bindValue(':pass',$_POST['pass1'],PDO::PARAM_STR);  
  $stmt->execute(); 
 $stmt->execute(); 
 session_start();
 session_regenerate_id(true); 
 $_SESSION['name'] = $_POST['name'];
  echo "登録が完了しました";

?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <title>登録結果</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body><a href="main_job.php">仕事登録ページへ</a></body>
</html>
