<?php include 'header.php'; ?>
<main class="dashboard-bg">

    <div class="create-header">
        <h2>ENTRY DATA FORM</h2>
    </div>

    <div class="create-card">

        <div class="section-title">
            D. OFFICIAL RECEIPT
        </div>

        <!-- QUANTITY -->
        <div class="quantity-grid">

        <!-- Row 1 -->
        <div class="q-label">QUANTITY</div>
        <div class="q-label">UNIT COST</div>

        <!-- Row 2 -->
        <div class="input-inline">
            <label>PIECES:</label>
            <input type="text">
        </div>

        <div class="input-inline">
            <label>PER PIECE:</label>
            <input type="text">
        </div>

    <!-- Row 3 -->
    <div class="input-inline">
        <label>WEIGHTED COST:</label>
        <input type="text">
    </div>

    <div class="input-inline">
        <label>PER PAD:</label>
        <input type="text">
    </div>

</div>


        <!-- SERIAL SECTION -->
   <div class="serial-section">

    <div class="serial-title">Serial Nos.:</div>

    <div class="serial-row">
        <div class="input-inline">
            <label class="serial-label">FROM:</label>
            <input type="text" class="serial-input">
        </div>

        <div class="input-inline">
            <label class="serial-label">TOTAL COST:</label>
            <input type="text" class="serial-input">
        </div>
    </div>

    <div class="serial-row">
        <div class="input-inline">
            <label class="serial-label">TO:</label>
            <input type="text" class="serial-input">
        </div>

        <div class="input-inline">
            <label class="serial-label">TOTAL:</label>
            <input type="text" class="serial-input">
        </div>
    </div>
</div>


        <!-- BUTTONS -->
        <div class="form-actions">
            <button class="btn-back"
                onclick="window.location.href='moneyOrder_form.php'">
                BACK
            </button>

            <button class="btn-save"
                onclick="window.location.href='acknowledgeReceipt_form.php'">
                NEXT
            </button>
        </div>

    </div>
</main>
</body>
</html>
