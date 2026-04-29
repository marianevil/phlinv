<?php include 'header.php'; ?>
<link rel="stylesheet" href="css/request.css">

<div class="req-page-wrapper">

<form method="POST" action="request.php">

    <!-- CREATE REQUEST -->
    <div class="req-card">

        <div class="req-card-header">
            Create Distribution Request
        </div>

        <div class="req-form-grid">

            <div class="req-field">
                <label>Date of Request</label>
                <input type="date" name="request_date" required>
            </div>

            <div class="req-field">
                <label>Type of Account</label>
                <select name="account_type">
                    <option>Philatelic Stamps</option>
                </select>
            </div>

            <div class="req-field">
                <label>Request No.</label>
                <input type="text" name="request_no" placeholder="Auto-generated or enter manually">
            </div>

            <div class="req-field">
                <label>Status</label>
                <input type="text" name="status" value="Pending" readonly>
            </div>

            <div class="req-field">
                <label>Province</label>
                <select name="province">
                    <option>Cebu</option>
                </select>
            </div>

            <div class="req-field">
                <label>Post Office</label>
                <select name="post_office">
                    <option>Cebu Central Post Office</option>
                </select>
            </div>

            <div class="req-field">
                <label>Item</label>
                <select name="item">
                    <option>Postage Stamps</option>
                </select>
            </div>

            <div class="req-field">
                <label>Kind of Stamp</label>
                <select name="stamp_kind">
                    <option>South Sea Pearl</option>
                </select>
            </div>

            <div class="req-field">
                <label>Denomination</label>
                <input type="text" name="denomination" placeholder="Enter amount">
            </div>

            <div class="req-field">
                <label>Quantity Requested</label>
                <input type="number" name="quantity" required>
            </div>

            <div class="req-field-full">
                <label>Purpose / Remarks</label>
                <textarea name="remarks" placeholder="Enter purpose here"></textarea>
            </div>

            <div class="req-actions">
                <button type="reset" class="req-btn-secondary">Clear</button>
                <button type="submit" class="req-btn-primary">Submit Request</button>
            </div>

        </div>
    </div>
<!-- MY REQUESTS -->
<div class="req-card">

    <div class="req-card-header">
        My Requests
    </div>

    <table class="req-table">
        <thead>
            <tr>
                <th>Request No.</th>
                <th>Date Requested</th>
                <th>Type of Account</th>
                <th>Item</th>
                <th>Deno</th>
                <th>Qty Requested</th>
                <th>Destination Office</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>

        <?php
        // SAMPLE FETCH (adjust table name)
        include 'db/connection.php';

        $result = $conn->query("SELECT * FROM requests ORDER BY id DESC");

        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
        ?>

            <tr>
                <td><?= $row['request_no']; ?></td>
                <td><?= $row['request_date']; ?></td>
                <td><?= $row['account_type']; ?></td>
                <td><?= $row['item']; ?></td>
                <td><?= $row['denomination']; ?></td>
                <td><?= $row['quantity']; ?></td>
                <td><?= $row['post_office']; ?></td>

                <td>
                    <span class="req-badge">
                        <?= $row['status']; ?>
                    </span>
                </td>

                <td>
                    <button class="req-view">👁</button>
                    <button class="req-delete">🗑</button>
                </td>
            </tr>

        <?php
            }
        } else {
            echo "<tr><td colspan='9'>No requests found</td></tr>";
        }
        ?>

        </tbody>
    </table>

</div>
</form>

</div>
