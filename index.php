<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Electricity Calculator</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="calculator">
    <h2>Calculate</h2>

    <form method="POST">
        <label>Voltage</label>
        <input type="number" step="any" name="voltage" required>
        <span>Voltage (V)</span>

        <label>Current</label>
        <input type="number" step="any" name="current" required>
        <span>Ampre (A)</span>

        <label>CURRENT RATE</label>
        <input type="number" step="any" name="rate" required>
        <span>sen/kWh</span>

        <button type="submit">calculate</button>
    </form>

<?php
function CalcElectric24H($V, $A, $rate)
{
    $power = ($V * $A) / 1000; 
    $data = [];

    for ($hour = 1; $hour <= 24; $hour++) {
        $energy = $power * $hour;   
        $total  = $energy * ($rate / 100); 

        $data[] = [
            'hour' => $hour,
            'energy' => $energy,
            'total' => $total
        ];
    }
    return [$power, $data];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $V = $_POST['voltage'];
    $A = $_POST['current'];
    $rate = $_POST['rate'];

    list($power_kW, $result) = CalcElectric24H($V, $A, $rate);
?>
    <div class="results">
        <p>POWER : <?php echo number_format($power_kW, 5); ?>kw</p>
        <p>RATE : <?php echo number_format(end($result)['total'], 3); ?>RM</p>
    </div>
    <table>
        <tr>
            <th>#</th>
            <th>Hour</th>
            <th>Energy (kWh)</th>
            <th>TOTAL (RM)</th>
        </tr>
        <?php $i = 1; foreach ($result as $row) { ?>
        <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo $row['hour']; ?></td>
            <td><?php echo number_format($row['energy'], 5); ?></td>
            <td><?php echo number_format($row['total'], 2); ?></td>
        </tr>
        <?php } ?>
    </table>

<?php } ?>
</div>
</body>
</html>
