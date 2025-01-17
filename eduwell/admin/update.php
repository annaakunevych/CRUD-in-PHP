<?php

session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

require_once '../classes/Student.php';
require_once '../classes/AdminKurzov.php';

 use Classes\Student;
use Admin\AdminKurzov;

// Získaj ID študenta z URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    header("Location: admin.php");
    exit();
}

$admin = new AdminKurzov();

// Získame študenta z databázy
$student = $admin->getStudentById($id);

// Ak študent neexistuje
if (!$student) {
    echo "Študent neexistuje!";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Aktualizuj údaje študenta
    $student = new Classes\Student(
    $id,
    $_POST['nazov_kurzu'],
    $_POST['datum_kurzu'],
    $_POST['meno'],
    $_POST['priezvisko'],
    $_POST['pohlavie'],
    $_POST['vek'],
    $_POST['mesto_bydliska'],
    $_POST['stav_absolvovania']
);

    $admin->updateStudent($student);

    header("Location: admin.php"); 
    exit();
}

?>

<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Upraviť študenta</title>
</head>
<body>

<h2>Upraviť študenta</h2>

<form method="POST" action="update.php?id=<?= $student['id'] ?>">
    <label for="nazov_kurzu">Názov kurzu</label>
    <select name="nazov_kurzu" required>
        <option value="Web Development" <?= $student['nazov_kurzu'] == 'Web Development' ? 'selected' : '' ?>>Web Development</option>
        <option value="Graphic Design" <?= $student['nazov_kurzu'] == 'Graphic Design' ? 'selected' : '' ?>>Graphic Design</option>
        <option value="Web Design" <?= $student['nazov_kurzu'] == 'Web Design' ? 'selected' : '' ?>>Web Design</option>
        <option value="WordPress" <?= $student['nazov_kurzu'] == 'WordPress' ? 'selected' : '' ?>>WordPress</option>
    </select><br>

    <label for="datum_kurzu">Dátum kurzu</label>
    <input type="date" name="datum_kurzu" value="<?= htmlspecialchars($student['datum_kurzu']) ?>" required><br>

    <label for="meno">Meno</label>
    <input type="text" name="meno" value="<?= htmlspecialchars($student['meno']) ?>" required><br>

    <label for="priezvisko">Priezvisko</label>
    <input type="text" name="priezvisko" value="<?= htmlspecialchars($student['priezvisko']) ?>" required><br>

    <label for="pohlavie">Pohlavie</label>
    <select name="pohlavie">
        <option value="Muž" <?= $student['pohlavie'] == 'Muž' ? 'selected' : '' ?>>Muž</option>
        <option value="Žena" <?= $student['pohlavie'] == 'Žena' ? 'selected' : '' ?>>Žena</option>
    </select><br>

    <label for="vek">Vek</label>
    <input type="number" name="vek" value="<?= htmlspecialchars($student['vek']) ?>" required><br>

    <label for="mesto_bydliska">Mesto bydliska</label>
    <input type="text" name="mesto_bydliska" value="<?= htmlspecialchars($student['mesto_bydliska']) ?>" required><br>

    <label for="stav_absolvovania">Stav absolvovania</label>
    <select name="stav_absolvovania">
        <option value="Očakáva" <?= $student['stav_absolvovania'] == 'Očakáva' ? 'selected' : '' ?>>Očakáva</option>
        <option value="Študuje" <?= $student['stav_absolvovania'] == 'Študuje' ? 'selected' : '' ?>>Študuje</option>
        <option value="Absolvoval" <?= $student['stav_absolvovania'] == 'Absolvoval' ? 'selected' : '' ?>>Absolvoval</option>
    </select><br>

    <button type="submit">Uložiť zmeny</button>
</form>

</body>
</html>