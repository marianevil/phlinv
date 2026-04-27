<?php include 'header.php'; ?>

<link rel="stylesheet" href="masterlist.css">

<main class="dashboard-bg">

<div class="masterlist-title">
    MASTER LIST DATA
</div>

<div class="masterlist-card">

    <!-- Province Dropdown -->
<div class="filter-row">
    
    <!-- LEFT SIDE -->
    <div class="filter-left">
        <label>Province:</label>
        <select>
            <option>Select Province</option>
            <option>Bukidnon</option>
            <option>Zamboanga Sibugay</option>
            <option>Zamboanga del Sur</option>
        </select>
    </div>

    <!-- RIGHT SIDE -->
<div class="filter-right">
    <button class="export-btn">
        <img src="images/excel.png" alt="Export">
        Export Excel
    </button>
</div>

</div>

    <!-- Table Header -->
    <div class="table-header">
        <h3>Province</h3>

        <div class="table-search">
            <input type="text" placeholder="Search...">
        </div>
    </div>

    <!-- Table -->
    <table class="masterlist-table">

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

            <tr>
                <td>1/20/2016</td>
                <td rowspan="4">Zamboanga Sibugay</td>
                <td>Tungawan PO</td>
                <td>Postage Stamp</td>
                <td>0001</td>
                <td>7018</td>
                <td>Manila</td>
            </tr>

            <tr>
                <td>6/16/2017</td>
                <td>Ipil Post Office</td>
                <td>Postage Stamp</td>
                <td>0225</td>
                <td>7001</td>
                <td>Manila</td>
            </tr>

            <tr>
                <td>3/20/2018</td>
                <td>Imelda Post Office</td>
                <td>Postage Stamp</td>
                <td>4350</td>
                <td>7007</td>
                <td>Manila</td>
            </tr>

            <tr>
                <td>8/24/2019</td>
                <td>Buug PO</td>
                <td>Postage Stamp</td>
                <td>2214</td>
                <td>7009</td>
                <td>Manila</td>
            </tr>

        </tbody>

    </table>

    <!-- Pagination -->
    <div class="pagination">

        <button class="prev">PREVIOUS</button>

        <div class="page-num">
            <span class="active">1</span>
           
        </div>

        <button class="next">NEXT</button>

    </div>

</div>

</main>