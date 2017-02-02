<?php
class Account{
  private $db;

  function __construct($db)
  {
    $this->db = $db;
  }

  // 회원가입 함수
  public function register($username, $password, $email)
  {
    try
    {
      $new_password = password_hash($password, PASSWORD_DEFAULT);

      $stmt = $this->db->prepare("INSERT INTO `Account` (`username`, `password`, `email`, `reg_date`)
      VALUES(:username, :password, :email, now())");

      $stmt->bindparam(":username", $username);
      $stmt->bindparam(":password", $new_password);
      $stmt->bindparam(":email", $email);
      $stmt->execute();

      return $stmt;
    }
    catch (Exception $e)
    {
      echo $e->getMessage();
    }
  }
  // 어드민 추가 함수
  public function AddAdmin($username, $password, $email)
  {
    try
    {
      $new_password = password_hash($password, PASSWORD_DEFAULT);

      $stmt = $this->db->prepare("INSERT INTO `Account` (`username`, `password`, `email`, `permission`,`reg_date`)
      VALUES(:username, :password, :email, 'admin',now())");

      $stmt->bindparam(":username", $username);
      $stmt->bindparam(":password", $new_password);
      $stmt->bindparam(":email", $email);
      $stmt->execute();
      $userRow = $stmt->fetch(PDO::FETCH_ASSOC);

      setcookie('user_id',$userRow['username'],time()+(86400*30));
      setcookie('user_password',$userRow['password'],time()+(86400*30));

      return $stmt;
    }
    catch (Exception $e)
    {
      echo $e->getMessage();
    }
  }
  // 로그인 함수
  public function login($username, $password)
  {
    try
    {
      $stmt = $this->db->prepare("SELECT * FROM Account WHERE username=:username");
      $stmt->bindParam(':username', $username);
      $stmt->execute();
      $userRow = $stmt->fetch(PDO::FETCH_ASSOC);

      if($stmt->rowCount() > 0)
      {
        if(password_verify($password, $userRow['password']))
        {
          setcookie('user_id',$userRow['username'],time()+(86400*30),'/');
          setcookie('user_password',$userRow['password'],time()+(86400*30),'/');
          setcookie('user_permission', $userRow['permission'],time()+(86400*30),'/');
          return $userRow['permission'];
        }
      }
      $this->logout();
      return "error";
    }
    catch(PODException $e)
    {
      $this->logout();
      echo $e->getMessage();
    }
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
  public function deleteAccount($username)
  {
    try
    {
      $stmt = $this->db->prepare("DELETE * FROM Account WHERE permission != :username");
      $stmt->bindParam(':username', $username);
      $stmt->execute();


      return $result;
    }
    catch(PODException $e)
    {
      echo $e->getMessage();
    }
  }
 // 계정의 필드 리스트 불러오기 함수 - 어드민 제외
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
}
 ?>
