<?php

class Finance{
  private $db;

  function __construct()
  {
    $this->db = DB_Manager::getInstance()->pdo;
  }


  public function GenerateFinance($id, $groupid)
  {
    
  }
}

 ?>
