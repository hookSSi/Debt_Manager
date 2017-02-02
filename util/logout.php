<?php
require_once("../class/db_class.php");
require_once("../class/account_class.php");

$db_manager = new DB_Manager();

$Account = new Account($db_manager->pdo);

$Account->logout();
$Account->redirect('../login-page.php');
?>
