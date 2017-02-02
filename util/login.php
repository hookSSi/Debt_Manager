<?php
require_once("../class/db_class.php");
require_once("../class/account_class.php");

$db_manager = new DB_Manager();

$Account = new Account($db_manager->pdo);

if(isset($_POST['user_id']) && isset($_POST['user_password']))
{
  $username = $_POST['user_id'];
  $password = $_POST['user_password'];

  $permission = $Account->login($username,$password);

  if($permission === 'normal')
  {
    echo "success";
  }
  else if($permission === 'admin')
  {
    echo "admin access";
  }
}
else
{
  echo "fail";
}

?>
