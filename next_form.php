<?php
include 'header.php';
?>
<main class="dashboard-bg">
    <div class="create-header">
        <h2>ENTRY DATA FORM</h2>
    </div>

    <div class="create-card">

        <div class="section-title">
            <span>B. PHILATELIC STAMPS </span>
        </div>

        <div class="form-row five-col stamp-row">
            <div class="input-group">
                <label>Deno:</label>
                <input type="text" placeholder=" ">
            </div>
            <div class="input-group">
                <label>Quantity:</label>
                <input type="text" placeholder=" ">
            </div>
            <div class="input-group">
                <label>Weighted:</label>
                <input type="text" placeholder=" ">
            </div>
            <div class="input-group">
                <label>Kind of Stamp:</label>
                <input type="text" placeholder=" ">
            </div>
            <div class="input-group">
                <label>Sheet:</label>
                <input type="text" placeholder=" ">
            </div>
        </div>
        <!-- Row 2: Pieces aligned under Sheet column -->
        <div class="form-row five-col stamp-row">
            <!-- empty columns for alignment -->
            <div class="input-group"></div>
            <div class="input-group"></div>
            <div class="input-group">
                <label>Unit Cost:</label>
                <input type="text" placeholder=" ">
            </div>
            <div class="input-group"></div>

            <!-- Pieces input under Sheet column -->
        <div class="input-group">
            <label>Pieces:</label>
            <input type="text" placeholder=" ">
        </div>
</div>

<div class="serial-section">

    <!-- Row 1: Serial Nos. label only -->
    <div class="serial-label-row">
        <div class="serial-label">Serial Nos.:</div>
    </div>

    <!-- Row 2: FROM | TOTAL WEIGHTED | AMOUNT -->
    <div class="serial-row">
        <div class="input-inline">
            <label>FROM:</label>
            <input type="text" placeholder=" ">
        </div>
        <div class="input-inline">
            <label>TOTAL WEIGHTED:</label>
            <input type="text" placeholder=" ">
        </div>
        <div class="input-inline">
            <label>AMOUNT:</label>
            <input type="text" placeholder=" ">
        </div>
    </div>

    <!-- Row 3: TO only -->
    <div class="serial-row">
        <div class="input-inline">
            <label>TO:</label>
            <input type="text" placeholder=" ">
        </div>
    </div>

    <!-- Row 4: TOTAL (in AMOUNT column) -->
    <div class="serial-row">
        <div style="flex: 1; min-width: 200px;"></div>
        <div style="flex: 1; min-width: 200px;"></div>
        <div class="input-inline">
            <label>TOTAL:</label>
            <input type="text" placeholder=" ">
        </div>
    </div>

    <!-- Row 5: TOTAL AMOUNT IN WORDS inline -->
    <div class="serial-row">
        <div style="flex: 1; "></div>
        

        <div class="input-inline total-words">
            <label>TOTAL AMOUNT IN WORDS:</label>
            <input type="text" placeholder=" ">
        </div>
    </div>


</div>
<div class="form-actions">
    <button type="button" class="btn-back"
        onclick="window.location.href='create.php'">
        BACK
    </button>

    <button type="button" class="btn-save"
        onclick="window.location.href='moneyOrder_form.php'">
        NEXT
    </button>
</div>


    </div>

    <!-- end create-card -->
</main>
</body>
</html>
