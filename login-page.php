<? // 로그인 페이지 파일 ?>
<?php
	if(isset($_COOKIE['user_name']) && isset($_COOKIE['user_password']) && isset($_COOKIE['user_permission']))
	{
		header("Location: ./client-page.php");
	}
 ?>
<html>
<head>
	<title>로그인 페이지</title>
	<meta charset="utf-8" />

	<link rel="stylesheet" type="text/css" href="./css/font-awesome-google.css">
	<link rel="stylesheet" type="text/css" href="./css/login-page.css">
	<link rel="stylesheet" type="text/css" href="./css/box-loading.css">
	<script src='https://www.google.com/recaptcha/api.js'></script>
</head>

<body>
	<div class="wrapper">
	   <div class = "container">
       <h1>Welcome</h1>
			 <div id = "loading"></div>
       <form id = "login-form" method="POST" action = "./util/login.php" >
         <input type = "text" id = 'user_id' name = 'user_id' size = "25" maxlength = "25" placeholder = "아이디" />
         <input type = "password" id = 'user_password' name = 'user_password' size = "25" maxlength = "25" placeholder = "비밀번호" />
         <button type = "submit" id = "login-button">로그인</button>
				 <button type = "toggle" class = "toggle">회원가입하기!</button>
       </form>
			 <form id = "signup-form" style = "display:none;" method = "POST" action = "./util/signup.php">
				 <input type = "text" name = 'user_id_set'  id = 'user_id_set' size = "25" maxlength = "25" placeholder = "아이디" />
				 <input type = "password" name = 'user_password_set' id = 'user_password_set' size = "25" maxlength = "25" placeholder = "비밀번호" />
				 <input type = "username" name = 'username_set' id = 'username_set' size = "25" maxlength = "25" placeholder = "이름" />
				 <input type = "email" name = 'user_email_set' id = 'user_email_set' size = "40" maxlength = "40" placeholder = "이메일" />
				 <div class="g-recaptcha" data-sitekey="6Le97h4UAAAAAMohT7ml7Mc-k46my0HxgDcSkMuO"></div>
				 <button type = "signup" id = "signup-button">회원가입</button>
				 <button type = "toggle" class = "toggle">뒤로가기!</button>
			 </form>
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
	<!-- 자바스크립트 부분 -->
  <script type = "text/javascript" src = "./js/jquery-1.11.0.min.js"></script>
  <script type = "text/javascript" src="./js/login-page.js">

	</script>
</body>
</html>
