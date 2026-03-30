<?php include 'header.php'; ?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>RIRAF Entry</title>

<link rel="stylesheet" href="create.css">

</head>

<body>

<main class="dashboard-bg">

<div class="create-header">
    <h2>RIRAF ENTRY DATA FORM</h2>
</div>

<div class="create-card">

<!-- ROW 1 -->
<div class="form-row four-col">

    <div class="input-group">
        <label>Province:</label>
        <select name="province">
            <option value="" selected hidden>Select Province</option>
            <option>Misamis Oriental</option>
            <option>Bukidnon</option>
            <option>Lanao del Norte</option>
            <option>Camiguin</option>
        </select>
    </div>

    <div class="input-group">
        <label>Date:</label>
        <input type="date">
    </div>

    <div class="input-group">
        <label>INV.No.:</label>
        <input type="text">
    </div>

    <div class="input-group">
        <label>Wt.:</label>
        <input type="text">
    </div>
        <div class="input-group">
        <label>Post Office Name:</label>
        <select name="post_office">
            <option value="" selected hidden>Select Post Office</option>
            <option>Cagayan de Oro</option>
            <option>Balingasag</option>
            <option>Gingoog</option>
            <option>Malaybalay</option>
        </select>
    </div>

</div>


<!-- ROW 2 -->
<div class="form-row two-col">

    <div class="input-group">
        <label>Type of Accounts:</label>
        <select name="type_accounts">
            <option value="" selected hidden>Select Type</option>
            <option>Postage stamps</option>
            <option>Wholesale</option>
            <option>Government</option>
        </select>
    </div>

</div>

</div>

</main>

</body>
</html>