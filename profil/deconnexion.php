<?php
include('../config.php');
session_start();
unset($_SESSION['membre']);
header('Location:'.$racines.'');
?>