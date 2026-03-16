<?php include 'header.php'; ?>

<main class="dashboard-bg">

<div class="create-header">
    <h2>ENTRY DATA FORM</h2>
</div>

<div class="create-card">

<!-- Form row -->
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
        <input type="text" placeholder=" ">
    </div>

    <div class="input-group">
        <label>Wt.:</label>
        <input type="text" placeholder=" ">
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


<!-- Section A -->
<div class="section-title">
    <span>A. POSTAGE STAMPS</span>
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
        <label>Quantity:</label>
        <input type="text" placeholder=" ">
    </div>

    <div class="input-group">
        <label>Weighted:</label>
        <input type="text" placeholder=" ">
    </div>

    <div class="input-group">
        <label>Kind of Stamp:</label>
        <select name="kind_stamp">
            <option value="" selected hidden>Select Stamp</option>
            <option>Definitive</option>
            <option>Commemorative</option>
            <option>Special Issue</option>
            <option>Philatelic</option>
        </select>
    </div>

    <div class="input-group">
        <label>Sheet:</label>
        <input type="text" placeholder=" ">
    </div>

</div>


<!-- Row 2 -->
<div class="form-row five-col stamp-row">

    <div class="input-group"></div>
    <div class="input-group"></div>

    <div class="input-group">
        <label>Unit Cost:</label>
        <input type="text" placeholder=" ">
    </div>

    <div class="input-group"></div>

    <div class="input-group">
        <label>Pieces:</label>
        <input type="text" placeholder=" ">
    </div>

</div>


<div class="serial-section">

<div class="serial-label-row">
    <div class="serial-label">Serial Nos.:</div>
</div>


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


<div class="serial-row">

    <div class="input-inline">
        <label>TO:</label>
        <input type="text" placeholder=" ">
    </div>

</div>


<div class="serial-row">

    <div style="flex:1;"></div>
    <div style="flex:1;"></div>

    <div class="input-inline">
        <label>TOTAL:</label>
        <input type="text" placeholder=" ">
    </div>

</div>


<div class="serial-row">

    <div style="flex:1;"></div>

    <div class="input-inline total-words">
        <label>TOTAL AMOUNT IN WORDS:</label>
        <input type="text" placeholder=" ">
    </div>

</div>

</div>


<div class="btn-save">
    <button type="button"
        class="btn-save"
        onclick="window.location.href='next_form.php'">
    NEXT
    </button>
</div>

</div>

</main>

</body>
</html>