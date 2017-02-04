<!DOCTYPE html>
<meta charset="utf-8" />
<?php
if(!isset($_COOKIE['user_name']) || !isset($_COOKIE['user_password']) || !isset($_COOKIE['user_permission'])) {
	header("Location: ./login-page.php");
	exit;
}

$user_name = $_COOKIE['user_name'];
$user_password = $_COOKIE['user_password'];
?>
<html>
	<head>
		<meta charset="utf-8">
		<title>클라이언트 페이지</title>
		<style>
			@import url("./css/client-page.css");
		</style>
	</head>
	<body>
		<div class="top-banner">
			<?php
				echo("<h1>어서오세요 ($user_name)님</h1>");
			 ?>
			 <a href = "./util/logout.php">로그아웃</a>
		</div>
		<nav class = "top-menu-list">
			<a href="#"><i class = "fa fa-bars" aria-hidden="true"></i></a>
		</nav>
		<div class="wrapper">
			<div class="container">
					<form>
						<h3 style="text-align:center;">한글 입력 불가능</h5>
						<input type = "text" id = 'group_name' name = 'group_name' size = "25" maxlength = "25" placeholder = "그룹이름" />
						<button type = "create" action = "./util/create-group.php" id = "create">만들기</button>
						<button type = "sign-in" action = "./util/sign-in-group.php" id = "sign-in">참가</button>
					</form>
			</div>
			<nav class = "bottom-menu-list">

			</nav>
		</div>
		<div class="footer">

		</div>
		<div class = "background_wrapper">
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
	  <script type = "text/javascript" src = "https://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.11.0.min.js"></script>
		<!-- font-awesome -->
		<script type = "text/javascript" src = "https://use.fontawesome.com/4295d946d8.js"></script>
		<!-- 자바스크립트 부분 -->
	  <script type = "text/javascript" src = "./js/client-page.js"></script>
	</body>
</html>
