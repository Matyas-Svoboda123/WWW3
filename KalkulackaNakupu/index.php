<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalkulačka nákupu</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f0f2f5; padding: 20px; display: flex; justify-content: center; }
        .container { background: white; padding: 30px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); max-width: 450px; width: 100%; }
        h1 { color: #333; font-size: 24px; margin-bottom: 20px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; color: #666; font-weight: 600; }
        input { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px; box-sizing: border-box; }
        button { width: 100%; background: #4CAF50; color: white; border: none; padding: 12px; font-size: 16px; border-radius: 6px; cursor: pointer; margin-top: 10px; }
        button:hover { background: #45a049; }
        .summary { margin-top: 25px; padding: 15px; background: #e8f5e9; border-left: 5px solid #4CAF50; border-radius: 4px; }
        .summary p { margin: 8px 0; color: #2e7d32; }
    </style>
</head>
<body>

<div class="container">
    <h1>Kalkulačka nákupu</h1>
    <form method="POST">
        <div class="form-group">
            <label>Název produktu:</label>
            <input type="text" name="product_name" value="<?= htmlspecialchars($_POST['product_name'] ?? 'Produkt') ?>" required>
        </div>
        <div class="form-group">
            <label>Cena jednoho kusu (Kč):</label>
            <input type="number" step="0.01" name="price_per_item" value="<?= htmlspecialchars($_POST['price_per_item'] ?? '0') ?>" required>
        </div>
        <div class="form-group">
            <label>Počet kusů:</label>
            <input type="number" name="quantity" value="<?= htmlspecialchars($_POST['quantity'] ?? '0') ?>" required>
        </div>
        <div class="form-group">
            <label>Cena dopravy (Kč):</label>
            <input type="number" step="0.01" name="shipping_price" value="<?= htmlspecialchars($_POST['shipping_price'] ?? '0') ?>" required>
        </div>
        <button type="submit">Spočítat nákup</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $productName = $_POST['product_name'];
        $pricePerItem = (float)$_POST['price_per_item'];
        $quantity = (int)$_POST['quantity'];
        $shippingPrice = (float)$_POST['shipping_price'];

        // Výpočty
        $itemsTotalPrice = $pricePerItem * $quantity;
        $totalPrice = $itemsTotalPrice + $shippingPrice;
        $avgPricePerItemWithShipping = $quantity > 0 ? ($totalPrice / $quantity) : 0;
        ?>

        <div class="summary">
            <h3>Shrnutí objednávky</h3>
            <p><strong>Cena zboží bez dopravy:</strong> <?= number_format($itemsTotalPrice, 2, ',', ' ') ?> Kč</p>
            <p><strong>Celková cena objednávky:</strong> <?= number_format($totalPrice, 2, ',', ' ') ?> Kč</p>
            <p><strong>Průměrná cena za kus vč. dopravy:</strong> <?= number_format($avgPricePerItemWithShipping, 2, ',', ' ') ?> Kč</p>
        </div>

    <?php } ?>
</div>

</body>
</html>