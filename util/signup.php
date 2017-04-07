<?php
require_once("../class/db_class.php");
require_once("../class/account_class.php");

$db_manager = DB_Manager::getInstance();

$Account = new Account();

$error[] = "";

if(isset($_POST['user_id']) && isset($_POST['user_password']) &&
   isset($_POST['username']) && isset($_POST['user_email']))
{
  $user_id = $_POST['user_id'];
  $password = $_POST['user_password'];
  $username = $_POST['username'];
  $email = $_POST['user_email'];

  if($user_id == ""){
    $error[] = "아이디를 입력하세요.";
  }
  else if($password == ""){
    $error[] = "비밀번호를 입력하세요.";
  }
  else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $error[] = "올바른 이메일을 입력하세요.";
  }
  else {
    try
    {
      $stmt = $db_manager->pdo->prepare("SELECT user_id, email FROM Account WHERE user_id = :user_id OR email = :email");
      $stmt->execute(array(':user_id' => $user_id, ':email' => $email));
      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      if($row['user_id'] == $user_id){
        $error[] = "이미 같은 아이디가 존재합니다.";
      }
      else if($row['email'] == $email){
        $error[] = "이미 같은 이메일이 존재합니다.";
      }
      else {
        if($Account->register($user_id, $password, $username, $email)){
          echo "success";
        }
      }
    }
    catch(PDOException $e)
    {
      echo $e->getMessage();
    }
  }
}
else {
  echo $error;
}

?>
