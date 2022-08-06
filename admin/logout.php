<?php
include("connection.php");
session_start();

unset($_SESSION["adm_id"]);
unset($_SESSION["position"]);
session_destroy();

header("location:login.php");
?>