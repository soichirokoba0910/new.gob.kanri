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
  date_default_timezone_set('Asia/Tokyo');
  if(isset($_GET['ym'])){
    $ym = $_GET['ym'];   
  }else{
    $ym =date('Y-m');
  }

  $timestamp = strtotime($ym.'-01');
  if($timestamp === false){
    $ym = date('Y-m');
    $timestamp = strtotime($ym.'-01');
  }

  $today =date('Y-m-j');
  
  $html_title = date('Y月n月',$timestamp);

  $prev =date('Y-m',mktime(0,0,0,date('m',$timestamp)-1,1,date('Y',$timestamp)));
  $next =date('Y-m',mktime(0,0,0,date('m',$timestamp)+1,1,date('Y',$timestamp)));
  $day_count = date('t',$timestamp);

  $youbi = date('w',mktime(0,0,0,date('m',$timestamp),1,date('Y',$timestamp)));

  $weeks = [];
  $week ='';

  $week .= str_repeat('<td></td>', $youbi);
  for($day =1; $day<=$day_count;$day++,$youbi++){
   $date = $ym.'-'.$day;
   if($today == $date){
     $week .='<td class="today">' . $day;
   } else {
     $week .='<td>' .$day;
   } 
   $sql = "SELECT * FROM jobs";
   $stmt = $dbh->query($sql);
   foreach($stmt as $row){
     $city = date('Y-m-j',mktime(0,0,0,$row['month'],$row['day'],date('Y',$timestamp)));
     if($city == $date){
      $sql = "SELECT * FROM jobs";
      $stmt = $dbh->query($sql);
         $week .= '<br><p>'.$row['start'].'～'.$row['end'].'</p>';
         $week .='<p>'.$row['title'].'</p>';
         $week .='<p>'.$row['place'].'</p>';
         $week .='<p>'.$row['content'].'</p>';
     }
   }
     $week .='</td>';

     if($youbi%7==6 || $day == $day_count){
       if($day == $day_count){
         $week .=str_repeat('<td></td>',6-($youbi%7));
       }
       $weeks[] ='<tr>'.$week.'</tr>';
       $week ='';
     }
  }
?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <title>カレンダー仕事管理表トップ</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <div class ="container">
      <?php  
        session_start();
        echo '<h1>'.$_SESSION['name'].'さんの仕事内容</h1>';
      ?>
      <h3><a href="?ym=<?php echo $prev; ?>">&lt;</a><?php echo $html_title; ?><a href="?ym=<?php echo $next ; ?>">&gt;</a></h3>
      <a class="bot" href="job.php">新しい仕事の新規登録</a>
      <a class="bot" href="logout_job.php">ログアウト</a>
     <table border ="1">
       <tr><th>日にち</th><th>時間</th><th>タイトル</th><th>場所</th><th>内容</th><th>重要度</th><th>更新</th><th>削除</th></tr>
       <?php
          $sql = "SELECT * FROM jobs";
          $stmt = $dbh->query($sql);
         foreach($stmt as $row){
           echo '<tr>';
           echo '<td>'.$row['month'].'月'.$row['day'].'日</td>';
           echo '<td>'.$row['start'].'～'.$row['end'].'</td>';
           echo '<td><a href="frend.php?id='.$row['id'].'">'.$row['title'].'</a></td>';
           echo '<td><a href="https://www.google.co.jp/maps/search/'.$row['place'].'">'.$row['place'].'</a></td>';
           echo '<td>'.$row['content'].'</td>';
           echo '<td>'.$row['importance'].'</td>';
           echo '<td><a href="edit_job.php?id='.$row['id'].'">更新</a></td>';
           echo '<td><a href="delete_job.php?id='.$row['id'].'">削除</a></td>';
           echo '</tr>';
         }
       ?>
     </table>
      <table  border="1"  class="table-bordered">
        <tr class="syuu">
          <td>日</td>
          <td>月</td>
          <td>火</td>
          <td>水</td>
          <td>木</td>
          <td>金</td>
          <td>土</td>
        </tr>
        <?php
          foreach($weeks as $week){
            echo $week;
          }
        ?>
      </table>
    </div>
  </body>
</html>
