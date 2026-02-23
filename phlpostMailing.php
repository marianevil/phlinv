<?php include 'header.php'; ?>
<main class="dashboard-bg">

    <div class="create-header">
        <h2>ENTRY DATA FORM</h2>
    </div>

    <div class="create-card">

        <div class="section-title">
            F. PHILPOST MAILING STAMPS
        </div>

      <div class="philpost-section">

    <div class="philpost-section">

    <!-- PHILPOST MAILING STAMPS SECTION -->
<div class="philpost-section">

    <!-- Row 1 -->
    <div class="philpost-row">
        <div class="input-inline">
            <label class="philpost-label">ITEM:</label>
            <input type="text" class="philpost-input">
        </div>

        <div class="input-inline">
            <label class="philpost-label">TOTAL WEIGHTED AVE. COST:</label>
            <input type="text" class="philpost-input">
        </div>
    </div>

    <!-- Row 2 -->
    <div class="philpost-row">
        <div class="input-inline">
            <label class="philpost-label">QUANTITY (PADs):</label>
            <input type="text" class="philpost-input">
        </div>

        <div class="input-inline">
            <label class="philpost-label">TOTAL COST:</label>
            <input type="text" class="philpost-input">
        </div>
    </div>

    <!-- Row 3 -->
    <div class="philpost-row single-column">
        <div class="input-inline">
            <label class="philpost-label">WEIGHTED AVE. COST:</label>
            <input type="text" class="philpost-input">
        </div>
    </div>

    <!-- Row 4: TOTAL numeric -->
    <div class="philpost-row">
        <div class="input-inline">
            <label class="philpost-label">UNIT COST:</label>
            <input type="text" class="philpost-input">
        </div>

        <div class="input-inline">
            <label class="philpost-label">TOTAL:</label>
            <input type="text" class="philpost-input">
        </div>
    </div>

    <!-- Row 5: TOTAL AMOUNT IN WORDS in the second column -->
    <div class="philpost-row two-column">
    <!-- Empty left column -->
    <div class="input-inline"></div>

    <!-- Right column: TOTAL AMOUNT IN WORDS -->
    <div class="input-inline">
        <label class="philpost-label">TOTAL AMOUNT IN WORDS:</label>
        <input type="text" class="philpost-input">
    </div>

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

    </div>

    <div class="serial-row">
        <div class="input-inline">
            <label class="serial-label">TO:</label>
            <input type="text" class="serial-input">
        </div>


    </div>



        <!-- BUTTONS -->
        <div class="form-actions">
            <button class="btn-back"
                onclick="window.location.href='acknowledgeReceipt_form.php'">
                BACK
            </button>

            <button class="btn-save"
                onclick="window.location.href='others.php'">
                NEXT
            </button>
        </div>

    </div>
</main>
</body>
</html>
