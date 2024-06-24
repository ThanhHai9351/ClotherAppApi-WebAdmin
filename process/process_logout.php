<?php 
session_start();
unset($_SESSION['Role']);

header("location: ../home/index.php");
