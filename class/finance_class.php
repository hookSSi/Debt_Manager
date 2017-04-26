<?php

class Finance{
  private $db;

  function __construct()
  {
    $this->db = DB_Manager::getInstance()->pdo;
  }

  public function CreateFinance($id, $groupid)
  {
    try { // 이미 있는 지 확인
      $stmt = $this->db->prepare("SELECT * FROM Finance
                                  WHERE id = :id
                                  AND groupid = :groupid");
      $stmt->bindparam(":id",$id);
      $stmt->bindparam(":groupid",$groupid);
      $stmt->execute();
      $financeList = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    catch (Exception $e) {
      echo $e->getMessage();
    }

    if(count($financeList) == 0){ // 없다면 새로 생성
      try
      {
        $stmt = $this->db->prepare("INSERT INTO Finance
        (`id`,`groupid`)
        VALUES(:id, :groupid)");

        $stmt->bindparam(":id",$id);
        $stmt->bindparam(":groupid", $groupid);
        $stmt->execute();

        return true;
      }
      catch (Exception $e)
      {
        echo $e->getMessage();
      }

      echo("success");
    }
    else{ // 있다면 알림만 보냄
      echo("you already have");
    }
    return false;
  }

  public function GetFinanceId($id, $groupid)
  {
    try {
      $stmt = $this->db->prepare("SELECT financeid
                                  FROM `Finance`
                                  WHERE `groupid` = :groupid
                                  AND `id` = :id");
      $stmt->bindparam(":id", $id);
      $stmt->bindparam(":groupid", $groupid);
      $stmt->execute();

      $financeId = $stmt->fetchColumn();
      return $financeId;
    }
    catch (Exception $e) {
      echo $e->getMessage();
    }
  }

  public function SendMoney($id, $other_id, $groupid, $moneyValue)
  {
    try {
      // 돈 플러스
      $stmt = $this->db->prepare("UPDATE `Finance`
                                  SET `total_money` = `total_money` + :moneyValue
                                  WHERE `financeid` = :financeid");
      $stmt->bindparam(":moneyValue", $moneyValue, PDO::PARAM_INT);
      $financeId = GetFinanceId($id, $groupid);
      $stmt->bindparam(":financeid",$financeId);
      $stmt->execute();

      // 돈 마이너스
      $stmt = $this->db->prepare("UPDATE `Finance`
                                  SET `total_money` = `total_money` + :moneyValue
                                  WHERE `financeid` = :financeid");
      $stmt->bindparam(":moneyValue", $moneyValue * -1, PDO::PARAM_INT);
      $other_financeId = GetFinanceId($other_id, $groupid);
      $stmt->bindparam(":financeid",$other_financeId);
      $stmt->execute();

      $this->Record($financeId, $moneyValue, 'PLUS');
      $this->Record($other_financeId, $moneyValue * -1, 'MINUS');
    }
    catch (Exception $e) {
      echo $e->getMessage();
    }
  }

  private function Record($financeid, $moneyValue, $type)
  {
    try
    {
      $stmt = $this->db->prepare("INSERT INTO Finance
      (`financeid`,`money`,`date`,`type`)
      VALUES(:financeid, :moneyValue, now(), :type)");

      $stmt->bindparam(":financeid",$financeid);
      $stmt->bindparam(":moneyValue", $moneyValue, PDO::PARAM_INT);
      $stmt->bindparam(":type", $type);
      $stmt->execute();

      return true;
    }
    catch (Exception $e)
    {
      echo $e->getMessage();
    }
  }
}

 ?>
