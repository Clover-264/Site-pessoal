<?php
require_once "sessao.php";
$_SESSION = [];
session_destroy();
header("Location: login.php");
exit;
?>
