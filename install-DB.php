<?php
  require_once("./class/account_class.php");

  $db_manager = DB_Manager::getInstance();
  $db_manager->resetDB();

  $sql_query_address = './sql.dat';

  $db_manager->execQueryfile($sql_query_address,"-----");

  $Account = new Account();

  $adminName = "admin";
  $password = "1stmit-games*^^*";
  $username = "admin";
  $email = "sounghoo12@gmail.com";

  $Account->AddAdmin($adminName, $password, $username,$email);
?>
