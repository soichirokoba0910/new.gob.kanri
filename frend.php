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
    <link rel="stylesheet" href="style1.css">
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
        echo '<div class="hyou"><p>参加者一覧</p>';
        $enter=0;
        $i=0;
        foreach($stmt as $row){
            if($row['id']==$_SESSION['id']){
              $result[$_SESSION['id']][$i] =$row['name'];
              $i++;
            }
        }
        if(!empty($result[$_SESSION['id']])){
          $sanka='<ul>';
        for($i=0;$i<count($result[$_SESSION['id']]);$i++) {
          $sanka.='<li>'.$result[$_SESSION['id']][$i].'</li>';
          $enter++;
        } 
        $sanka.='</ul>';
        echo  $sanka;
      }
        echo '<br>計'.$enter.'人</div>';
        //ここまで参加者

        $sql="SELECT *FROM no_enter";
        $stmt = $dbh->query($sql);
        echo '<div class="hyou"><p>不参加者一覧</p>';
        $no_enter=0;
        $i=0;
        foreach($stmt as $row){
            if($row['id']==$_SESSION['id']){
              $result1[$_SESSION['id']][$i] =$row['name'];
              $i++;
            }
        }

        if(!empty($result1[$_SESSION['id']])){
          $nosanka ='<ul>';
        for($i=0;$i<count($result1[$_SESSION['id']]);$i++) {
          $nosanka.='<li>'.$result1[$_SESSION['id']][$i].'</li>';
          $no_enter++;
        } 
        $nosanka.='</ul>';
        echo   $nosanka;
      }
      echo '計'.$no_enter.'人</div>'; 
       //ここまで不参加者

       $sql="SELECT *FROM unkonow";
       $stmt = $dbh->query($sql);
       echo '<div class="hyou"><p>不明者一覧</p>';
       $unkown=0;
       $i=0;
       foreach($stmt as $row){
           if($row['id']==$_SESSION['id']){
             $result2[$_SESSION['id']][$i] =$row['name'];
             $i++;
           }
       }

       if(!empty($result2[$_SESSION['id']])){
       for($i=0;$i<count($result2[$_SESSION['id']]);$i++) {
         $humei='<ul>';
        $humei.='<li>'.$result2[$_SESSION['id']][$i].'</li>';
         $unkown++;
       } 
       $humei.='</ul>';
       echo  $humei;
     }
     echo '計'.$unkown.'人</div>'; 
     //ここまで不明者

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
        try{
        $dbh = new PDO('mysql:host=localhost;dbname=manabiya;charset=utf8', $user,$pass);
        $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if($_POST['entry']==1){
  
            $sql ="INSERT INTO enter(name,id) VALUES (:name,:id)";
            $stmt =$dbh->prepare($sql);
            session_start();
            $stmt->bindValue(':name',$_SESSION['name'],PDO::PARAM_STR);
            $stmt->bindValue(':id',$_SESSION['id'],PDO::PARAM_STR);  
            $stmt->execute(); 
             echo "参加メンバーに加わりました";
             $dbh=null;
             //参加者一覧
          
        } elseif($_POST['entry']==2) {
          $sql ="INSERT INTO no_enter(name,id) VALUES (:name,:id)";
          $stmt =$dbh->prepare($sql);
          session_start();
          $stmt->bindValue(':name',$_SESSION['name'],PDO::PARAM_STR);
          $stmt->bindValue(':id',$_SESSION['id'],PDO::PARAM_STR);  
          $stmt->execute(); 
          echo '不参加メンバーに加わりました';
           $dbh=null;
           //不参加一覧
      
        } else {
          $sql ="INSERT INTO unkonow(name,id) VALUES (:name,:id)";
          $stmt =$dbh->prepare($sql);
          session_start();
          $stmt->bindValue(':name',$_SESSION['name'],PDO::PARAM_STR);
          $stmt->bindValue(':id',$_SESSION['id'],PDO::PARAM_STR);  
          $stmt->execute(); 
          echo '不明';
           $dbh=null;
           //不明者一覧
        } 
      } catch(PDOException $e){
        print('接続失敗:' . $e->getMessage());
        die();
      }
    }
      
    ?>
    <br>
    <a href="main_job.php">戻る</a>
  </body>
</html>
