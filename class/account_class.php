<?php
require_once("db_class.php");

class Account{
  private $db;

  function __construct()
  {
    $this->db = DB_Manager::getInstance()->pdo;
  }

  // 회원가입 함수
  public function register($user_id, $user_password, $username, $email)
  {
    try
    {
      $new_password = password_hash($user_password, PASSWORD_DEFAULT);

      $stmt = $this->db->prepare("INSERT INTO `Account`
      (`id`,`user_id`, `username`, `user_password`, `email`, `reg_date`, `last_active_date`)
      VALUES(:id, :user_id, :username, :user_password, :email, now(), now())");

      $id = md5($user_id);

      $stmt->bindparam(":id",$id);
      $stmt->bindparam(":user_id", $user_id);
      $stmt->bindparam(":username", $username);
      $stmt->bindparam(":user_password", $new_password);
      $stmt->bindparam(":email", $email);
      $stmt->execute();

      return true;
    }
    catch (Exception $e)
    {
      echo $e->getMessage();
      return false;
    }
  }
  // 어드민 추가 함수
  public function AddAdmin($user_id, $user_password, $username, $email)
  {
    try
    {
      $new_password = password_hash($user_password, PASSWORD_DEFAULT);

      $stmt = $this->db->prepare("INSERT INTO `Account`
      (`id`,`user_id`, `username`, `user_password`, `email`, `permission`, `reg_date`, `last_active_date`)
      VALUES(:id, :user_id, :username, :user_password, :email, 'admin', now(), now())");

      $id = md5($user_id);

      $stmt->bindparam(":id",$id);
      $stmt->bindparam(":user_id", $user_id);
      $stmt->bindparam(":username", $username);
      $stmt->bindparam(":user_password", $new_password);
      $stmt->bindparam(":email", $email);
      $stmt->execute();

      return "success";
    }
    catch (Exception $e)
    {
      echo $e->getMessage();
    }
  }
  // 로그인 함수
  public function login($user_id, $user_password)
  {
    $userRow = null;

    try
    {
      $this->logout();

      $stmt = $this->db->prepare("SELECT * FROM Account WHERE user_id = :user_id");
      $stmt->bindParam(':user_id', $user_id);
      $stmt->execute();
      $userRow = $stmt->fetch(PDO::FETCH_ASSOC);

      if($stmt->rowCount() > 0)
      {
        if(password_verify($user_password, $userRow['user_password']))
        {
          setcookie('user_id',$userRow['user_id'],time()+(86400*30),'/');
          setcookie('user_password',$userRow['user_password'],time()+(86400*30),'/');
          setcookie('user_permission', $userRow['permission'],time()+(86400*30),'/');
          return $userRow;
        }
      }
    }
    catch(PODException $e)
    {
      $this->logout();
      echo $e->getMessage();
    }
    return $userRow;
  }
  // 로그인 확인 함수
  public function is_loggedin()
  {
    if(isset($_COOKIE['user_id']))
    {
      return true;
    }
  }
  // 새로고침 함수
  public function redirect($url)
  {
    header("Location: $url");
  }
 // 로그아웃 함수
  public function logout()
  {
    setcookie('user_id', '', time()-300,'/');
    setcookie('user_password', '', time()-300,'/');
    setcookie('user_permission', '', time()-300,'/');
    return true;
  }
  // 계정 삭제
  public function DeleteAccount($id)
  {
    try
    {
      $stmt = $this->db->prepare("DELETE * FROM Account WHERE id = :id");
      $stmt->bindParam(':id', $id);
      $stmt->execute();

      return true;
    }
    catch(PODException $e)
    {
      echo $e->getMessage();
    }
  }
 // 계정 리스트 불러오기 함수 - 어드민 제외
  public function GetAccountList()
  {
    try
    {
      $stmt = $this->db->prepare("SELECT * FROM Account WHERE permission != 'Admin'");
      $stmt->execute();
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $result;
    }
    catch(PODException $e)
    {
      echo $e->getMessage();
    }
  }
  // 계정 고유 id 불러오기
  public function GetUserId($user_id)
  {
    try
    {
      $stmt = $this->db->prepare("SELECT id FROM Account WHERE user_id = :user_id");
      $stmt->bindParam(':user_id',$user_id);
      $stmt->execute();
      $result = $stmt->fetchColumn();
      return $result;
    }
    catch(PODException $e)
    {
      echo $e->getMessage();
    }
  }
}
 ?>
