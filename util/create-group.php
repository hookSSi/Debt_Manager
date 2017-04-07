<?php
require_once("../class/group_class.php");
require_once("../class/account_class.php");
require_once("../class/userinfo_class.php");

$Group = new Group();

$result = $_POST['groupName'];
$groupid = "";

if(isset($_POST['groupName']))
{
  $groupName = $_POST['groupName'];

  $groupid = $Group->CreateGroup($groupName);
}

$Account = new Account();

$user_id = $_COOKIE['user_id'];

$id = $Account->GetUserId($user_id);

$UserInfo = new UserInfo();

$UserInfo->JoinGroup($id, $groupid);
?>
