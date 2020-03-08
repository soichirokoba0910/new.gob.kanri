<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>アカウント削除</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <form method="POST">
    本当に削除しますか？
    <br>
    <input type="radio" name="delete" value="1">YES
    <input type="radio" name="delete" value="2" checked>NO
    <br>
    <input class="bottan"   type="submit"  name="submit" value="送信">
  </form>
  <?php
    if(!$_POST){
      echo '<a href="main_job.php">戻る</a>';
    }
     if($_POST){
       if($_POST['delete'] == 1){
        $user ='jobtest1';
        $pass ='sakiyama0910';
        try{

          session_start();

          $dbh = new PDO('mysql:host=localhost;dbname=manabiya;charset=utf8', $user,$pass);
          $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
          $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $sql ="DELETE FROM new_pepole WHERE id=?";
          $stmt =$dbh->prepare($sql);
          $stmt ->bindValue('1',$_SESSION['nameid'],PDO::PARAM_STR);
          $stmt->execute();
//////////////////////////////////////////////////ID削除完了////////////////////////////////////
          $sql ="SELECT * FROM enter";
          $stmt = $dbh->query($sql);
          while ($result = $stmt->fetch(PDO::FETCH_ASSOC)){
            if($result['name_id'] == $_SESSION['nameid']){
              $sql ="DELETE FROM enter WHERE name_id=?";
              $stmt =$dbh->prepare($sql);
              $stmt ->bindValue('1',$_SESSION['nameid'],PDO::PARAM_STR);
              $stmt->execute();
            }
          }
////////////////////////////////////////
          $sql ="SELECT * FROM no_enter";
          $stmt = $dbh->query($sql);
          while ($result = $stmt->fetch(PDO::FETCH_ASSOC)){
            if($result['name_id'] == $_SESSION['nameid']){
              $sql ="DELETE FROM no_enter WHERE name_id=?";
              $stmt =$dbh->prepare($sql);
              $stmt ->bindValue('1',$_SESSION['nameid'],PDO::PARAM_STR);
              $stmt->execute();
            }
          }
//////////////////////////////////////
          $sql ="SELECT * FROM unkonow";
          $stmt = $dbh->query($sql);
          while ($result = $stmt->fetch(PDO::FETCH_ASSOC)){
            if($result['name_id'] == $_SESSION['nameid']){
              $sql ="DELETE FROM unkonow WHERE name_id=?";
              $stmt =$dbh->prepare($sql);
              $stmt ->bindValue('1',$_SESSION['nameid'],PDO::PARAM_STR);
              $stmt->execute();
            }
          }
///////////////////////////////////
          echo "ID:".$_SESSION['nameid'].'を削除しました';
          $_SESSION = array ();
          if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        @session_destroy(); 
          echo "<br>";
          echo '<a href ="new_peple.php"> 新規登録画面へ</a>';
          $dbh =null;
        } catch(PDOException $e){
          echo '接続エラー' . $e->getMessage();
        }    
      }
      else{
        echo '<a href="main_job.php">仕事登録画面へ戻る</a>';
      }
    }
  ?>
</body>
</html>
