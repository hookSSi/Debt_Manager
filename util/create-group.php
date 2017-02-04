<?php
require_once("../class/db_class.php");
require_once("../class/group_class.php");

$db_manager = new DB_Manager();

$Group = new Group($db_manager->pdo);

if(isset($_POST['groupName']))
{
  $groupName = $_POST['groupName'];

  $result = $Group->CreateGroup($groupName);

  echo $result;
}

?>
