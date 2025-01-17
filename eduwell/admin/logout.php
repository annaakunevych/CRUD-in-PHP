<?php
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

session_start();
session_unset();
session_destroy();
header("Location: ../index.php"); // Presmerovanie na hlavnú stránku
exit();
?>