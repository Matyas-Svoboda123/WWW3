<?php
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.html");
    exit;
}

$db = new PDO('mysql:host=127.0.0.1;dbname=DELTA_3B;charset=utf8', 'root', '', [PDO::ATTR_EMULATE_PREPARES => false]);

$username = $_POST["username"] ?? "";
$password = $_POST["password"] ?? "";

if (trim($username) === "" || trim($password) === "") {
    $error = "Vyplňte prosím obě položky (uživatelské jméno i heslo).";
    $user = false;
} else {
    $sql = "SELECT username, display_name FROM users WHERE username = :username AND password = :password LIMIT 1";
    $stmt = $db->prepare($sql);

    $stmt->execute([
            "username" => $username,
            "password" => $password
    ]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>Výsledek přihlášení</title>
</head>
<body>

<?php
if (isset($error)) {
    echo "<p style='color: red;'>$error</p>";
} elseif ($user !== false) {
    $jmenoKZobrazeni = !empty($user["display_name"]) ? $user["display_name"] : $user["username"];

    echo "<h1>Vítej, " . htmlspecialchars($jmenoKZobrazeni, ENT_QUOTES, 'UTF-8') . "</h1>";
} else {
    echo "<p style='color: red;'>Nesprávné uživatelské jméno nebo heslo.</p>";
}
?>

<br>
<a href="index.html">Zpět na přihlášení</a>

</body>
</html>