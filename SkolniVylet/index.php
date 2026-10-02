<?php
$students = 0;
$teachers = 0;
$transportCost = 0;
$ticketStudent = 0;
$ticketTeacher = 0;

$totalStudentTickets = 0;
$totalTeacherTickets = 0;
$totalTripCost = 0;
$costPerStudent = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $students = (float)$_POST['students'];
    $teachers = (float)$_POST['teachers'];
    $transportCost = (float)$_POST['transport_cost'];
    $ticketStudent = (float)$_POST['ticket_student'];
    $ticketTeacher = (float)$_POST['ticket_teacher'];

    $totalStudentTickets = $students * $ticketStudent;
    $totalTeacherTickets = $teachers * $ticketTeacher;
    $totalTripCost = $totalStudentTickets + $totalTeacherTickets + $transportCost;

    $costPerStudent = $totalTripCost / $students;


}
?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Výpočet ceny školního výletu</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f4f6f9; padding: 20px; display: flex; justify-content: center; }
        .card { background: white; padding: 30px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.08); max-width: 500px; width: 100%; }
        h1 { color: #2c3e50; font-size: 22px; }
        .form-row { display: flex; gap: 10px; margin-bottom: 10px; }
        .form-group { flex: 1; margin-bottom: 12px; }
        label { display: block; font-size: 13px; color: #555; font-weight: bold; margin-bottom: 4px; }
        input { width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        button { width: 100%; background: #3498db; color: white; border: none; padding: 10px; font-size: 16px; border-radius: 4px; cursor: pointer; margin-top: 10px; }
        button:hover { background: #2980b9; }
        .results { margin-top: 20px; background: #ebf5fb; border-radius: 8px; padding: 15px; }
        .results h2 { font-size: 18px; color: #2980b9; margin-top: 0; }
        ul { padding-left: 20px; margin: 0; }
        li { margin-bottom: 8px; }
    </style>
</head>
<body>

<div class="card">
    <h1>Kalkulace školního výletu</h1>
    <form method="POST" action="">
        <div class="form-row">
            <div class="form-group">
                <label>Počet studentů:</label>
                <input type="number" name="students" value="<?= htmlspecialchars($students) ?>" required min="0">
            </div>
            <div class="form-group">
                <label>Počet učitelů:</label>
                <input type="number" name="teachers" value="<?= htmlspecialchars($teachers) ?>" required min="0">
            </div>
        </div>
        <div class="form-group">
            <label>Cena dopravy za celou skupinu (Kč):</label>
            <input type="number" step="0.01" name="transport_cost" value="<?= htmlspecialchars($transportCost) ?>" required min="0">
        </div>
        <div class="form-row">
            <div class="form-group">
                <label>Vstupenka / student (Kč):</label>
                <input type="number" step="0.01" name="ticket_student" value="<?= htmlspecialchars($ticketStudent) ?>" required min="0">
            </div>
            <div class="form-group">
                <label>Vstupenka / učitel (Kč):</label>
                <input type="number" step="0.01" name="ticket_teacher" value="<?= htmlspecialchars($ticketTeacher) ?>" required min="0">
            </div>
        </div>
        <button type="submit">Spočítat náklady</button>
    </form>

    <div class="results">
        <h2>Rozpočet výletu</h2>
        <ul>
            <li>Celková cena studentských vstupenek: <?= number_format($totalStudentTickets, 2, ',', ' ') ?> Kč</li>
            <li>Celková cena vstupenek pro učitele: <?= number_format($totalTeacherTickets, 2, ',', ' ') ?> Kč</li>
            <li>Celková cena výletu: <?= number_format($totalTripCost, 2, ',', ' ') ?> Kč</li>
            <li>Částka na jednoho studenta: <?= number_format($costPerStudent, 2, ',', ' ') ?> Kč</li>
        </ul>
    </div>
</div>

</body>
</html>