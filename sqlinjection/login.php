<?php
/*
define("DB_SERVER", "127.0.0.1");

define("DB_USERNAME", "root");

define("DB_PASSWORD", "");

define("DB_DATABASE", "delta");



$db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);



if($_SERVER["REQUEST_METHOD"] == "POST"){

    $username = $_POST["username"];

    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE username = '$username';";

    $result = mysqli_query($db, $sql);

}

*/

$db = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', '');

?>





<html>

<head>



</head>

<body>

<h1>Ahoj uživateli:</h1>

<?php
/*
while($row = mysqli_fetch_array($result)){

    echo $row["username"] . " " .$row["password"] . "<br>";



}

*/

?>

</body>

</html> a html <!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <title>PHP ukazka</title>

</head>

<body>

<form id="login" action="login.php" method="post">

    <fieldset>

        <legend>Login</legend>

        <label for="username"></label>Username:</label>

        <input type="text" name="username" id="username" maxlength="500"/>



        <label for="password">Password</label>

        <input type="text" name="password" id="password" maxlength="500"/>



        <input type="submit" name="submit" value="Submit"/>

    </fieldset>

</form>

</body>

</html>