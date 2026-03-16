<?php
include 'header.php';
?>
<main class="dashboard-bg">
    <div class="create-header">
        <h2>ENTRY DATA FORM</h2>
    </div>

    <div class="create-card">

        <div class="section-title">
            <span>C. MONEY ORDER </span>
        </div>

        <div class="form-row five-col stamp-row">
    <div class="input-group">
        <label>Deno:</label>
        <select name="deno">
            <option value="" selected hidden>Select Deno</option>
            <option>1.00</option>
            <option>5.00</option>
            <option>10.00</option>
            <option>20.00</option>
            <option>50.00</option>
        </select>
    </div>
            <div class="input-group">
                <label>Quantity (pcs):</label>
                <input type="text" placeholder=" ">
            </div>
            <div class="input-group">
                <label>Weighted Ave. Cost:</label>
                <input type="text" placeholder=" ">
            </div>
        </div>
        <!-- Row 2: Pieces aligned under Sheet column -->
        <div class="form-row five-col stamp-row">
            <!-- empty columns for alignment -->
            <div class="input-group"></div>
            <div class="input-group"></div>
            <div class="input-group"></div>
  
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
</div>
    <div class="form-actions">
        <button type="button" class="btn-back"
            onclick="window.location.href='next_form.php'">
            BACK
        </button>

        <button type="button" class="btn-save"
            onclick="window.location.href='officialReceipt_form.php'">
            NEXT
        </button>
    </div>


    </div>

    <!-- end create-card -->
</main>
</body>
</html>
