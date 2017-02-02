<?php
require_once("../class/db_class.php");
require_once("../class/account_class.php");

$db_manager = new DB_Manager();

$Account = new Account($db_manager->pdo);

if(isset($_POST['user_id']) && isset($_POST['user_password']) && isset($_POST['user_email']))
{
  $username = $_POST['user_id'];
  $password = $_POST['user_password'];
  $email = $_POST['user_email'];

  if($username == ""){
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
      $stmt = $db_manager->pdo->prepare("SELECT username, email FROM Account WHERE username = :username OR email = :email");
      $stmt->execute(array(':username' => $username, ':email' => $email));
      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      if($row['username'] == $username){
        $error[] = "이미 같은 아이디가 존재합니다.";
      }
      else if($row['email'] == $email){
        $error[] = "이미 같은 이메일이 존재합니다.";
      }
      else {
        if($Account->register($username, $password, $email)){
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
