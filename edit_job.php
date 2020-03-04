<?php
  $user = 'test';
  $pass = 'sakiyama0910';
  try{
    if(empty($_GET['id'])) throw new Exception('Error');
    $id = (int) $_GET['id'];
    $dbh = new PDO('mysql:host=localhost;dbname=manabiya', $user, $pass);
    $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM jobs WHERE id= ?";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(1,$id,PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);    
    $dbh = null; 
  } catch (Exception $e) {
    echo "エラー発生: " .htmlspecialchars($e->getMessage(),ENT_QUOTES,'UTF-8')."<br>";
    die();
  }
?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <title>仕事の再新</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <h1>仕事の再新</h1>
    <form method="POST" action= "update_job.php">
      <a>タイトル</a>
     <input type="text" name="title" value="<?php  echo $result['title'];?>" maxlength="11" size="11">
     <br>
     <a>予定日:</a>
     <input type="number" name="month" value="<?php  echo $result['month'] ;?>" max="12" min="1">月
     <input type="number" name="day" value="<?php  echo $result['day']; ?>" max="31" min="1">日
     <br>
     <a>予定時間:</a>
     <input type="time" name="start" value="<?php echo $result['start']; ?>">～
     <input type="time" name="end" value="<?php echo $result['end']; ?>">
     <br>
     <a>場所:</a>
     <input type="text" name="place" value="<?php  echo $result['place']; ?>" size="11" max="11">
     <br>
    <a>会議内容:</a><br>
    <textarea rows="4" cols="40" name="content">
      <?php  echo $result['content'] ?>
    </textarea>
    <br>
    <a>重要度</a>
    <input type="radio" name="importance" value="5" <?php  if($result['importance'] === 5) echo "checked" ?>>5
    <input type="radio" name="importance" value="4" <?php  if($result['importance'] === 4) echo "checked" ?>>4
    <input type="radio" name="importance" value="3" <?php  if($result['importance'] === 3) echo "checked" ?>>3
    <input type="radio" name="importance" value="2" <?php  if($result['importance'] === 2) echo "checked" ?>>2
    <input type="radio" name="importance" value="1" <?php  if($result['importance'] === 1) echo "checked" ?>>1
    <br>
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <input type="submit" name="submit" value="保存" class="bottan">
    <input type="reset" name="reset" value="リセット" class="bottan">
    </form> 
  </body>
</html>
