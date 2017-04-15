<?php
require_once("../class/group_class.php");
require_once("../class/account_class.php");
require_once("../class/userinfo_class.php");
require_once("../class/common_function.php");

$Group = new Group();

if(isset($_POST['groupName'])){
  $groupName = $_POST['groupName'];

  // 입력값이 올바른지 확인
  if(IsInputValid($groupName, 0)){
    $groupid = $Group->CreateGroup($groupName);

    $Account = new Account();

    $user_id = $_COOKIE['user_id'];

    $id = $Account->GetUserId($user_id);

    $UserInfo = new UserInfo();

    $UserInfo->JoinGroup($id, $groupid);
  }
}
else {
  echo "failed";
}

?>
