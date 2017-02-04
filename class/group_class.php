<?php
class Group{
  private $db;

  function __construct($db)
  {
    $this->db = $db;
  }

  // 그룹 만들기 함수
  public function CreateGroup($groupName)
  {
    if($this->IsVaildGroupName($groupName))
    {
      try
      {
        $stmt = $this->db->prepare("INSERT INTO `Group` (`groupName`, `peopleCount`, `create_date`)
        VALUES(:groupName, 0, now())");
        $stmt->bindparam(":groupName", $groupName);
        $stmt->execute();

        return $stmt;
      }
      catch (PODException $e)
      {
        echo $e->getMessage();
        return false;
      }
    }
    else
      return false;
  }
  // 참가신청 보내기
  public function SendRequestJoin($groupName)
  {
    if(!$this->IsVaildGroupName($groupName))
    {

    }
    else
      return false;
  }
  // 유저 초대
  public function InviteUser()
  {

  }
  // 유효한 그룹이름인지 확인
  // true: 그룹이름이 현재 존재하지 않음
  // false: 그룹이름이 현재 존재함
  public function IsVaildGroupName($groupName)
  {
    $isValid = true;
    try
    {
      $stmt = $this->db->prepare("SELECT `groupName` FROM `Group` WHERE `groupName`=:groupName");
      $stmt->bindParam(':groupName', $groupName);
      $stmt->execute();
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    catch (PODException $e)
    {
      echo $e->getMessage();
      $isValid = false;
      return $isValid;
    }

    if(count($result) > 0)
      $isValid = false;

    return $isValid;
  }
  // 그룹 리스트 불러오기
  public function GetGroupList()
  {
    try
    {
      $stmt = $this->db->prepare("SELECT * FROM `Group`");
      $stmt->execute();
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $result;
    }
    catch(PODException $e)
    {
      echo $e->getMessage();
      return false;
    }
  }
  // 유저 id와 관련된 그룹 불러오기
  public function GetGroupListByUserId($user_id)
  {
    try
    {
      $stmt = $this->db->prepare("SELECT * FROM `Group`, `UserInfo`
        WHERE  `UserInfo.id` = :user_id AND `UserInfo.groupid` = `Group.groupid`");
      $stmt->bindParam(':user_id', $user_id);
      $stmt->execute();
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $result;
    }
    catch(PODException $e)
    {
      echo $e->getMessage();
      return false;
    }
  }
}
 ?>
