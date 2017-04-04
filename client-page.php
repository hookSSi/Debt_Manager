<!DOCTYPE html>
<?php
$isLoggedin = false;

if(!isset($_COOKIE['user_id']) || !isset($_COOKIE['user_password']) || !isset($_COOKIE['user_permission'])) {
#로그인이 안되어 있다.
$isLoggedin = false;
}
else {
	$user_name = $_COOKIE['user_id'];
	$user_password = $_COOKIE['user_password'];
	$isLoggedin = true;
}

?>
<html>
	<head>
		<meta charset="utf-8">
		<?php
			if($isLoggedin){
				echo("<title>SINABRO - ");
				echo($user_name."님 환영합니다.</title>");
			}
			else{
				echo("<title>SINABRO</title>");
			}

		 ?>
		 <link rel="stylesheet" type="text/css" href="./css/font-awesome.css">
		 <link rel= "stylesheet" type="text/css" href ="./css/normal-style.css?ver=1">
		 <link rel = "stylesheet" type="text/css" href = "./css/client-page.css?ver=1">
	</head>
	<body>
		<div class = "wrapper">
			<div class = "container">
				<div class = "top">
					<div class = "top-banner">
						<?php
							if($isLoggedin){
								echo("<h1>어서오세요 ($user_name)님 <a href = '#' class = 'close' style = 'font-size:3rem;'>x</a></h1>");
							}
						 ?>
					</div>
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
							if($isLoggedin){
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
					<form id = "group-form">
						<input type = "text" id = 'group-name' name = 'group-name' size = "25" maxlength = "25" placeholder = "그룹이름" />
						<?php
						if($isLoggedin){
							echo('<button type = "create" action = "./util/create-group.php" id = "create" class = "group-form-button">만들기</button>
							<button type = "sign-in" action = "./util/sign-in-group.php" id = "sign-in" class = "group-form-button">참가</button>');
						}
						else{
							echo('<button type = "create" id = "login" class = "group-form-button"><a href = "./login-page.php" style = "color:#53e3a6">만들기</a></button>
							<button type = "sign-in" id = "login" class = "group-form-button"><a href = "./login-page.php" style = "color:#53e3a6">참가</a></button>');
						}
						?>
					</form>
					<div id = "client_page_svg_wrapper">

					</div>
				</div>
				<div class="footer">
					<div class = "menu-list">

					</div>
				</div>
			</div>
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
		<!-- jQuery -->
	  <script type = "text/javascript" src = "./js/jquery-1.11.0.min.js"></script>
		<!-- font-awesome -->
		<script type = "text/javascript" src = "https://use.fontawesome.com/4295d946d8.js"></script>
		<!-- 자바스크립트 부분 -->
	  <script type = "text/javascript" src = "./js/client-page.js?ver=3"></script>
	</body>
</html>
