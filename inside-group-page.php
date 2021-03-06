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
    <link rel="stylesheet" type="text/css" href="./css/inside-group-page.css">
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
          <div id ="option-container">
            <div id = "option-wrapper">
              <i class="icon fa fa-plus fa-3x awesome-icon-button" id = "option-button" airia-hidden = "true"></i>
              <ul id = "option-menu">
                <li class = "menuitem-wrapper">
                  <div class="icon-holder circle-holder">
                    <a class = "util-button" href="#돈">
                        <i class="icon fa fa-money fa-3x" airia-hidden = "true"></i>
                    </a>
                  </div>
                </li>
                <li class = "menuitem-wrapper">
                  <div class="icon-holder circle-holder">
                    <a class = "util-button" href="#이모티콘">
                      <i class="icon fa fa-smile-o fa-3x" airia-hidden = "true"></i>
                    </a>
                  </div>
                </li>
                <li class = "menuitem-wrapper">
                  <div class="icon-holder circle-holder">
                    <a class = "util-button" href="#알림">
                      <i class="icon fa fa-rss fa-3x" airia-hidden = "true"></i>
                    </a>
                  </div>
                </li>
              </ul>
            </div>
          </div>
          <div id = "record-container">
            <div id ="record-wrapper">
              <div id="record-window">
                <div class = "message_content">
                  <div class = "message_content_header"><img src="./image/temp.jpg" alt=""></div>
                  <div class="message_content_body">
                    <span class = "userId">아이디</span>
                    <span class = "message_body">메시지</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div id ="name-list-container">
            <div id = "name-list-wrapper">
              <div id ="name-list-window">
                <ul class = "name-list">
                  <li class = "name-box">이름</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="footer">

        </div>
      </div>
      <div class="popupContainer" id = "money-window" >
        <div class = "insideContainer" id="inside-money-window" style = "overflow-y:auto;">
          <header class = "popupHeader">
    				<span class = 'header_title'>보낼 돈을 입력하세요</span>
    			</header>
    			<section class = "popupBody">
    				<form class="send-form" action="index.html" method="get">
    					<input type = "number" id = 'money-to-send' name = 'money-value' size = "25" maxlength= "25" placeholder= "그룹이름"/>
              <button input type = "button" id = 'send-button'>보내기</button>
            </form>
    			</section>
        </div>
  		</div>
      <div class="popupContainer" id = "emo-window" >
        <div class = "insideContainer" id="inside-emo-window" style = "overflow-y:auto;">
          <header class = "popupHeader">
    				<span class = 'header_title'>보낼 이모티콘을 선택하세요.</span>
    			</header>
    			<section class = "popupBody">
    				<form class="send-form" action="index.html" method="get">
    					<div class="emo-holder">
    					  <ul>
    					    <li><div class="emo-box">1</div></li>
                  <li><div class="emo-box">2</div></li>
                  <li><div class="emo-box">3</div></li>
                  <li><div class="emo-box">4</div></li>
                  <li><div class="emo-box">5</div></li>
                  <li><div class="emo-box">6</div></li>
    					  </ul>
    					</div>
              <button input type = "button" id = 'send-button'>보내기</button>
            </form>
    			</section>
        </div>
  		</div>
  		<div id="overlay"></div>
      <!-- jQuery -->
  	  <script type = "text/javascript" src = "./js/jquery-1.11.0.min.js"></script>
  		<!-- font-awesome -->
  		<script type = "text/javascript" src = "https://use.fontawesome.com/4295d946d8.js"></script>
  		<!-- 자바스크립트 부분 -->
  	  <script type = "text/javascript" src = "./js/inside-group-page.js?ver=0"></script>
    </div>
  </body>
</html>
