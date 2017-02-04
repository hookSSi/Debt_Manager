<? //관리자 페이지 파일 ?>
<?php
	require_once('./class/db_class.php');
	require_once('./class/account_class.php');
	require_once('./class/group_class.php');

	$database = new DB_Manager();
	$AccountManager = new Account($database->pdo);
	$GroupManager = new Group($database->pdo);

	if(!isset($_COOKIE['user_name']) || !isset($_COOKIE['user_password']) || $_COOKIE['user_permission'] === 'normal')
	{
		echo("
		<script>
			alert('당신은 권한이 없습니다!');
			location.replace('./login-page.php');
		</script>
		");
	}
?>
<html>
<head>
	<title>관리자 페이지</title>
	<meta charset="utf-8" />

  <!-- CSS 부분 -->
	<style type = "text/css">
		@import url("./css/admin-page.css");
		@import url("./css/image_and_list.css");
	</style>
</head>

<body>
	<div class="wrapper">
	   <div class = "container">
			 <section>
	      <ul class = "fa-ul">
	        <a href="#t1"><li><i class="icon fa fa-home fa-3x" airia-hidden = "true" id = "home"></i></li></a>
	        <a href="#t2"><li><i class="icon fa fa-user-circle-o fa-3x" airia-hidden = "true" id = "userInfo"></i></li></a>
	        <a href="#t3"><li><i class="icon fa fa-users fa-3x" airia-hidden = "true" id= "groupInfo"></i></li></a>
	        <a href="#t4"><li><i class="icon fa fa-database fa-3x" airia-hidden = "true" id = "database"></i></li></a>
	        <a href="#t5"><li><i class="icon fa fa-envelope-open fa-3x" aria-hidden = "true" id = "misc"></i></li></a>
	      </ul >
	       <div class="page" id = "p1" style = "background: #374046;">
	          <li class="icon fa fa-home">
							<span class="title">Admin 페이지</span>
							<span class="hint">
								어드민 페이지입니다.<br/>
								여기선 여러가지 일을 할 수 있죠!
							</span>
						</li>
	       </div>
	       <div class="page" id = "p2" style = "background: #FF5722;">
	         <li class="icon fa fa-user-circle-o">
						 <span class="title">회원 관리</span>
						 <span class="hint">회원을 추가 혹은 삭제합니다.</span>
						 <span class="content">
						 	<div id = "accountListbox">
								<!-- 회원리스트 -->
								<div class = "image_list">
									<?php
										$accountList = $AccountManager->GetAccountList();

										if($accountList !== false)
										{
											foreach ($accountList as $row)
											{
												echo("
														<div class = 'listBox'>
															<div class = 'inner'>
																<div class = 'li-image'><img src = '' alt = 'Image Not Found'></div>
																	<div class = 'li-text'>
																		<h4 class = 'li-head'>{$row['username']}</h4>
																		<p class = 'li-contents'>{$row['email']}</p>
																	</div>
																	<a href ='#' class = 'li-button'>
																		x
																	</a>
															</div>
														</div>
												");
											}
										}
									 ?>
								</div>
							</div>
						 </span>
					 </li>
	       </div>
	       <div class="page" id = "p3" style = "background: #593C1F;">
	         <li class="icon fa fa-users">
						 <span class="title">그룹 관리</span>
						 <span class = "hint">그룹을 추가 혹은 삭제합니다.</span>
						 <span class = "content">
							 <div id = "accountListbox">
 								<!-- 회원리스트 -->
 								<div class = "image_list">
 									<?php
 										$groupList = $GroupManager->GetGroupList();

										if($groupList !== false)
										{
											foreach ($groupList as $row)
	 										{
	 											echo("
	 													<div class = 'listBox'>
	 														<div class = 'inner'>
	 															<div class = 'li-image'><img src = '' alt = 'Image Not Found'></div>
	 																<div class = 'li-text'>
	 																	<h4 class = 'li-head'>{$row['groupName']}</h4>
	 																	<p class = 'li-contents'>현재 {$row['peopleCount']}명 존재합니다.</p>
	 																</div>
	 																<a href ='#' class = 'li-button'>
	 																	x
	 																</a>
	 														</div>
	 													</div>
	 											");
	 										}
										}
 									 ?>
 								</div>
 							</div>
						 </span>
					 </li>
	       </div>
	       <div class="page" id = "p4" style = "background: deeppink;">
	        <li class="icon fa fa-database">
						<span class="title">데이터 베이스</span>
						<span class="hint">
							<form method= "POST" action = "./install-DB.php">
							 <button type = "Button" id = "reset_or_install">Reset or Install</button>
						 	</form>
						</span>
					</li>
	       </div>
	       <div class="page" id = "p5" style = "background: powderblue;">
	        <li class="icon fa fa-envelope-open">
						<span class="title">기타 문의사항</span>
						<span class="hint">보내기</span>
					</li>
				</div>
	     </section>
     </div>
	</div>

	<!-- jQuery -->
  <script type = "text/javascript" src = "https://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.11.0.min.js"></script>
	<!-- font-awesome -->
	<script type = "text/javascript" src = "https://use.fontawesome.com/4295d946d8.js"></script>
	<!-- 자바스크립트 부분 -->
  <script type = "text/javascript" src = "./js/admin-page.js?ver=2"></script>
</body>
</html>
