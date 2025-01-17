<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

require_once "../classes/AdminKurzov.php";
use Admin\AdminKurzov;

// Získam ID študenta z URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    header("Location: admin.php"); 
    exit();
}

$admin = new AdminKurzov();

// Vymaž študenta
if ($admin->deleteStudent($id)) {
    header("Location: admin.php");
    exit();
} else {
    echo "Chyba pri vymazávaní študenta!";
}
?>