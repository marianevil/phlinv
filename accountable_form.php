<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$username = $_SESSION['user'];
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Accountable Forms</title>
<link rel="stylesheet" href="style.css">
</head>

<body>

<header class="header">
    <div class="logo">
        <img src="images/phlpost_logo.png" class="logo-img" alt="Logo">
    </div>

    <nav class="nav">
        <span class="nav-hover"></span>

        <div class="dropdown">  
            <button class="dropbtn dropdown-toggle">
                Inventory Category
                <svg class="arrow-icon" width="14" height="14" viewBox="0 0 24 24">
                    <path d="M6 9l6 6 6-6" fill="none" stroke="black" stroke-width="2"/>
                </svg>
            </button>
            <div class="dropdown-content">
                <a href="accountable_form.php">Accountable forms</a>
                <a href="riraf.php">Supplies</a>
                <a href="deno.php">Merchandise</a>
            </div>
        </div>

        <a href="stockcard.php">STOCK CARD</a>
        <a href="masterlistdata.php">MASTER LIST DATA</a>

        <div class="dropdown">
            <button class="dropbtn dropdown-toggle">
                <img src="images/admin_icon.png" class="admin-icon">
                <?php echo htmlspecialchars($username); ?>
                <svg class="arrow-icon" width="14" height="14" viewBox="0 0 24 24">
                    <path d="M6 9l6 6 6-6" fill="none" stroke="black" stroke-width="2"/>
                </svg>
            </button>
            <div class="dropdown-content">
                <a href="manage_users.php">Manage Users</a>
                <a href="logout.php">Logout</a>
            </div>
        </div>

    </nav>
</header>


<h2 class="forms-title">ACCOUNTABLE FORMS</h2>

<div class="blue-container">

    <div class="forms-wrapper">

        <!-- LEFT BUTTONS -->
        <div class="forms-left">

            <button onclick="showRiraf(this)">RIRAF</button>
            <button onclick="loadContent('stockcard.php', this)">STOCK CARD</button>
            <button onclick="loadContent('merchandise.php', this)">MERCHANDISE</button>

        </div>


        <!-- RIGHT PANEL -->
        <div class="forms-right">

            <div class="type-header" style="display:none;">
                <label>Type of Accounts:</label>

                <select id="accountType">
                    <option value="" disabled selected hidden>Select Type</option>
                    <option value="postage">POSTAGE STAMPS</option>
                    <option value="philatelic">PHILATELIC STAMPS</option>
                    <option value="money">MONEY ORDER</option>
                    <option value="receipt">OFFICIAL RECEIPT</option>
                </select>
            </div>

            <div id="content-area"></div>

        </div>

    </div>

</div>



<script>

/* SHOW RIRAF */
function showRiraf(btn){

    document.querySelectorAll('.forms-left button').forEach(b=>{
        b.classList.remove("active");
    });

    btn.classList.add("active");

    document.querySelector(".type-header").style.display = "flex";
    document.getElementById("content-area").innerHTML = "";
}



/* LOAD OTHER PAGES */
function loadContent(url, btn){

    document.querySelectorAll('.forms-left button').forEach(b=>{
        b.classList.remove("active");
    });

    btn.classList.add("active");

    document.querySelector(".type-header").style.display = "none";
    document.getElementById("content-area").innerHTML = "";

    fetch(url)
        .then(res => res.text())
        .then(html => {
            document.getElementById("content-area").innerHTML = html;
        })
        .catch(err => {
            document.getElementById("content-area").innerHTML = "Error loading page.";
        });
}



