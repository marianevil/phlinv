<?php 
include 'db/connection.php'; 
include 'header.php'; 
?>

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

<form action="db/save_riraf.php" method="POST">

<!-- ROW 1 -->
<div class="form-row four-col">

<div class="input-group">
<label>Province:</label>
<select name="province" required>

<option value="" selected hidden>Select Province</option>

<?php
$query = $conn->query("SELECT name FROM riraf_province ORDER BY name ASC");

while($row = $query->fetch_assoc()){
    echo "<option value='".htmlspecialchars($row['name'])."'>"
        .htmlspecialchars($row['name']).
        "</option>";
}
?>

</select>
</div>

<div class="input-group">
<label>Date:</label>
<input type="date" name="date" required>
</div>

<div class="input-group">
<label>INV.No.:</label>
<input type="text" name="inv_no">
</div>

<div class="input-group">
<label>Wt.:</label>
<input type="text" name="weight">
</div>

<div class="input-group">
<label>Post Office Name:</label>

<select name="post_office" required>

<option value="" selected hidden>Select Post Office</option>

<?php
$query = $conn->query("SELECT name FROM riraf_postoffice ORDER BY name ASC");

while($row = $query->fetch_assoc()){
    echo "<option value='".htmlspecialchars($row['name'])."'>"
        .htmlspecialchars($row['name']).
        "</option>";
}
?>

</select>

</div>
</div>

<!-- TYPE OF ACCOUNT -->
<div class="form-row two-col">
<div class="input-group">
<label>Type of Accounts:</label>

<select name="type_accounts" id="typeAccounts">
<option value="" selected hidden>Select Type</option>

<?php
$query = $conn->query("SELECT name FROM type_of_accounts ORDER BY name ASC");

while($row = $query->fetch_assoc()){
echo "<option value='".htmlspecialchars($row['name'])."'>"
.htmlspecialchars($row['name']).
"</option>";
}
?>

</select>

</div>
</div>


<!-- PHILPOST / GUMMED / SALES -->
<div id="philpostSection" style="display:none; margin-top:15px;">

<div class="section-title">
<span id="philpostTitle">PHILPOST MAILING STAMPS</span>
</div>

<div class="philpost-section">

<div class="philpost-row">

<div class="input-group">
<label>ITEMS:</label>

<select name="items">

<option value="" hidden>Select Items</option>

<?php
$query = $conn->query("SELECT name FROM riraf_item ORDER BY name ASC");

while($row = $query->fetch_assoc()){
    echo "<option value='".htmlspecialchars($row['name'])."'>"
        .htmlspecialchars($row['name']).
        "</option>";
}
?>

</select>

</div>

<div class="input-inline">
<label>TOTAL WEIGHTED AVE. COST:</label>
<input type="text" name="total_weighted_cost">
</div>

</div>

<div class="philpost-row">

<div class="input-inline">
<label>QUANTITY (PADs):</label>
<input type="text" name="quantity_pads">
</div>

<div class="input-inline">
<label>TOTAL COST:</label>
<input type="text" name="total_cost">
</div>

</div>

<div class="philpost-row single-column">

<div class="input-inline">
<label>WEIGHTED AVE. COST:</label>
<input type="text" name="weighted_cost" class="weighted-input">
</div>

</div>

<div class="philpost-row">

<div class="input-inline">
<label>UNIT COST:</label>
<input type="text" name="unit_cost">
</div>

<div class="input-inline">
<label>TOTAL QUANTITY:</label>
<input type="text" name="total">
</div>

</div>

<div class="philpost-row two-column">

<div></div>

<div class="input-inline">
<label>TOTAL AMOUNT IN WORDS:</label>
<input type="text" name="total_words">
</div>

</div>

</div>

<div class="serial-section">

<div class="serial-title">Serial Nos.</div>

<div class="serial-row">
<div class="input-inline">
<label>FROM:</label>
<input type="text" name="serial_from">
</div>
</div>

<div class="serial-row">
<div class="input-inline">
<label>TO:</label>
<input type="text" name="serial_to">
</div>
</div>

</div>

<div class="form-actions">
<button type="submit" name="form_type" value="philpost" class="btn-save">SUBMIT</button>
</div>

</div>


<!-- OFFICIAL / ACKNOWLEDGEMENT -->
<div id="officialReceiptSection" style="display:none; margin-top:15px;">

<div class="section-title">
OFFICIAL RECEIPT
</div>

<div class="quantity-grid">

<div class="q-label">QUANTITY</div>
<div class="q-label">UNIT COST</div>

<div class="input-inline">
<label>PIECES:</label>
<input type="text" name="pieces">
</div>

<div class="input-inline">
<label>PER PIECE:</label>
<input type="text" name="per_piece">
</div>

