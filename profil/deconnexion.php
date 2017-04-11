<?php
include('../config.php');
session_start();
unset($_SESSION['user']);
unset($_SESSION['userid']);
header('Location:'.$racines.'');
?>