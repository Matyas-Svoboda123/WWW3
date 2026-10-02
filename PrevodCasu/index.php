<?php
$totalSeconds = 0;

$hours = 0;
$minutes = 0;
$seconds = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $totalSeconds = (int)$_POST['seconds'];

    $hours = intdiv($totalSeconds, 3600);
    $remainingSeconds = $totalSeconds % 3600;
    $minutes = intdiv($remainingSeconds, 60);
    $seconds = $remainingSeconds % 60;
}
?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Převod času</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f9f9f9; padding: 40px; display: flex; justify-content: center; }
        .box { background: white; padding: 25px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); width: 100%; max-width: 400px; }
        input[type="number"] { width: 100%; padding: 10px; margin: 10px 0 20px 0; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        input[type="submit"] { background-color: #9b59b6; color: white; padding: 10px; border: none; border-radius: 4px; width: 100%; cursor: pointer; font-size: 16px; }
        input[type="submit"]:hover { background-color: #8e44ad; }

        .time-badge { margin-top: 20px; padding: 15px; background-color: #e8daef; border: 2px solid #8e44ad; border-radius: 8px; color: #4a235a; text-align: center; }
        .time-badge h3 { margin: 0 0 10px 0; font-size: 16px; }
        .time-badge .result { font-size: 20px; font-weight: bold; }
    </style>
</head>
<body>

<div class="box">
    <h2>Převodník sekund</h2>
    <form method="POST" action="">
        <label for="seconds">Zadejte počet sekund:</label>
        <input type="number" id="seconds" name="seconds" value="<?= htmlspecialchars($totalSeconds) ?>" min="0" required>
        <input type="submit" value="Převést čas">
    </form>

    <div class="time-badge">
        <h3>Výsledek převodu:</h3>
        <div class="result">
            <?= $hours ?> hodiny, <?= $minutes ?> minut a <?= $seconds ?> sekund
        </div>
    </div>
</div>

</body>
</html>