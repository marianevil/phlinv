<?php include 'header.php'; ?>
<main class="dashboard-bg">

    <div class="create-header">
        <h2>ENTRY DATA FORM</h2>
    </div>

    <div class="create-card">

        <div class="section-title">
            G. OTHERS
        </div>

      <div class="philpost-section">

    <div class="philpost-section">

    <!-- PHILPOST MAILING STAMPS SECTION -->
<div class="philpost-section">

    <!-- Row 1 -->
    <div class="philpost-row">
    <div class="input-group">
        <label>ITEMS:</label>
        <select name="Items">
            <option value="" selected hidden>Select Items</option>
            <option>South Sea Pearl</option>
            <option>PHL. MUSICAL INST</option>
            <option>75 yrs Comelec</option>
            <option>Phl. Eagle</option>
        </select>
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
            onclick="window.location.href='phlpostMailing.php'">
            BACK
        </button>

        <div class="right-buttons">
            <button type="button" class="btn-review"
                onclick="window.location.href='review.php'">
                REVIEW
            </button>

        <button type="button" class="btn-submit" onclick="openModal()">
        SUBMIT
        </button>

        </div>
    </div>


    </div>
</main>
<!-- ===== MODAL HERE ===== -->
<div id="submitModal" class="modal">
    <div class="modal-content">
        <p>Are you sure you want to submit this form?</p>

        <div class="modal-buttons">
            <button class="modal-cancel" onclick="closeModal()">NO</button>
            <button class="modal-confirm" onclick="submitForm()">YES</button>
        </div>
    </div>
</div>

<script>
function openModal() {
    document.getElementById("submitModal").style.display = "block";
}

function closeModal() {
    document.getElementById("submitModal").style.display = "none";
}

function submitForm() {
    document.querySelector("form")?.submit();
}
</script>
<!-- ===== END MODAL ===== -->

</body>
</html>

</body>
</html>
