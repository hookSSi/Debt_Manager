<?php
require_once("../class/db_class.php");
require_once("../class/account_class.php");

$db_manager = new DB_Manager();

$Account = new Account($db_manager->pdo);

if(isset($_POST['user_id']) && isset($_POST['user_password'])){
  $user_id = $_POST['user_id'];
  $user_password = $_POST['user_password'];

  $userRow = $Account->login($user_id, $user_password);

  $permission = "";

  if($userRow != null){
    $permission = $userRow['permission'];

    if($permission === 'normal'){
      echo "success";
    }
    else if($permission === 'admin'){
      echo "admin access";
    }
  }
}
else{
  echo "fail";
}

?>