<div class="input-inline">
<label>WEIGHTED COST:</label>
<input type="text" name="weighted_cost_receipt">
</div>

<div class="input-inline">
<label>PER PAD:</label>
<input type="text" name="per_pad">
</div>

</div>

<div class="serial-section">

<div class="serial-title">Serial Nos.</div>

<div class="serial-row">

<div class="input-inline">
<label>FROM:</label>
<input type="text" name="receipt_from">
</div>

<div class="input-inline">
<label>TOTAL COST:</label>
<input type="text" name="receipt_total_cost">
</div>

</div>

<div class="serial-row">

<div class="input-inline">
<label>TO:</label>
<input type="text" name="receipt_to">
</div>

<div class="input-inline">
<label>TOTAL:</label>
<input type="text" name="receipt_total">
</div>

</div>

</div>

<div class="form-actions">
<button type="submit" name="form_type" value="receipt" class="btn-save">SUBMIT</button>
</div>

</div>


<!-- MONEY ORDER -->
<div id="moneyOrderSection" style="display:none; margin-top:15px;">

<div class="section-title">
MONEY ORDER
</div>

<div class="form-row five-col">

<div class="input-group">
<label>Deno:</label>

<select name="deno">

<option hidden>Select</option>

<?php
$query = $conn->query("SELECT name FROM riraf_denomination ORDER BY name ASC");

while($row = $query->fetch_assoc()){
    echo "<option value='".htmlspecialchars($row['name'])."'>"
        .htmlspecialchars($row['name']).
        "</option>";
}
?>

</select>

</div>

<div class="input-group">
<label>Quantity (pcs)</label>
<input type="text" name="mo_quantity">
</div>

<div class="input-group">
<label>Weighted Ave. Cost</label>
<input type="text" name="mo_weighted">
</div>

</div>

<div class="serial-section">

<div class="serial-row">

<div class="input-inline">
<label>FROM</label>
<input type="text" name="mo_from">
</div>

<div class="input-inline">
<label>TOTAL WEIGHTED</label>
<input type="text" name="mo_total_weighted">
</div>

<div class="input-inline">
<label>AMOUNT</label>
<input type="text" name="mo_amount">
</div>

</div>

<div class="serial-row">
<div class="input-inline">
<label>TO</label>
<input type="text" name="mo_to">
</div>
</div>

<div class="serial-row">
<div class="input-inline">
<label>TOTAL</label>
<input type="text" name="mo_total">
</div>
</div>

</div>

<div class="form-actions">
<button type="submit" name="form_type" value="money_order" class="btn-save">SUBMIT</button>
</div>

</div>


<!-- POSTAGE / PHILATELIC -->
<div id="postageSection" style="display:none; margin-top:15px;">

<div class="section-title">
<span id="stampTitle">STAMP DETAILS</span>
</div>

<div class="form-row five-col">

    <!-- First Row -->
<div class="input-group">
<label>Deno:</label>
<select name="deno" id="deno">
<option hidden>Select</option>
<?php
$query = $conn->query("SELECT name FROM riraf_denomination ORDER BY name ASC");
while($row = $query->fetch_assoc()){
    echo "<option value='".htmlspecialchars($row['name'])."'>"
        .htmlspecialchars($row['name'])."</option>";
}
?>
</select>
</div>


<div class="input-inline">
<label>Quantity</label>
<input type="number" name="quantity" id="qty">
</div>

<div class="input-inline">
<label>Weighted</label>
<input type="number" name="weighted" id="weighted">
</div>

    <div class="input-group">
        <label>Kind of Stamp</label>
        <select name="kind_stamp">
            <option hidden>Select Stamp</option>
            <?php
            $query = $conn->query("SELECT name FROM riraf_stamp ORDER BY name ASC");
            while($row = $query->fetch_assoc()){
                echo "<option value='".htmlspecialchars($row['name'])."'>"
                    .htmlspecialchars($row['name']).
                    "</option>";
            }
            ?>
        </select>
    </div>

    <div class="input-inline">
        <label>Sheet</label>
        <input type="text" name="sheet">
    </div>

</div>

<!-- Second Row: only Unit Cost & Pieces -->
<div class="form-row five-col">

    <div class="input-inline"></div> <!-- Deno empty -->
    <div class="input-inline"></div> <!-- Quantity empty -->

    <div class="input-inline">
        <label>Unit Cost</label>
        <input type="text" name="unit_cost">
    </div>

    <div class="input-inline"></div> <!-- Kind of Stamp empty -->

    <div class="input-inline">
        <label>Pieces</label>
        <input type="text" name="pieces">
    </div>

