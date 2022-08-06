<?php
include("admin/connection.php");
session_start();

unset($_SESSION["cus_email"]);
session_destroy();

header("location:index.php");
?>