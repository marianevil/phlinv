<?php include "admin_header.php"; ?>

<link rel="stylesheet" href="css/approve.css">

<?php
$status = "Pending";

if (isset($_POST['approve'])) {
    $status = "Approved";
}

if (isset($_POST['reject'])) {
    $status = "Rejected";
}

if (isset($_POST['release'])) {
    $status = "Released";
}
?>

<div class="req-wrapper">

    <!-- TOP -->
    <div class="req-topbar">
        <div class="req-filters">
            <span class="req-tab active">All</span>
            <span class="req-tab">Pending</span>
            <span class="req-tab">Approved</span>
            <span class="req-tab">Released</span>
            <span class="req-tab">Rejected</span>
        </div>

        <div class="req-search">
            <input type="text" placeholder="Search request...">
        </div>
    </div>

    <!-- TABLE -->
    <table class="req-table">
        <thead>
            <tr>
                <th>REQUEST NO.</th>
                <th>DATE</th>
                <th>REQUESTED BY</th>
                <th>ITEM</th>
                <th>QTY</th>
                <th>DESTINATION</th>
                <th>STATUS</th>
                <th>ACTIONS</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td>REQ-0001</td>
                <td>2026-04-28</td>
                <td>User1</td>
                <td>Postage Stamp</td>
                <td>100</td>
                <td>Cagayan</td>
                <td>
                    <span class="req-badge <?php echo strtolower($status); ?>">
                        <?php echo $status; ?>
                    </span>
                </td>
                <td>
                    <button class="btn-view" onclick="showDetails()">View</button>
                </td>
            </tr>
        </tbody>
    </table>

<!-- DETAILS -->
<div class="req-details" id="detailsPanel">

    <!-- REQUEST DETAILS -->
    <div class="req-card">
        <h3>Request Details</h3>

        <div class="req-grid">
            <div><strong>Request No:</strong> REQ-0001</div>
            <div><strong>Province:</strong> Cebu</div>
            <div><strong>Post Office:</strong> Cebu Central</div>
            <div><strong>Item:</strong> Postage Stamp</div>
            <div><strong>Kind:</strong> South Sea Pearl</div>
            <div><strong>Denomination:</strong> ₱12.00</div>
            <div><strong>Quantity:</strong> 100</div>
            <div><strong>Destination:</strong> Cagayan</div>
            <div><strong>Purpose:</strong> Distribution</div>
        </div>
    </div>

    <!-- ACTIONS -->
    <div class="req-card">
        <h3>Actions</h3>

        <form method="POST">
            <button type="submit" name="approve" class="btn-approve">Approve Request</button>
            <button type="submit" name="reject" class="btn-reject">Reject Request</button>
        </form>
    </div>

    <!-- RELEASE -->
    <div class="req-card">
        <h3>Release (After Approval)</h3>

        <form method="POST">
            <label>Quantity to Release</label>
            <input type="number" name="qty" required>

            <label>Release Date</label>
            <input type="date" name="date" required>

            <button type="submit" name="release" class="btn-release">Release Now</button>
        </form>
    </div>

</div>

    </div>

</div>

<script>
function showDetails() {
    let panel = document.getElementById("detailsPanel");
    panel.classList.toggle("show");
}
</script>