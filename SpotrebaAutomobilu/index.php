<?php
$distance = 0;
$fuel = 0;
$pricePerLiter = 0;

$avgConsumption = 0;
$totalFuelCost = 0;
$costPerKm = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $distance = (float)$_POST['distance'];
    $fuel = (float)$_POST['fuel'];
    $pricePerLiter = (float)$_POST['price_per_liter'];

    $avgConsumption = ($fuel / $distance) * 100;
    $totalFuelCost = $fuel * $pricePerLiter;
    $costPerKm = $totalFuelCost / $distance;

}
?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalkulačka spotřeby automobilu</title>
    <style>
        body { font-family: system-ui, -apple-system, sans-serif; background: #eceff1; padding: 20px; display: flex; justify-content: center; }
        .container { background: white; padding: 30px; border-radius: 8px; width: 100%; max-width: 500px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .form-group { margin-bottom: 12px; }
        label { display: block; margin-bottom: 4px; font-weight: 600; color: #37474f; }
        input { width: 100%; padding: 8px; border: 1px solid #b0bec5; border-radius: 4px; box-sizing: border-box; }
        button { width: 100%; background: #607d8b; color: white; padding: 10px; border: none; border-radius: 4px; font-size: 16px; cursor: pointer; margin-top: 10px; }
        button:hover { background: #455a64; }

        table { width: 100%; border-collapse: collapse; margin-top: 25px; }
        th, td { border: 1px solid #cfd8dc; padding: 10px; text-align: left; }
        th { background-color: #f1f8e9; color: #33691e; }
        tr:nth-child(even) { background-color: #f9f9f9; }
    </style>
</head>
<body>

<div class="container">
    <h2>Kalkulačka spotřeby automobilu</h2>
    <form method="POST" action="">
        <div class="form-group">
            <label>Počet ujetých kilometrů:</label>
            <input type="number" step="0.01" name="distance" value="<?= htmlspecialchars($distance) ?>" required min="0">
        </div>
        <div class="form-group">
            <label>Množství spotřebovaného paliva (v litrech):</label>
            <input type="number" step="0.01" name="fuel" value="<?= htmlspecialchars($fuel) ?>" required min="0">
        </div>
        <div class="form-group">
            <label>Cena jednoho litru paliva (Kč):</label>
            <input type="number" step="0.01" name="price_per_liter" value="<?= htmlspecialchars($pricePerLiter) ?>" required min="0">
        </div>
        <button type="submit">Spočítat spotřebu</button>
    </form>

    <table>
        <thead>
        <tr>
            <th>Ukazatel</th>
            <th>Hodnota</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>Průměrná spotřeba na 100 km</td>
            <td><?= number_format($avgConsumption, 2, ',', ' ') ?> l</td>
        </tr>
        <tr>
            <td>Celková cena spotřebovaného paliva</td>
            <td><?= number_format($totalFuelCost, 2, ',', ' ') ?> Kč</td>
        </tr>
        <tr>
            <td>Cena jednoho ujetého kilometru</td>
            <td><?= number_format($costPerKm, 2, ',', ' ') ?> Kč</td>
        </tr>
        </tbody>
    </table>
</div>

</body>
</html>