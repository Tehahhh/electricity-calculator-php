<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Electricity Calculator</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="calculator">
        <h2>Calculate</h2>
        <form method="POST">
            <label>Voltage</label>
            <input type="number" step="any" name="voltage" value="<?php echo $_POST['voltage'] ?? ''; ?>" required>
            <span>Voltage (V)</span>

            <label>Current</label>
            <input type="number" step="any" name="current" value="<?php echo $_POST['current'] ?? ''; ?>" required>
            <span>Ampere (A)</span>

            <label>Current Rate</label>
            <input type="number" step="any" name="rate" value="<?php echo $_POST['rate'] ?? ''; ?>" required>
            <span>sen/kWh</span>

            <button type="submit">Calculate</button>
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $V = $_POST['voltage'];
            $A = $_POST['current'];
            $rate = $_POST['rate'];

            // Calculate power (kW) and total charge (RM)
            $power_kW = ($V * $A) / 1000; // Power in kW
            $total_RM = $power_kW * ($rate / 100); // Total charge in RM

            echo "<div class='results'>";
            echo "<p>POWER : " . number_format($power_kW, 5) . " kW</p>";
            echo "<p>RATE : " . number_format($total_RM, 3) . " RM</p>";
            echo "</div>";
        }
        ?>
    </div>
</body>
</html>
