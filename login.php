<?php

      $user ='test';
      $pass ='sakiyama0910';
      
      session_start();

      try{
        $dbh = new PDO('mysql:host=localhost;dbname=manabiya;charset=utf8', $user,$pass);
        $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = 'SELECT * FROM new_pepole WHERE id = ?';
        $stmt = $dbh->prepare($sql);
        $stmt->execute([$_POST['id']]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        print('接続失敗:' . $e->getMessage());
        die();
    }
    if (!isset($row['id'])) {
        echo 'メールアドレス又はパスワードが間違っています。';
        return false;
      }
    if($_POST['id']==$row['id'] && $_POST['pass']==$row['pass']){
        session_regenerate_id(true); 
        $_SESSION['name'] = $row['name'];
        echo 'ログインされました<a href="main_job.php">仕事管理へ</a>';
    } else{
        echo 'ログイン失敗';
    }
