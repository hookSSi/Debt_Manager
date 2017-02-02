<? // 로그인 페이지 파일 ?>
<?php
	if(isset($_COOKIE['user_id']) && isset($_COOKIE['user_password']) && isset($_COOKIE['user_permission']))
	{
		header("Location: ./client-page.php");
	}
 ?>
<html>
<head>
	<title>로그인 페이지</title>
	<meta charset="utf-8" />

	<!-- CSS 부분 -->
	<style>
		@import url("./css/login-page.css");
		@import url("./css/box-loading.css");
	</style>
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
				 <input type = "email" name = 'user_email_set' id = 'user_email_set' size = "40" maxlength = "40" placeholder = "이메일" />
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
  <script type = "text/javascript" src = "http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.11.0.min.js"></script>
  <script type = "text/javascript" src="./js/login-page.js">

	</script>
</body>
</html>
