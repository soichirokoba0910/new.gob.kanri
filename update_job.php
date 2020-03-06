<?php
  $user = 'test';
  $pass = 'sakiyama0910';
  try{
    if(empty($_POST['id'])) throw new Exception('Error');
    $dbh = new PDO('mysql:host=localhost;dbname=manabiya;charset=utf8', $user, $pass);
    $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "UPDATE jobs SET title = ?, month= ?, day = ?, start = ?, end = ?, place = ?,content = ?, importance = ? WHERE id = ?";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(1,$_POST['title'],PDO::PARAM_STR);
    $stmt->bindValue(2,(int)$_POST['month'],PDO::PARAM_INT);
    $stmt->bindValue(3,(int)$_POST['day'],PDO::PARAM_INT);
    $stmt->bindValue(4,$_POST['start'],PDO::PARAM_STR);
    $stmt->bindValue(5,$_POST['end'],PDO::PARAM_STR);
    $stmt->bindValue(6,$_POST['place'],PDO::PARAM_STR);
    $stmt->bindValue(7,$_POST['content'],PDO::PARAM_STR);
    $stmt->bindValue(8,(int)$_POST['importance'],PDO::PARAM_INT);
    $stmt->bindValue(9,(int)$_POST['id'],PDO::PARAM_INT);
    $stmt->execute();   
    $dbh = null; 
    echo "ID:" . htmlspecialchars($_POST['title'],ENT_QUOTES,'UTF-8')."の更新が完了しました";
  } catch (Exception $e) {
    echo "エラー発生: " .htmlspecialchars($e->getMessage(),ENT_QUOTES,'UTF-8')."<br>";
    die();
  }
  echo '<a href="main_job.php">戻る</a>'
?>
