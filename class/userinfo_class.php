<?php
require_once("db_class.php");
class UserInfo{
  private $db;

  function __construct()
  {
    $this->db = DB_Manager::getInstance()->pdo;
  }

  // 그룹 참가
  public function JoinGroup($id, $groupid)
  {
    $stmt = $this->db->prepare("SELECT * FROM UserInfo
                                WHERE id = :id
                                AND groupid = :groupid");
    $stmt->bindparam(":id",$id);
    $stmt->bindparam(":groupid",$groupid);
    $stmt->execute();
    $userInfoList = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if(count($userInfoList) == 0){
      $stmt2 = $this->db->prepare("SELECT `user_id`
                                  FROM  `Account`
                                  WHERE id = :id");
      $stmt2->bindparam(":id", $id);
      $stmt2->execute();

      $userRow = $stmt2->fetchColumn();

      $result = $this->CreateUserInfo($id, $groupid, $userRow);

      if($result){
        $stmt3 = $this->db->prepare("UPDATE `Group`
                                    SET `peopleCount` = `peopleCount` + 1
                                    WHERE `groupid` = :groupid " );
        $stmt3->bindparam(":groupid", $groupid);
        $stmt3->execute();
      }
      else {
        echo("유저정보 생성 실패!");
      }
    }
    else{
      echo("이미 참가된 그룹");
    }
  }

  // 유저정보 생성
  public function CreateUserInfo($id, $groupid, $name)
  {
    try
    {
      $stmt = $this->db->prepare("INSERT INTO UserInfo
      (`id`,`groupid`, `name`,`self_introduce`, `image_url`, `join_date`)
      VALUES(:id, :groupid, :name, :introduce, :image_url, now())");

      $stmt->bindparam(":id",$id);
      $stmt->bindparam(":groupid", $groupid);
      $stmt->bindparam(":name", $name);
      $default_introduce = "100글자 이내로 적으세요.";
      $stmt->bindparam(":introduce", $default_introduce);
      $default_image = "..\\image\\temp.jpg";
      $stmt->bindparam(":image_url", $default_image);
      $stmt->execute();

      return true;
    }
    catch (Exception $e)
    {
      echo $e->getMessage();
    }

    return false;
  }
}
 ?>
