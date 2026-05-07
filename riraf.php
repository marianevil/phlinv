<?php
include 'db/connection.php';
include 'header.php';

// Pagination setup
$rowsPerPage = 13;
$currentPage = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;

// Count total records
$totalQuery = $conn->query("SELECT COUNT(*) AS total FROM riraf_records");
$totalRow = $totalQuery->fetch_assoc();
$totalRows = $totalRow['total'];

// Calculate total pages and offset
$totalPages = ceil($totalRows / $rowsPerPage);
$offset = ($currentPage - 1) * $rowsPerPage;

// Fetch records for current page
$query = $conn->query("
    SELECT 
        province,
        post_office,
        date,
        inv_no,
        GROUP_CONCAT(filename SEPARATOR '<br>') AS filenames,
        MIN(id) as id
    FROM riraf_records
    GROUP BY province, post_office, date, inv_no
    ORDER BY id DESC
    LIMIT $offset, $rowsPerPage
");
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<main class="dashboard-bg">

    <!-- Top-left RIRAF -->
    <div class="riraf-table-header">
        <div class="riraf-top-left">RIRAF</div>

        <!-- DELETE THIS DESCRIPTION LATER, FOR NOW JUST FOR REFERENCE -->
        <div class="card-desc">
            <p>
                This section contains all inputs submitted by the user in the RIRAF Entry Form. It serves as a record of all transactions such as postage stamps, money orders, receipts, etc.
            </p>
        </div>
        <div class="riraf-search">
            <label for="dateSearch">Search Date:</label>
            <input type="date" id="dateSearch" placeholder="mm/dd/yyyy">
        </div>
    </div>

    <!-- Table container -->
    <div class="riraf-table-wrapper">

        <!-- Top-middle title -->
        <div class="riraf-table-header">
            <div class="riraf-center">RIRAF RECORDS</div>
        </div>

        <!-- Table -->
        <table class="riraf-table">
            <thead>
                <tr>
                    <th>Province</th>
                    <th>Location</th>
                    <th>File Name</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
           <tbody>
<?php
while($row = $query->fetch_assoc()){
echo "<tr>
    <td>".$row['province']."</td>
    <td>".$row['post_office']."</td>
    <td>".$row['filenames']."</td>
    <td>".$row['date']."</td>
    <td>

        <button class='riraf-edit-btn' 
        onclick=\"window.location='edit_riraf.php?province=".urlencode($row['province'])."&post_office=".urlencode($row['post_office'])."&date=".$row['date']."&inv_no=".urlencode($row['inv_no'])."'\"> 
        <i class='fa-solid fa-pen'></i> Edit
        </button>

        <button class='print-btn' 
        onclick=\"window.open('print_riraf.php?province=".urlencode($row['province'])."&post_office=".urlencode($row['post_office'])."&date=".$row['date']."&inv_no=".urlencode($row['inv_no'])."','_blank')\">
        <i class='fa-solid fa-print'></i> Print
        </button>

    </td>
</tr>";
}
?>
</tbody>
        </table>

      
<!-- Pagination (with blue color, CSS handled by your existing style) -->
<div class="pagination">
    <button class="blue-btn" <?php if($currentPage <= 1) echo 'disabled'; ?> 
        onclick="window.location='?page=<?php echo $currentPage-1 ?>'">
        <i class="fa-solid fa-arrow-left"></i> Previous
    </button>

    <button class="blue-btn" <?php if($currentPage >= $totalPages) echo 'disabled'; ?> 
        onclick="window.location='?page=<?php echo $currentPage+1 ?>'">
        Next <i class="fa-solid fa-arrow-right"></i>
    </button>
</div>

    </div>

</main>