<?php
$pizzaName = '';
$pizzaCount = 0;
$pizzaPrice = 0;
$drinkCount = 0;
$drinkPrice = 0;
$deliveryPrice = 0;
$peopleCount = 0;

$pizzasTotal = 0;
$drinksTotal = 0;
$grandTotal = 0;
$pricePerPerson = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pizzaName = $_POST['pizza_name'];
    $pizzaCount = (int)$_POST['pizza_count'];
    $pizzaPrice = (float)$_POST['pizza_price'];
    $drinkCount = (int)$_POST['drink_count'];
    $drinkPrice = (float)$_POST['drink_price'];
    $deliveryPrice = (float)$_POST['delivery_price'];
    $peopleCount = (int)$_POST['people_count'];

    $pizzasTotal = $pizzaCount * $pizzaPrice;
    $drinksTotal = $drinkCount * $drinkPrice;
    $grandTotal = $pizzasTotal + $drinksTotal + $deliveryPrice;


    $pricePerPerson = $grandTotal / $peopleCount;

}
?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Objednávka pizzy</title>
    <style>
        body { font-family: 'Courier New', Courier, monospace; background-color: #f3e5f5; padding: 20px; display: flex; justify-content: center; }
        .wrapper { background: #fff; width: 100%; max-width: 420px; padding: 20px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.15); }
        .receipt { background: #fffde7; border: 1px dashed #999; padding: 20px; margin-top: 20px; font-size: 14px; }
        .receipt h1 { font-size: 20px; text-align: center; margin-top: 0; text-transform: uppercase; border-bottom: 2px dashed #333; padding-bottom: 10px; }
        ul { list-style: none; padding: 0; margin: 15px 0; }
        li { display: flex; justify-content: space-between; margin-bottom: 8px; }
        .total { font-size: 16px; font-weight: bold; border-top: 2px dashed #333; border-bottom: 2px dashed #333; padding: 10px 0; margin-top: 10px; text-align: right; }
        .per-person { background: #d1c4e9; padding: 8px; font-weight: bold; margin-top: 10px; text-align: center; font-size: 15px; }
        .form-control { margin-bottom: 8px; }
        .form-control label { font-family: sans-serif; font-size: 12px; display: block; }
        .form-control input { width: 100%; padding: 6px; box-sizing: border-box; }
        button { width: 100%; padding: 10px; background: #673ab7; color: white; border: none; font-weight: bold; cursor: pointer; margin-top: 10px; }
    </style>
</head>
<body>

<div class="wrapper">
    <form method="POST" action="">
        <div class="form-control">
            <label>Název pizzy:</label>
            <input type="text" name="pizza_name" value="<?= htmlspecialchars($pizzaName) ?>" required>
        </div>
        <div class="form-control">
            <label>Počet pizz / cena za 1 ks (Kč):</label>
            <div style="display:flex; gap:5px;">
                <input type="number" name="pizza_count" value="<?= htmlspecialchars($pizzaCount) ?>" required min="0">
                <input type="number" step="0.01" name="pizza_price" value="<?= htmlspecialchars($pizzaPrice) ?>" required min="0">
            </div>
        </div>
        <div class="form-control">
            <label>Počet objednaných nápojů / cena za 1 ks (Kč):</label>
            <div style="display:flex; gap:5px;">
                <input type="number" name="drink_count" value="<?= htmlspecialchars($drinkCount) ?>" required min="0">
                <input type="number" step="0.01" name="drink_price" value="<?= htmlspecialchars($drinkPrice) ?>" required min="0">
            </div>
        </div>
        <div class="form-control">
            <label>Cena dopravy (Kč):</label>
            <input type="number" step="0.01" name="delivery_price" value="<?= htmlspecialchars($deliveryPrice) ?>" required min="0">
        </div>
        <div class="form-control">
            <label>Počet lidí, kteří se o objednávku rozdělí:</label>
            <input type="number" name="people_count" value="<?= htmlspecialchars($peopleCount) ?>" required min="0">
        </div>
        <button type="submit">Vystavit účtenku</button>
    </form>

    <div class="receipt">
        <h1>Účtenka</h1>
        <ul>
            <li>
                <span>Cena všech pizz:</span>
                <span><?= number_format($pizzasTotal, 2, ',', ' ') ?> Kč</span>
            </li>
            <li>
                <span>Cena všech nápojů:</span>
                <span><?= number_format($drinksTotal, 2, ',', ' ') ?> Kč</span>
            </li>
            <li>
                <span>Cena dopravy:</span>
                <span><?= number_format($deliveryPrice, 2, ',', ' ') ?> Kč</span>
            </li>
        </ul>

        <div class="total">
            Celková cena objednávky: <?= number_format($grandTotal, 2, ',', ' ') ?> Kč
        </div>

        <div class="per-person">
            Částka připadající na jednoho člověka: <?= number_format($pricePerPerson, 2, ',', ' ') ?> Kč
        </div>
    </div>
</div>

</body>
</html>