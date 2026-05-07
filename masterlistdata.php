<?php
include 'db/connection.php';
include 'header.php';

// FILTER
$provinceFilter = $_GET['province'] ?? '';

// PAGINATION
$rowsPerPage = 10;
$currentPage = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$offset = ($currentPage - 1) * $rowsPerPage;

// WHERE CONDITION
$where = "WHERE 1=1";

if ($provinceFilter != "" && $provinceFilter != "Select Province") {
    $safeProvince = $conn->real_escape_string($provinceFilter);
    $where .= " AND r.province = '$safeProvince'";
}

/* ===================== COUNT TOTAL ===================== */
$totalQuery = $conn->query("
    SELECT COUNT(*) AS total
    FROM riraf_records r
    LEFT JOIN riraf_postoffice p 
        ON TRIM(r.post_office) = TRIM(p.name)
    $where
");

$totalRow = $totalQuery->fetch_assoc();
$totalRows = $totalRow['total'];
$totalPages = ceil($totalRows / $rowsPerPage);

/* ===================== FETCH DATA ===================== */
$query = $conn->query("
    SELECT 
        r.*, 
        p.zip AS zip_code
    FROM riraf_records r
    LEFT JOIN riraf_postoffice p 
        ON TRIM(r.post_office) = TRIM(p.name)
    $where
    ORDER BY r.province, r.post_office, r.date DESC
    LIMIT $offset, $rowsPerPage
");

$rows = [];
while ($row = $query->fetch_assoc()) {
    $rows[] = $row;
}
?>

<link rel="stylesheet" href="masterlist.css">

<main class="dashboard-bg">

<div class="masterlist-title">
    MASTER LIST DATA
</div>

<!-- DELETE THIS DESCRIPTION LATER, FOR NOW JUST FOR REFERENCE -->
<div class="card-desc">
    <p>
        This Master List module displays consolidated records generated from the RIRAF system. It serves as a summarized view of all transactions across provinces and post offices, including type of accounts, invoice numbers, and delivery details.
</div>

<div class="masterlist-card">

<!-- FILTER -->
<form method="GET">
<div class="filter-row">

<div class="filter-left">
<label>Province:</label>
<select name="province" onchange="this.form.submit()">
<option value="">Select Province</option>

<?php
$provQuery = $conn->query("SELECT name FROM riraf_province ORDER BY name ASC");

while ($prov = $provQuery->fetch_assoc()) {
$selected = ($provinceFilter == $prov['name']) ? "selected" : "";
echo "<option value='".htmlspecialchars($prov['name'])."' $selected>
".htmlspecialchars($prov['name'])."
</option>";
}
?>
</select>
</div>

<div class="filter-right">
<button type="button" class="export-btn">
<img src="images/excel.png">
Export Excel
</button>
</div>

</div>
</form>

<!-- SEARCH -->
<div class="table-header">
<h3>Province</h3>

<div class="table-search">
<input type="text" id="searchInput" placeholder="Search...">
</div>
</div>

<!-- TABLE -->
<table class="masterlist-table" id="masterTable">

<thead>
<tr>
<th>Date</th>
<th>Province</th>
<th>Post Office</th>
<th>Type of Account</th>
<th>INV.No.</th>
<th>Zip Code</th>
<th>Delivered Office</th>
</tr>
</thead>

<tbody>

<?php

$total = count($rows);

if ($total > 0) {

for ($i = 0; $i < $total; $i++) {

echo "<tr>";

echo "<td>".$rows[$i]['date']."</td>";

/* PROVINCE ROWSPAN */
if ($i == 0 || $rows[$i]['province'] != $rows[$i-1]['province']) {

$rowspan = 1;

for ($j = $i + 1; $j < $total; $j++) {

if ($rows[$j]['province'] == $rows[$i]['province']) {
$rowspan++;
} else {
break;
}

}

echo "<td rowspan='$rowspan'>".$rows[$i]['province']."</td>";

}

/* POST OFFICE ROWSPAN */
if ($i == 0 || 
$rows[$i]['post_office'] != $rows[$i-1]['post_office'] ||
$rows[$i]['province'] != $rows[$i-1]['province']
) {

$rowspan2 = 1;

for ($j = $i + 1; $j < $total; $j++) {

if (
$rows[$j]['post_office'] == $rows[$i]['post_office'] &&
$rows[$j]['province'] == $rows[$i]['province']
) {
$rowspan2++;
} else {
break;
}

}

echo "<td rowspan='$rowspan2'>".$rows[$i]['post_office']."</td>";

}

echo "<td>".$rows[$i]['type_accounts']."</td>";
echo "<td>".$rows[$i]['inv_no']."</td>";
echo "<td>".($rows[$i]['zip_code'] ?? '-')."</td>";
echo "<td>".($rows[$i]['delivered_office'] ?? '-')."</td>";

echo "</tr>";

}

} else {

echo "<tr><td colspan='7'>No records found</td></tr>";

}

?>

</tbody>

</table>

<!-- PAGINATION -->
<div class="pagination">

<button class="prev"
<?php if ($currentPage <= 1) echo "disabled"; ?>
onclick="window.location='?province=<?php echo urlencode($provinceFilter) ?>&page=<?php echo $currentPage-1 ?>'">
PREVIOUS
</button>

<div class="page-num">
<span class="active"><?php echo $currentPage ?></span>
</div>

<button class="next"
<?php if ($currentPage >= $totalPages) echo "disabled"; ?>
onclick="window.location='?province=<?php echo urlencode($provinceFilter) ?>&page=<?php echo $currentPage+1 ?>'">
NEXT
</button>

</div>

</div>

</main>

<!-- SEARCH -->
<script>
document.getElementById("searchInput").addEventListener("keyup", function () {

let value = this.value.toLowerCase();
let rows = document.querySelectorAll("#masterTable tbody tr");

rows.forEach(row => {

row.style.display = row.innerText.toLowerCase().includes(value)
? ""
: "none";

});

});
</script>