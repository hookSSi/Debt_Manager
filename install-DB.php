<?php
  require_once("./class/db_class.php");
  require_once("./class/account_class.php");

  $db_manager = new DB_Manager(true);

  $sql_query_address = './sql.dat';

  $db_manager->execQueryfile($sql_query_address,"-----");

  $Account = new Account($db_manager->pdo);

  $adminName = "admin";
  $password = "1stmit-games*^^*";
  $username = "admin";
  $email = "sounghoo12@gmail.com";

  $Account->AddAdmin($adminName, $password, $username,$email);
?>
