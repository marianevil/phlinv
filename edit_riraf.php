<?php 
include 'db/connection.php'; 
include 'header.php'; 

$province = $_GET['province'] ?? '';
$post_office = $_GET['post_office'] ?? '';
$date = $_GET['date'] ?? '';
$inv_no = $_GET['inv_no'] ?? '';

$result = $conn->query("
    SELECT * FROM riraf_records 
    WHERE province='$province'
    AND post_office='$post_office'
    AND date='$date'
    AND inv_no='$inv_no'
");

// store all rows
$rows = [];
while($r = $result->fetch_assoc()){
    $rows[] = $r;
}

if(count($rows) == 0){
    echo "Record not found.";
    exit;
}
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
<title>Edit RIRAF</title>
<link rel="stylesheet" href="create.css">
</head>
<body>

<main class="dashboard-bg">
<div class="create-header">
    <h2>EDIT RIRAF ENTRY</h2>
</div>

<div class="create-card">

<form action="db/update_riraf.php" method="POST">
<input type="hidden" name="id" value="<?php echo $row['id']; ?>">

<!-- ROW 1 -->
<div class="form-row four-col">
    <div class="input-group">
        <label>Province:</label>
        <input type="text" name="province" value="<?php echo htmlspecialchars($row['province']); ?>" required>
    </div>

    <div class="input-group">
        <label>Date:</label>
        <input type="date" name="date" value="<?php echo $row['date']; ?>" required>
    </div>

    <div class="input-group">
        <label>INV.No.:</label>
        <input type="text" name="inv_no" value="<?php echo htmlspecialchars($row['inv_no']); ?>">
    </div>

    <div class="input-group">
        <label>Wt.:</label>
        <input type="text" name="weight" value="<?php echo htmlspecialchars($row['weight']); ?>">
    </div>

    <div class="input-group">
        <label>Post Office Name:</label>
        <input type="text" name="post_office" value="<?php echo htmlspecialchars($row['post_office']); ?>" required>
    </div>
</div>

<!-- POSTAGE / STAMPS SECTION -->
<?php foreach($rows as $r): ?>

<hr style="margin:20px 0;">

<h3>
    <?php echo strtoupper($r['type_accounts']); ?>
</h3>

<div class="form-row five-col">
    <div class="input-group">
        <label>Deno</label>
        <input type="text" name="deno[]" value="<?php echo htmlspecialchars($r['deno']); ?>">
    </div>

    <div class="input-inline">
        <label>Quantity</label>
        <input type="text" name="quantity[]" value="<?php echo htmlspecialchars($r['quantity']); ?>">
    </div>

    <div class="input-inline">
        <label>Weighted</label>
        <input type="text" name="weighted[]" value="<?php echo htmlspecialchars($r['weighted']); ?>">
    </div>

    <div class="input-inline">
        <label>Kind of Stamp</label>
        <input type="text" name="kind_stamp[]" value="<?php echo htmlspecialchars($r['kind_stamp']); ?>">
    </div>

    <div class="input-inline">
        <label>Sheet</label>
        <input type="text" name="sheet[]" value="<?php echo htmlspecialchars($r['sheet']); ?>">
    </div>
</div>

<div class="form-row five-col">
    <div></div>
    <div></div>

    <div class="input-inline">
        <label>Unit Cost</label>
        <input type="text" name="unit_cost[]" value="<?php echo htmlspecialchars($r['unit_cost']); ?>">
    </div>

    <div></div>

    <div class="input-inline">
        <label>Pieces</label>
        <input type="text" name="pieces[]" value="<?php echo htmlspecialchars($r['pieces']); ?>">
    </div>
</div>

<div class="serial-section">

    <div class="serial-row">
        <div class="input-inline">
            <label>FROM</label>
            <input type="text" name="stamp_from[]" value="<?php echo htmlspecialchars($r['stamp_from']); ?>">
        </div>

        <div class="input-inline">
            <label>TOTAL WEIGHTED</label>
            <input type="text" name="stamp_total_weighted[]" value="<?php echo htmlspecialchars($r['stamp_total_weighted']); ?>">
        </div>

        <div class="input-inline">
            <label>AMOUNT</label>
            <input type="text" name="stamp_amount[]" value="<?php echo htmlspecialchars($r['stamp_amount']); ?>">
        </div>
    </div>

    <div class="serial-row">
        <div class="input-inline">
            <label>TO</label>
            <input type="text" name="stamp_to[]" value="<?php echo htmlspecialchars($r['stamp_to']); ?>">
        </div>
    </div>

    <div class="serial-row">
        <div></div>
        <div></div>
        <div class="input-inline">
            <label>TOTAL QUANTITY</label>
            <input type="text" name="stamp_total[]" value="<?php echo htmlspecialchars($r['stamp_total']); ?>">
        </div>
    </div>

    <div class="serial-row">
        <div></div>
        <div class="input-inline">
            <label>TOTAL AMOUNT IN WORDS</label>
            <input type="text" name="stamp_total_words[]" value="<?php echo htmlspecialchars($r['stamp_total_words']); ?>">
        </div>
    </div>

</div>

<!-- IMPORTANT -->
<input type="hidden" name="ids[]" value="<?php echo $r['id']; ?>">

<?php endforeach; ?>

<!-- TODO: Add Money Order / Official Receipt / Philpost Sections the same way if needed -->

<div class="form-actions">
    <button type="submit" class="btn-save">UPDATE</button>
</div>

</form>
</div>
</main>

</body>
</html>