<?php
define("DB_SERVER", "127.0.0.1");
define("DB_USERNAME", "root");
define("DB_PASSWORD", "");
define("DB_DATABASE", "delta");

$is_logged_in = false;
$logged_user = null;
$error_message = "";

try {
    $db = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_DATABASE . ";charset=utf8", DB_USERNAME, DB_PASSWORD);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Chyba připojení k databázi.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"] ?? '');
    $password = trim($_POST["password"] ?? '');

    if (!empty($username) && !empty($password)) {
        // Prepared statement chrání před SQL injection
        $sql = "SELECT * FROM users WHERE username = :username";
        $stmt = $db->prepare($sql);
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Kontrola, zda uživatel existuje A zda souhlasí heslo
        if ($user && $password === $user["password"]) {
            $is_logged_in = true;
            $logged_user = $user;
        } else {
            $error_message = "Nesprávné uživatelské jméno nebo heslo.";
        }
    } else {
        $error_message = "Vyplňte uživatelské jméno i heslo.";
    }
}
?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>PHP ukazka</title>
</head>
<body>

<!-- Formulář se odesílá sám na sebe -->
<form id="login" action="login.php" method="post">
    <fieldset>
        <legend>Login</legend>
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" maxlength="500"/>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" maxlength="500"/>

        <input type="submit" name="submit" value="Submit"/>
    </fieldset>
</form>

<!-- Zobrazení výstupu přímo pod formulářem -->
<?php if ($is_logged_in): ?>
    <h1>Ahoj uživateli:</h1>
    <p><?php echo htmlspecialchars($logged_user["username"]); ?></p>
<?php elseif (!empty($error_message)): ?>
    <p style="color: red;"><?php echo $error_message; ?></p>
<?php endif; ?>

</body>
</html>