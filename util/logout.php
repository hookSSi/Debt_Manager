<?php
require_once("../class/account_class.php");

$Account = new Account();

$Account->logout();
$Account->redirect('../login-page.php');
?>
