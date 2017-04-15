<?php
require_once("./class/account_class.php");
require_once("./class/group_class.php");
require_once("./class/userinfo_class.php");

$isLoggedin = false;
$userRow = null;
$groupName = "그룹이름";

if(isset($_COOKIE['user_id']) &&
 isset($_COOKIE['user_password']) &&
  isset($_COOKIE['user_permission']) &&
   isset($_COOKIE['groupName'])) {

  $Account = new Account();
  $Group = new Group();
  $UserInfo = new UserInfo();

  $userRow = $Account->login($_COOKIE['user_id'], $_COOKIE['user_password']);

  $groupName = $_COOKIE['groupName'];
  $groupid = $Group->GetGroupId($_COOKIE['groupName']);

  $userInfoRow = $UserInfo->GetUserinfo($userRow['id'], $groupid);

  if($userRow == null){
    $isLoggedin = false;
  }
  else if($userRow['permission'] === 'normal' || $userRow['permission'] === 'admin'){
    $isLoggedin = true;
    setcookie('user_id',$userRow['user_id'],time()+(86400*30),'/');
    setcookie('user_password',$userRow['user_password'],time()+(86400*30),'/');
    setcookie('user_permission', $userRow['permission'],time()+(86400*30),'/');
    setcookie('groupName', $groupName, time()+(86400*30),'/');
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
    <link rel="stylesheet" type="text/css" href="./css/font-awesome.css">
  	<link rel="stylesheet" type="text/css" href="./css/loader.css">
  	<link rel="stylesheet" type="text/css" href="./css/normal-style.css">
  </head>
  <body>
    <div class ="wrapper">
      <div class = "container">
        <div class="header">
          <h1><?php echo($groupName); ?></h1>
          <?php
            if($isLoggedin)
            {
              echo('<h1>'.$userRow['user_id'].'</h1>');
            }
           ?>
        </div>
        <div class="center">
          <div class="option-container">
            <ul class = "option-list">
              <li><a href="#빌리기">빌리기</a></li>
              <li><a href="#갚기">갚기</a></li>
              <li><a href="#이모티콘">이모티콘</a></li>
            </ul>
          </div>
          <div class="name-list-container">
            <ul class = "name-list">

            </ul>
          </div>
        </div>
        <div class="footer">

        </div>
      </div>
    </div>
  </body>
</html>
