<?php
include 'db/connection.php';
include 'header.php';

// FILTER
$provinceFilter = $_GET['province'] ?? '';

// PAGINATION
$rowsPerPage = 10;
$currentPage = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;

// WHERE CONDITION
$where = "";
if($provinceFilter != "" && $provinceFilter != "Select Province"){
    $safeProvince = $conn->real_escape_string($provinceFilter);
    $where = "WHERE province = '$safeProvince'";
}

// COUNT TOTAL
$totalQuery = $conn->query("SELECT COUNT(*) AS total FROM riraf_records $where");
$totalRow = $totalQuery->fetch_assoc();
$totalRows = $totalRow['total'];

$totalPages = ceil($totalRows / $rowsPerPage);
$offset = ($currentPage - 1) * $rowsPerPage;

// FETCH DATA
$query = $conn->query("
    SELECT *
    FROM riraf_records
    $where
    ORDER BY date DESC
    LIMIT $offset, $rowsPerPage
");
?>

<link rel="stylesheet" href="masterlist.css">

<main class="dashboard-bg">

<div class="masterlist-title">
    MASTER LIST DATA
</div>

<div class="masterlist-card">

    <!-- FILTER ROW -->
    <form method="GET">
        <div class="filter-row">
            
            <div class="filter-left">
                <label>Province:</label>
                <select name="province" onchange="this.form.submit()">
                    <option value="">Select Province</option>

                    <?php
                    $provQuery = $conn->query("SELECT name FROM riraf_province ORDER BY name ASC");

                    while($prov = $provQuery->fetch_assoc()){
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

    <!-- HEADER -->
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
            if($query->num_rows > 0){

                $currentProvince = "";
                $provinceCounts = [];

                // 👉 STEP 1: Count rows per province
                $tempQuery = $conn->query("
                    SELECT province, COUNT(*) as total
                    FROM riraf_records
                    $where
                    GROUP BY province
                ");

                while($rowCount = $tempQuery->fetch_assoc()){
                    $provinceCounts[$rowCount['province']] = $rowCount['total'];
                }

                // 👉 STEP 2: Loop main data
                while($row = $query->fetch_assoc()){

                    echo "<tr>";

                    echo "<td>".$row['date']."</td>";

                    // 👉 SHOW province only first time
                    if($currentProvince != $row['province']){
                        $rowspan = $provinceCounts[$row['province']];
                        echo "<td rowspan='$rowspan'>".$row['province']."</td>";
                        $currentProvince = $row['province'];
                    }

                    echo "<td>".$row['post_office']."</td>";
                    echo "<td>".$row['type_accounts']."</td>";
                    echo "<td>".$row['inv_no']."</td>";
                    echo "<td>".($row['zip_code'] ?? '-')."</td>";
                    echo "<td>".($row['delivered_office'] ?? '-')."</td>";

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
            <?php if($currentPage <= 1) echo "disabled"; ?>
            onclick="window.location='?province=<?php echo urlencode($provinceFilter) ?>&page=<?php echo $currentPage-1 ?>'">
            PREVIOUS
        </button>

        <div class="page-num">
            <span class="active"><?php echo $currentPage ?></span>
        </div>

        <button class="next"
            <?php if($currentPage >= $totalPages) echo "disabled"; ?>
            onclick="window.location='?province=<?php echo urlencode($provinceFilter) ?>&page=<?php echo $currentPage+1 ?>'">
            NEXT
        </button>

    </div>

</div>

</main>

<!-- SEARCH FUNCTION -->
<script>
document.getElementById("searchInput").addEventListener("keyup", function() {
    let value = this.value.toLowerCase();
    let rows = document.querySelectorAll("#masterTable tbody tr");

    rows.forEach(row => {
        let text = row.innerText.toLowerCase();
        row.style.display = text.includes(value) ? "" : "none";
    });
});
</script>