</div>

    <!-- Third Row: Serial Nos. Label only -->
    <div class="form-row five-col">
        <div class="input-inline" style="width:100%;">
            <label>Serial Nos.</label>
        </div>
    </div>
<div class="serial-section">

<div class="serial-row">

<div class="input-inline">
<label>FROM :</label>
<input type="text" name="stamp_from">
</div>

<div class="input-inline">
<label>TOTAL WEIGHTED</label>
<input type="text" name="stamp_total_weighted" id="totalWeighted">
</div>

<div class="input-inline">
<label>AMOUNT</label>
<input type="text" name="stamp_amount" id="amount">
</div>

</div>

<div class="serial-row">

<div class="input-inline">
<label>TO :</label>
<input type="text" name="stamp_to">
</div>

</div>

    <div class="serial-row">
        <div class="input-inline"></div> <!-- First column empty -->
        <div class="input-inline"></div> <!-- Second column empty -->

        <div class="input-inline">
            <label>TOTAL QUANTITY:</label>
            <input type="text" name="stamp_total" id="totalQty">
        </div>

    </div>
    <!-- Seventh row: Total Amount in Words -->
<div class="serial-row">
    <div class="input-inline"></div> <!-- First column empty -->

    <div class="input-inline">
        <label>TOTAL AMOUNT IN WORDS:</label>
        <input type="text" name="stamp_total_words" id="amountWords">
    </div>
</div>


</div>

<div class="form-actions">
<button type="submit" name="form_type" value="stamps" class="btn-save">SUBMIT</button>
</div>

</div>


</form>

</div>

</main>


<script>

const typeSelect = document.getElementById("typeAccounts");

const postageSection = document.getElementById("postageSection");
const moneyOrderSection = document.getElementById("moneyOrderSection");
const officialReceiptSection = document.getElementById("officialReceiptSection");
const philpostSection = document.getElementById("philpostSection");

const stampTitle = document.getElementById("stampTitle");
const philpostTitle = document.getElementById("philpostTitle");

typeSelect.addEventListener("change", function(){

const selectedText = this.value.toLowerCase();

postageSection.style.display="none";
moneyOrderSection.style.display="none";
officialReceiptSection.style.display="none";
philpostSection.style.display="none";

if(selectedText.includes("postage") || selectedText.includes("philatelic")){
postageSection.style.display="block";
stampTitle.innerText = selectedText.toUpperCase();
}

else if(selectedText.includes("money order")){
moneyOrderSection.style.display="block";
}

else if(selectedText.includes("official receipt") || selectedText.includes("acknowledgement")){
officialReceiptSection.style.display="block";
}

else if(selectedText.includes("philpost")){
philpostSection.style.display="block";
philpostTitle.innerText="PHILPOST MAILING STAMPS";
}

else if(selectedText.includes("gummed")){
philpostSection.style.display="block";
philpostTitle.innerText="GUMMED TAPE";
}

else if(selectedText.includes("sales invoice")){
philpostSection.style.display="block";
philpostTitle.innerText="SALES INVOICE";
}

});

const deno = document.getElementById("deno");
const qty = document.getElementById("qty");
const weighted = document.getElementById("weighted");

const totalWeighted = document.getElementById("totalWeighted");
const amount = document.getElementById("amount");
const totalQty = document.getElementById("totalQty");
const amountWords = document.getElementById("amountWords");

function numberToWords(num){

const ones = [
"", "One","Two","Three","Four","Five","Six","Seven","Eight","Nine","Ten",
"Eleven","Twelve","Thirteen","Fourteen","Fifteen","Sixteen","Seventeen","Eighteen","Nineteen"
];

const tens = ["","","Twenty","Thirty","Forty","Fifty","Sixty","Seventy","Eighty","Ninety"];

if(num < 20) return ones[num];

if(num < 100){
return tens[Math.floor(num/10)] + " " + ones[num%10];
}

if(num < 1000){
return ones[Math.floor(num/100)] + " Hundred " + numberToWords(num%100);
}

if(num < 1000000){
return numberToWords(Math.floor(num/1000)) + " Thousand " + numberToWords(num%1000);
}

return num;
}

function calculatePostage(){

let d = parseFloat(deno.value) || 0;
let q = parseFloat(qty.value) || 0;
let w = parseFloat(weighted.value) || 0;

let totalW = (q * w);
let amt = (d * q);

totalWeighted.value = totalW.toFixed(2);
amount.value = amt.toFixed(2);
totalQty.value = q;

/* convert amount to words */
if(amt > 0){
amountWords.value = numberToWords(Math.floor(amt)) + " Pesos";
}else{
amountWords.value = "";
}

}

deno.addEventListener("change", calculatePostage);
qty.addEventListener("input", calculatePostage);
weighted.addEventListener("input", calculatePostage);

</script>

</body>
</html>