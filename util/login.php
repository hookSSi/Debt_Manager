<?php
require_once("../class/account_class.php");

$Account = new Account();

if(isset($_POST['user_id']) && isset($_POST['user_password'])){
  $user_id = $_POST['user_id'];
  $user_password = $_POST['user_password'];

  $Account->logout();
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
