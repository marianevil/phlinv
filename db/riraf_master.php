<?php
include 'connection.php';
include 'header.php';

/* Pagination setup */
$rowsPerPage = 13;
$currentPage = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;

/* Count total records */
$totalQuery = $conn->query("SELECT COUNT(*) AS total FROM riraf_master");
$totalRow = $totalQuery->fetch_assoc();
$totalRows = $totalRow['total'];

/* Calculate pages */
$totalPages = ceil($totalRows / $rowsPerPage);
$offset = ($currentPage - 1) * $rowsPerPage;

/* Fetch records */
$query = $conn->query("
SELECT *
FROM riraf_master
ORDER BY id DESC
LIMIT $offset,$rowsPerPage
");
?>