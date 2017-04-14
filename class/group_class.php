<?php
require_once("db_class.php");
class Group{
  private $db;

  function __construct()
  {
    $this->db = DB_Manager::getInstance()->pdo;
  }

  // 그룹 만들기 함수
  public function CreateGroup($groupName)
  {
    if($this->IsVaildGroupName($groupName))
    {
      try
      {
        $stmt = $this->db->prepare("INSERT INTO `Group`
          (`groupid`, `groupName`, `peopleCount`, `create_date`)
         VALUES(:groupid, :groupName, 0, now())");
        $groupid = md5($groupName);

        $stmt->bindparam(":groupid", $groupid);
        $stmt->bindparam(":groupName", $groupName);
        $stmt->execute();

        return $groupid;
      }
      catch (PODException $e)
      {
        return $e->getMessage();
      }
    }
    else
    {
      // 같은 이름이라면 #을 붙여서 만듬
      try
      {
        $newGroupName = $groupName.'#'.$this->GroupCount($groupName);

        $stmt = $this->db->prepare("INSERT INTO `Group`
          (`groupid`,`groupName`, `peopleCount`, `create_date`)
        VALUES(:groupid,:groupName, 0, now())");
        $groupid = md5($newGroupName);

        $stmt->bindparam(":groupid", $groupid);
        $stmt->bindparam(":groupName", $newGroupName);
        $stmt->execute();

        return $groupid;
      }
      catch (PODException $e)
      {
        return $e->getMessage();
      }
    }
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
    $isValid = false;

    try
    {
      $stmt = $this->db->prepare("SELECT * FROM `Group` WHERE `groupName` LIKE CONCAT(:groupName,'%')");
      $stmt->bindParam(':groupName', $groupName);
      $stmt->execute();
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    catch (PODException $e)
    {
      echo $e->getMessage();

      return $isValid;
    }

    if(count($result) == 0)
      $isValid = true;

    return $isValid;
  }

  public function GroupCount($groupName)
  {
    $count = 0;

    try
    {
      $stmt = $this->db->prepare("SELECT * FROM `Group` WHERE `groupName` LIKE CONCAT(:groupName,'%')");
      $stmt->bindParam(':groupName', $groupName);
      $stmt->execute();
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    catch (PODException $e)
    {
      echo $e->getMessage();
      return "error";
    }

    $count = count($result);

    return $count;
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
    }
  }

  public function GetGroupListByName($groupName)
  {
    try
    {
      $stmt = $this->db->prepare("SELECT * FROM `Group` WHERE `groupName` LIKE CONCAT(:groupName,'%')");
      $stmt->bindParam(':groupName', $groupName);
      $stmt->execute();
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $result;
    }
    catch(PODException $e)
    {
      echo $e->getMessage();
    }
  }
  
  // 처음 불러올때
  public function GetGroupListByName2($groupName, $count)
  {
    $start = 0;
    $start = intval($start);
    $limit = intval($count);
    try
    {
      $stmt = $this->db->prepare("SELECT * FROM `Group`
        WHERE `groupName` LIKE CONCAT(:groupName,'%')
        ORDER BY `groupName` ASC LIMIT :start, :count
        ");
      $stmt->bindParam(':groupName', $groupName);
      $stmt->bindParam(':start', $start, PDO::PARAM_INT);
      $stmt->bindParam(':count', $limit, PDO::PARAM_INT);
      $stmt->execute();
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $result;
    }
    catch(PODException $e)
    {
      echo $e->getMessage();
    }
  }

  // 좀 더 불러올때
  public function GetGroupListByName3($groupName, $lastName, $count)
  {
    $start = 0;
    $start = intval($start);
    $limit = intval($count);
    try
    {
      $stmt = $this->db->prepare("SELECT * FROM `Group`
        WHERE groupName LIKE CONCAT(:groupName,'%') AND groupName > :lastGroupName
        ORDER BY `groupName` ASC LIMIT :start, :count
        ");

      $stmt->bindParam(':groupName', $groupName);
      $stmt->bindParam(':lastGroupName', $lastName);
      $stmt->bindParam(':start', $start, PDO::PARAM_INT);
      $stmt->bindParam(':count', $limit, PDO::PARAM_INT);
      $stmt->execute();
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $result;
    }
    catch(PODException $e)
    {
      echo $e->getMessage();
    }
  }

  // 삭제하기
  public function DeleteGroup($groupName)
  {
    try
    {
      $stmt = $this->db->prepare("DELETE * FROM Account WHERE groupName = :groupName");
      $stmt->bindParam(':groupName', $groupName);
      $stmt->execute();

      return true;
    }
    catch(PODException $e)
    {
      echo $e->getMessage();
    }
  }
}
 ?>
