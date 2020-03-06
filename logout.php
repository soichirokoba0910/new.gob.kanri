<?php
  session_start();
  if(isset($_SESSION['name'])){
    echo 'ログアウトしました。';
  } else {
    echo 'SessionがTimeoutしました。';
  }
  $_SESSION = array ();
  if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
@session_destroy(); 
echo '<br><a href="sinup.php">ログイン</a>';
?>