/* ACCOUNT TYPE CHANGE */
document.getElementById("accountType").addEventListener("change", function(){

const content = document.getElementById("content-area");

if(this.value === "postage"){

content.innerHTML = `

<div class="riraf-layout">

    <div class="riraf-left">

        <div class="form-row">
            <label>PROVINCE:</label>
            <div class="input-group">
                <input type="text" id="provinceInput">
                <button class="enter-btn" onclick="addProvince()">ENTER</button>
            </div>
        </div>

        <div class="form-row">
            <label>POST OFFICE NAME:</label>
            <div class="input-group">
                <input type="text" id="officeInput">
                <button class="enter-btn" onclick="addOffice()">ENTER</button>
            </div>
        </div>

        <div class="form-row">
            <label>KIND OF STAMP:</label>
            <div class="input-group">
                <input type="text" id="stampInput">
                <button class="enter-btn" onclick="addStamp()">ENTER</button>
            </div>
        </div>

        <div class="form-row">
            <label>DENO:</label>
            <div class="input-group">
                <input type="text" id="denoInput">
                <button class="enter-btn" onclick="addDeno()">ENTER</button>
            </div>
        </div>

    </div>


    <div class="riraf-right" id="resultPanel">

        <div class="result-header">
            <span id="resultTitle"></span>
            <img src="images/del.png" class="delete-icon" onclick="clearResults()">
        </div>

        <table class="results-table">
            <tbody id="resultsBody">
            </tbody>
        </table>

    </div>

</div>

`;

}

});



/* RESULT STORAGE */
let currentTitle = "";
let results = [];


/* RENDER RESULTS (panel hidden until data) */
function renderResults(title){

const body = document.getElementById("resultsBody");
const header = document.getElementById("resultTitle");
const panel = document.getElementById("resultPanel");

if(results.length === 0){
    panel.style.display = "none";
    header.textContent = "";
    body.innerHTML = "";
    return;
}

panel.style.display = "block";
header.textContent = title;
body.innerHTML = "";

results.forEach(item => {
    const row = document.createElement("tr");

    row.innerHTML = `
        <td>${item}</td>
        <td><input type="checkbox"></td>
    `;

    body.appendChild(row);
});

}



/* ADD PROVINCE */
function addProvince(){

const province = document.getElementById("provinceInput").value;

if(province === ""){
    alert("Please enter province");
    return;
}

currentTitle = "PROVINCE RESULT";
results = [province];

renderResults(currentTitle);

document.getElementById("provinceInput").value = "";

}



/* ADD OFFICE */
function addOffice(){

const office = document.getElementById("officeInput").value;

if(office === ""){
    alert("Please enter post office name");
    return;
}

currentTitle = "POST OFFICE RESULT";
results = [office];

renderResults(currentTitle);

document.getElementById("officeInput").value = "";

}



/* ADD STAMP */
function addStamp(){

const stamp = document.getElementById("stampInput").value;

if(stamp === ""){
    alert("Please enter kind of stamp");
    return;
}

currentTitle = "KIND OF STAMP RESULT";
results = [stamp];

renderResults(currentTitle);

document.getElementById("stampInput").value = "";

}



/* ADD DENO */
function addDeno(){

const deno = document.getElementById("denoInput").value;

if(deno === ""){
    alert("Please enter deno");
    return;
}

currentTitle = "DENO RESULT";
results = [deno];

renderResults(currentTitle);

document.getElementById("denoInput").value = "";

}



/* HEADER HOVER EFFECT */
const nav = document.querySelector('.nav');
const hover = document.querySelector('.nav-hover');

document.querySelectorAll('.nav a, .dropdown-toggle').forEach(item => {

item.addEventListener('mouseenter', function() {

const rect = this.getBoundingClientRect();
const navRect = nav.getBoundingClientRect();

hover.style.width = rect.width + 'px';
hover.style.left = (rect.left - navRect.left) + 'px';
hover.style.opacity = '1';

});

});


nav.addEventListener('mouseleave', function(){

hover.style.width = '0';
hover.style.opacity = '0';

});



/* DROPDOWN CLICK */
document.querySelectorAll('.dropdown-toggle').forEach(btn => {

btn.addEventListener('click', function (e) {

e.preventDefault();

const dropdown = this.parentElement;
const content = dropdown.querySelector('.dropdown-content');

dropdown.classList.toggle('active');
content.classList.toggle('show');

});

});



/* CLOSE DROPDOWN */
window.addEventListener('click', function (e){

document.querySelectorAll('.dropdown').forEach(drop => {

if (!drop.contains(e.target)) {

drop.classList.remove('active');
drop.querySelector('.dropdown-content').classList.remove('show');

}

});

});

</script>

</body>
</html>