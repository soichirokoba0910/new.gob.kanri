<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <title>新規登録</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <h1>新規登録票</h1>
    <form method="POST" action= "new_job.php">
      <a>タイトル</a>
     <input type="text" name="title" value="" maxlength="11" size="11">
     <br>
     <a>予定日:</a>
     <input type="number" name="month" value="" max="12" min="1">月
     <input type="number" name="day" value="" max="31" min="1">日
     <br>
     <a>予定時間:</a>
     <input type="time" name="start" value="">～
     <input type="time" name="end" value="">
     <br>
     <a>場所:</a>
     <input type="text" name="place"  value=""  size="11" max="11">
     <br>
    <a>会議内容:</a><br>
    <textarea rows="4" cols="40" name="content"></textarea>
    <br>
    <a>重要度</a>
    <input type="radio" name="importance" value="5">5
    <input type="radio" name="importance" value="4">4
    <input type="radio" name="importance" value="3">3
    <input type="radio" name="importance" value="2">2
    <input type="radio" name="importance" value="1">1
    <br>
    <input type="hidden" name="id" value="">
    <input type="submit" name="submit" value="保存" class="bottan">
    <input type="reset" name="reset" value="リセット" class="bottan">
    </form> 
    <a href="main_job.php">戻る</a>
  </body>
</html>
