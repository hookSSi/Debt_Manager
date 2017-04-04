<!DOCTYPE html>
<?php
require_once("./class/db_class.php");
require_once("./class/account_class.php");

$isLoggedin = false;
$userRow = null;

if(isset($_COOKIE['user_id']) && isset($_COOKIE['user_password']) && isset($_COOKIE['user_permission'])) {
  $db_manager = new DB_Manager();

  $Account = new Account($db_manager->pdo);

  $userRow = $Account->login($_COOKIE['user_id'], $_COOKIE['user_password']);

  if($userRow == null){
    $isLoggedin = false;
  }
  else if($userRow['permission'] === 'normal' || $userRow['permission'] === 'admin'){
    $isLoggedin = true;
  }
}
?>

<html>
  <head>
    <meta charset="utf-8">
    <title>
      <?php
        if($isLoggedin){
          echo($userRow['user_id']);
        }
        else{
          header("./login-page.php");
        }
      ?>
    </title>
  </head>
  <body>
    <div class ="wrapper">
      <div class = "container">
        <div class="header">

        </div>
        <div class="center">
          <ul class = "option-list">
            <li><a href="#빌리기">빌리기</a></li>
            <li><a href="#갚기">갚기</a></li>
            <li><a href="#이모티콘">이모티콘</a></li>
          </ul>
          <ul class = "name-list">

          </ul>
        </div>
        <div class="footer">

        </div>
      </div>
    </div>
  </body>
</html>
