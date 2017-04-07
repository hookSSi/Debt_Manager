<!DOCTYPE html>
<?php
require_once("./class/account_class.php");
require_once('./class/group_class.php');
require_once('./class/userinfo_class.php');

$userinfo = new UserInfo();
$GroupManager = new Group();

$userRow = null;
$isLogin = false;
$user_name = "";

if(isset($_COOKIE['user_id']) && isset($_COOKIE['user_password']) && isset($_COOKIE['user_permission'])) {
  $Account = new Account();

  $userRow = $Account->login($_COOKIE['user_id'], $_COOKIE['user_password']);

  if($userRow == null){
    $isLogin = false;
  }
  else if($userRow['permission'] === 'normal' || $userRow['permission'] === 'admin'){
    $isLogin = true;
		$user_name = $userRow['user_id'];
    setcookie('user_id',$userRow['user_id'],time()+(86400*30),'/');
    setcookie('user_password',$userRow['user_password'],time()+(86400*30),'/');
    setcookie('user_permission', $userRow['permission'],time()+(86400*30),'/');
  }
}
?>
<html>
	<head>
		<meta charset="utf-8">
		  <?php
			if($isLogin){
				echo("<title>SINABRO - ");
				echo($user_name."님 환영합니다.</title>");
			}
			else{
				echo("<title>SINABRO</title>");
			}
		 ?>
		 <link rel="stylesheet" type="text/css" href="./css/font-awesome.css">
		 <link rel= "stylesheet" type="text/css" href ="./css/normal-style.css?ver=0">
		 <link rel = "stylesheet" type="text/css" href = "./css/client-page.css?ver=0">
	</head>
	<body>
		<div class = "wrapper">
			<div class = "container">
				<div class = "top">
					<!-- 테스트 배너 -->
					<div class = "top-banner">
						 <?php
							if($isLogin){
								echo("<h1>어서오세요 (".$user_name.")님 <a href = '#' class = 'close' style = 'font-size:3rem;'>x</a></h1>");
							}
						 ?>
					</div>
					<!-- 상단 메뉴 -->
					<nav class = "top-menu-list">
						<div class = "logo">
							<a href="#">
								<img src ="./image/logo.png" width="105" height ="105" alt ="ERROR" />
							</a>
						</div>
						<ul>
							<li>
								<a href="#product">Product</a>
							</li>
							<li>
								<a href="#support">Support</a>
							</li>
							<?php
							if($isLogin){
								echo("<li>
												<div class = 'dropdown'>
													<a href='#'><i class = 'icon fa fa-bars fa-3x' aria-hidden='true'></i></a>
													<div class = 'dropdown-content'>
														<a href='./util/logout.php'>로그아웃</a>
													</div>
												</div>
											</li>");
							}
							else{
								echo("<li>
								<a href='./login-page.php'>Login</a>
								</li>");
							}
							?>
						</ul>
					</nav>
				</div>
				<div class="middle">
					<!-- 제목 -->
					<div id = "subject">
						<h1>
							Welcome to SINABRO
							<img src ="./image/money.gif" width="105" height ="105" alt ="ERROR" />
						</h1>
						<div class = "subhead">
							<p style ="text-align:center;">
								쉽고 재밌게 호의를 주고 받으세요!
							</p>
						</div>
					</div>
					<!-- 그룹이름 입력 폼 -->
					<form id = "group-form">
						<input type = "text" id = 'group-name' name = 'group-name' size = "25" maxlength = "25" placeholder = "그룹이름" />
						<?php
						if($isLogin){
							echo('<button type = "create" action = "./util/create-group.php" id = "create" class = "group-form-button">만들기</button>
							<button input type = "button" id = "search-group" class = "group-form-button">찾기</button>');
						}
						else{
							echo('<button type = "create" id = "login" class = "group-form-button"><a href = "./login-page.php" style = "color:#53e3a6">만들기</a></button>
							<button type = "sign-in" id = "login" class = "group-form-button"><a href = "./login-page.php" style = "color:#53e3a6">참가</a></button>');
						}
						?>
					</form>
					<!-- 꾸미기 용 -->
					<div id = "client_page_svg_wrapper">

					</div>
				</div>
				<div class="footer">
					<div class = "menu-list">

					</div>
				</div>
			</div>
			<!-- 버블 -->
			<ul class = "bg-bubbles">
 			 <li> </li>
 			 <li> </li>
 			 <li> </li>
 			 <li> </li>
 			 <li> </li>
 			 <li> </li>
 			 <li> </li>
 			 <li> </li>
 			 <li> </li>
 			 <li> </li>
      </ul>
		</div>
		<!-- 검색창 -->
		<div class="popupContainer" id = "search-group-window">
			<header class = "popupHeader">
				<span class = 'header_title'>들어갈 그룹찾기</span>
			</header>
			<section class = "popupBody">
				<form class="search-form" action="index.html" method="get">
					<input type = "text" id = 'group-name-to-search' name = 'group-name' size = "25" maxlength= "25" placeholder= "그룹이름"/>
				</form>
				<ul class = "group-list">
					<li><a href="#">그룹1</a></li>
					<li><a href="#">그룹2</a></li>
					<li><a href="#">그룹3</a></li>
					<?php
					if($isLogin)
					{
						$groupRow = $GroupManager->GetGroupList();
					}
					?>
				</ul>
			</section>
		</div>
		<div id="overlay"></div>
		<!-- jQuery -->
	  <script type = "text/javascript" src = "./js/jquery-1.11.0.min.js"></script>
		<!-- jQuery lean Model -->
		<script type = "text/javascript" src = "./js/jquery.leanModal.min.js"></script>
		<!-- font-awesome -->
		<script type = "text/javascript" src = "https://use.fontawesome.com/4295d946d8.js"></script>
		<!-- 자바스크립트 부분 -->
	  <script type = "text/javascript" src = "./js/client-page.js?ver=0"></script>
	</body>
</html>
