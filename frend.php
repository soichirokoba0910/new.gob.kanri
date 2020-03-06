<?php
  $user ='test';
  $pass ='sakiyama0910';
  if(isset($_GET['id'])){
  try{
    $id =(int)$_GET['id'];
    session_start();
    $_SESSION['id'] =$id;
    $dbh = new PDO('mysql:host=localhost;dbname=manabiya;charset=utf8', $user,$pass);
    $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM jobs WHERE id= ?";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(1,$_GET['id'],PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);     
    } catch(PDOException $e){
       echo '接続エラー' . $e->getMessage();
    }
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>仕事関係者</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <h1><?php  if(isset($_GET['id']))   echo $result['title'] ?></h1>
    <?php
    if(isset($_GET['id'])){     
      echo '日時:'.$result['month'].'月'.$result['day'].'日&nbsp;&nbsp;&nbsp'.$result['start'].'~'.$result['end'].'<br>';
      echo '場所:'.$result['place'].'<br>';
      echo '会議内容:'.$result['content'].'<br>';
      echo '重要度:'.$result['importance'].'<br>';
      $dbh = new PDO('mysql:host=localhost;dbname=manabiya;charset=utf8', $user,$pass);
      $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      try{
        $sql="SELECT *FROM enter";
        $stmt = $dbh->query($sql);
        echo '<p>参加者一覧</p>';
        $enter=0;
        $i=0;
        foreach($stmt as $row){
            if($row['id']==$_SESSION['id']){
              $result[$_SESSION['id']][$i] =$row['name'];
              $i++;
            }
        }

        if(!empty($result[$_SESSION['id']])){
        for($i=0;$i<count($result[$_SESSION['id']]);$i++) {
          echo $result[$_SESSION['id']][$i].'<br>';
          $enter++;
        } 
      }
        echo '計'.$enter.'人';
      } catch(PDOException $e){
        print('接続失敗:' . $e->getMessage());
        die();
      }
    }
    ?>
    <form action="frend.php" method="POST">
      <input type="radio" name="entry" value="1"  <?php if($_POST){if($_POST['entry'] === 1) echo  "checked"; } ?>>参加
      <input type="radio" name="entry" value="2"  <?php if($_POST){if($_POST['entry'] === 2) echo  "checked"; }?>>不参加
      <input type="radio" name="entry" value="3"  <?php if($_POST){if($_POST['entry'] === 3) echo  "checked"; }?>>不明 
      <br>
      <input  class="bottan" type="submit" value="送信">
      <input  class="bottan" type="reset"  value="取り消し">
    </form>
    <?php
      if($_POST){
        if($_POST['entry']==1){
          $dbh = new PDO('mysql:host=localhost;dbname=manabiya;charset=utf8', $user,$pass);
          $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
          $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          try{
            $sql ="INSERT INTO enter(name,id) VALUES (:name,:id)";
            $stmt =$dbh->prepare($sql);
            session_start();
            $stmt->bindValue(':name',$_SESSION['name'],PDO::PARAM_STR);
            $stmt->bindValue(':id',$_SESSION['id'],PDO::PARAM_STR);  
            $stmt->execute(); 
             echo "参加メンバーに加わりました";
             $dbh=null;
          } catch(PDOException $e){
            echo 'エラー:' .$e->getMessage();
          }
        } elseif($_POST['entry']==2) {
          echo '不参加メンバーに加わりました';
        } else {
          echo '不明です';
        }
      }
    ?>
    <br>
    <a href="main_job.php">戻る</a>
  </body>
</html>
