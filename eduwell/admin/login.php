<?php

header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

session_start();
// Admin prihlasovacie údaje 
$admin_username = "AnnaAdmin";
$admin_password = "jasomadmin"; // Môže byť hashované cez password_hash()

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Overenie prihlasovacích údajov
    if ($username === $admin_username && $password === $admin_password) {
        $_SESSION['admin'] = true; 
        header("Location: admin.php"); 
        exit();
    } else {
        $error = "Nesprávne meno alebo heslo.";
    }
}
?>

<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <title>Admin Prihlásenie</title>
</head>
<body>
    <h2>Prihlásenie pre admina</h2>
    <?php if (!empty($error)) echo "<p style='color: red;'>$error</p>"; ?>
    <form method="post">
        <label>Meno:</label>
        <input type="text" name="username" required><br>
        <label>Heslo:</label>
        <input type="password" name="password" required><br>
        <button type="submit">Prihlásiť sa</button>
    </form>
</body>
</html>

<?php

include('../casti_stranky/footer.php');
?>