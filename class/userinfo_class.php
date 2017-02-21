<?php
class UserInfo{
  private $db;

  function __construct($db)
  {
    $this->db = $db;
  }

  public CreateUserInfo($id, $groupid, $name)
  {
    try
    {
      $stmt = $this->db->prepare("INSERT INTO `UserInfo`
      (`id`,`groupid`, `name`,`self_introduce`, `image_url`, `join_date`)
      VALUES(:id, :groupid, :name, :introduce, :image_url, now())");

      $id = md5($user_id);

      $stmt->bindparam(":id",$id);
      $stmt->bindparam(":groupid", $groupid);
      $stmt->bindparam(":name", $name);
      $stmt->bindparam(":introduce", "100글자 이내로 적으세요.");
      $stmt->bindparam(":image_url", "localhost\Debt_Manager\image\\temp.jpg");
      $stmt->execute();

      return $stmt;
    }
    catch (Exception $e)
    {
      echo $e->getMessage();
    }
  }

  
}
 ?>
