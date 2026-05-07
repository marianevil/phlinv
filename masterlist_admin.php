<?php include 'admin_header.php'; ?>

<div class="admin-ml-wrapper">

    <div class="admin-ml-container">

        <div class="admin-ml-title">MASTER LIST DATA</div>
        <div class="admin-ml-description">

        
    <p> 
        DESCRIPTION: This section serves as the overall consolidated record of all the system activities including user additions, issuances and release for complete tracking and auditing.
    </p> 
</div>

        <!-- FILTER -->
        <div class="admin-ml-filter">
            <select><option>SELECT PROVINCE</option></select>
            <select><option>ALL Type of Account</option></select>
            <select><option>All Status</option></select>

            <input type="date">
            <span>to</span>
            <input type="date">

            <input type="text" placeholder="Search...">

            <button class="admin-ml-search">Search</button>
            <button class="admin-ml-reset">Reset</button>
        </div>

        <!-- ACTIONS -->
        <div class="admin-ml-actions">
            <button class="admin-ml-export">Export to Excel</button>
            <button class="admin-ml-delete">Delete Selected</button>
        </div>

        <!-- TABLE -->
        <table class="admin-ml-table">
            <thead>
                <tr>
                    <th></th>
                    <th>ID</th>
                    <th>Date</th>
                    <th>Province</th>
                    <th>Post Office</th>
                    <th>Type of Account</th>
                    <th>INV No.</th>
                    <th>Zip Code</th>
                    <th>Delivered Office</th>
                    <th>Actions</th>
                </tr>
            </thead>
        </table>

    </div>

</div>

</main>
</div>

</body>
</html>