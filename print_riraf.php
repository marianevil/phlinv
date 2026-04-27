<?php 
include 'db/connection.php';

// GET parameters (same sa edit)
$province = $_GET['province'] ?? '';
$post_office = $_GET['post_office'] ?? '';
$date = $_GET['date'] ?? '';
$inv_no = $_GET['inv_no'] ?? '';

// FETCH ALL MATCHING ROWS
$result = $conn->query("
    SELECT * FROM riraf_records 
    WHERE province='$province'
    AND post_office='$post_office'
    AND date='$date'
    AND inv_no='$inv_no'
");

// STORE ROWS
$rows = [];
while($r = $result->fetch_assoc()){
    $rows[] = $r;
}

if(count($rows) == 0){
    echo "Record not found.";
    exit;
}

// GROUP BY TYPE
$grouped = [];
foreach($rows as $r){
    $type = $r['type_accounts'] ?? 'OTHERS';
    $grouped[$type][] = $r;
}

// first row for header
$row = $rows[0];
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Print RIRAF</title>
<link rel="stylesheet" href="create.css">

<style>
@media print {
    body { background: white; }
    .no-print { display: none; }
    .create-card { box-shadow: none; border: none; }
}

.print-field {
    border-bottom: 1px solid #000;
    padding: 3px 5px;
    min-height: 18px;
}

.stamp-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 15px;
    font-size: 13px;
}

.stamp-table th,
.stamp-table td {
    border: 1px solid black;
    padding: 6px;
    text-align: center;
}

.stamp-table th {
    background: #f2f2f2;
    font-weight: bold;
}

.stamp-total {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
}

.stamp-total td {
    border: 1px solid black;
    padding: 8px;
}
</style>
</head>

<body onload="window.print()">

<main class="dashboard-bg">

<div class="create-header">
    <h2>RIRAF RECORD</h2>
</div>

<div class="create-card">

<!-- HEADER -->
<div class="form-row four-col">

    <div class="input-group">
        <label>Province:</label>
        <div class="print-field"><?php echo $row['province']; ?></div>
    </div>

    <div class="input-group">
        <label>Date:</label>
        <div class="print-field"><?php echo $row['date']; ?></div>
    </div>

    <div class="input-group">
        <label>INV.No.:</label>
        <div class="print-field"><?php echo $row['inv_no']; ?></div>
    </div>

    <div class="input-group">
        <label>Wt.:</label>
        <div class="print-field"><?php echo $row['weight']; ?></div>
    </div>

    <div class="input-group">
        <label>Post Office Name:</label>
        <div class="print-field"><?php echo $row['post_office']; ?></div>
    </div>

</div>

<!-- ================= GROUPED TABLES ================= -->
<?php foreach($grouped as $type => $items): ?>

<h3 style="margin-top:25px;"><?php echo strtoupper($type); ?></h3>

<table class="stamp-table">
<thead>
<tr>
    <th>Deno</th>
    <th>Qty</th>
    <th>Weighted</th>
    <th>Unit Cost</th>
    <th>Kind of Stamp</th>
    <th>Sheet</th>
    <th>From</th>
    <th>To</th>
    <th>Total Weighted</th>
    <th>Amount</th>
</tr>
</thead>

<tbody>
<?php 
$totalQty = 0;
$totalAmount = 0;

foreach($items as $r): 

    // FIX numeric error
    $qty = (float) str_replace(',', '', $r['stamp_total']);
    $amount = (float) str_replace(',', '', $r['stamp_amount']);

    $totalQty += $qty;
    $totalAmount += $amount;
?>
<tr>
    <td><?php echo $r['deno']; ?></td>
    <td><?php echo $r['quantity']; ?></td>
    <td><?php echo $r['weighted']; ?></td>
    <td><?php echo $r['unit_cost']; ?></td>
    <td><?php echo $r['kind_stamp']; ?></td>
    <td><?php echo $r['sheet']; ?></td>
    <td><?php echo $r['stamp_from']; ?></td>
    <td><?php echo $r['stamp_to']; ?></td>
    <td><?php echo $r['stamp_total_weighted']; ?></td>
    <td><?php echo $r['stamp_amount']; ?></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>

<!-- TOTAL PER TYPE -->
<table class="stamp-total">
<tr>
    <td><b>Total Quantity (<?php echo $type; ?>):</b> <?php echo $totalQty; ?></td>
</tr>
<tr>
    <td><b>Total Amount (<?php echo $type; ?>):</b> <?php echo number_format($totalAmount, 2); ?></td>
</tr>
</table>

<hr style="margin:30px 0;">

<?php endforeach; ?>

<!-- PRINT AGAIN -->
<div class="no-print" style="margin-top:20px;">
    <button onclick="window.print()">Print Again</button>
</div>

</div>
</main>

</body>
</html>