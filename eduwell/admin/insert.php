<?php
require_once '../classes/Student.php';
require_once '../classes/AdminKurzov.php';

use Classes\Student;
use Admin\AdminKurzov;

$admin = new Admin\AdminKurzov();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student = new Classes\Student(
	null,
        $_POST['nazov_kurzu'],
        $_POST['datum_kurzu'],
        $_POST['meno'],
        $_POST['priezvisko'],
        $_POST['pohlavie'],
        $_POST['vek'],
        $_POST['mesto_bydliska'],
        $_POST['stav_absolvovania']
    );

    if ($admin->addStudent($student)) {
        echo "Študent bol úspešne pridaný!";
    } else {
        echo "Chyba pri pridávaní študenta.";
    }
}
?>

<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <title>Pridať študenta</title>
</head>
<body>
    <h2>Pridať študenta</h2>
    <form action="insert.php" method="post">
        <label>Názov kurzu:</label>
        <select name="nazov_kurzu" required>
            <option value="Web Development">Web Development</option>
            <option value="Graphic Design">Graphic Design</option>
            <option value="Web Design">Web Design</option>
            <option value="WordPress">WordPress</option>
        </select>
        <br><br>

        <label>Dátum kurzu:</label>
        <input type="date" name="datum_kurzu" required>
        <br><br>

        <label>Meno:</label>
        <input type="text" name="meno" required>
        <br><br>

        <label>Priezvisko:</label>
        <input type="text" name="priezvisko" required>
        <br><br>

        <label>Pohlavie:</label>
        <select name="pohlavie" required>
            <option value="Muž">Muž</option>
            <option value="Žena">Žena</option>
        </select>
        <br><br>

        <label>Vek:</label>
        <input type="number" name="vek" required>
        <br><br>

        <label>Mesto bydliska:</label>
        <input type="text" name="mesto_bydliska" required>
        <br><br>

        <label>Stav absolvovania:</label>
        <select name="stav_absolvovania" required>
            <option value="Očakáva">Očakáva</option>
            <option value="Študuje">Študuje</option>
            <option value="Absolvoval">Absolvoval</option>
        </select>
        <br><br>

        <button type="submit">Pridať študenta</button>
    </form>

    <br>
    <a href="admin.php">Späť na zoznam študentov</a>
</body>
</html>
