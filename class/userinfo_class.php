<?php
class UserInfo{
  private $db;

  function __construct($db)
  {
    $this->db = $db;
  }


  // 그룹 참가
  public function JoinGroup($id, $groupid, $name)
  {
    $stmt = $this->db->prepare("SELECT * FROM `UserInfo`
                                WHERE id = :id
                                AND groupid = :groupid");
    $stmt->bindparam(":id",$id);
    $stmt->bindparam(":groupid",$groupid);
    $stmt->execute();
    $userInfoList = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if(count($userInfoList) > 0){
      $stmt = $this->db->prepare("SELECT `user_id`
                                  FROM `Account`
                                  WHERE id = :id");
      $stmt->bindparam(":id", $id);
      $stmt->execute();

      $userRow = $stmt->fetchAll(PDO::FETCH_ASSOC);

      $result = $this->CreateUserInfo($id,$groupid, $userRow['user_id']);

      if($result){
        $stmt = $this->db->prepare("UPDATE `group`
                                    SET `peopleCount` = `peopleCount` + 1
                                    WHERE groupid = :groupid " );
        $stmt->bindparam(":groupid",groupid);
        $stmt->execute();
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
  public CreateUserInfo($id, $groupid, $name)
  {
    try
    {
      $stmt = $this->db->prepare("INSERT INTO `UserInfo`
      (`id`,`groupid`, `name`,`self_introduce`, `image_url`, `join_date`)
      VALUES(:id, :groupid, :name, :introduce, :image_url, now())");

      $stmt->bindparam(":id",$id);
      $stmt->bindparam(":groupid", $groupid);
      $stmt->bindparam(":name", $name);
      $stmt->bindparam(":introduce", "100글자 이내로 적으세요.");
      $stmt->bindparam(":image_url", "localhost\Debt_Manager\image\\temp.jpg");
      $stmt->execute();

      return true;
    }
    catch (Exception $e)
    {
      echo $e->getMessage();
      return false;
    }
  }
}
 ?>
