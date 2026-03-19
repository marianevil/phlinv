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
        <img src="images/phlpost_logo.png" class="logo-img">
    </div>
</header>

<div class="layout">

<!-- SIDEBAR -->
<aside class="sidebar collapsed">
    <ul class="sidebar-menu">

        <li>
            <a href="#" onclick="toggleSidebar(); return false;">
                <img src="images/sideBar.png" class="side-icon">
                <span>MENU</span>
            </a>
        </li>

        <li>
            <a href="admin_dashboard.php">
                <img src="images/dashboard.png" class="side-icon">
                <span>DASHBOARD</span>
            </a>
        </li>

        <li>
            <a href="manage_users.php">
                <img src="images/manageUser.png" class="side-icon">
                <span>MANAGE USERS</span>
            </a>
        </li>

        <li>
            <a href="#" onclick="showIntro(); return false;">
                <img src="images/account.png" class="side-icon">
                <span>ACCOUNTABLE FORMS</span>
            </a>
        </li>
        <li>
            <a href="#" onclick="showIntro(); return false;">
                <img src="images/masterlist.png" class="side-icon">
                <span>MASTERLISTS</span>
            </a>
        </li>

    </ul>

    <div class="sidebar-admin">
        <div class="admin-info">
            <img src="images/admin_icon.png" class="admin-icon">
            <span><?php echo htmlspecialchars($username); ?></span>
        </div>
        <a href="logout.php" class="logout-btn">Logout</a>
    </div>
</aside>

<!-- MAIN -->
<main class="main-content">

<div class="blue-container">

    <!-- INTRO -->
    <div id="introArea" class="forms-intro">
        <h2>Select Type of Accountable Form</h2>
        <p>Manage all accountable forms categories</p>

<div class="intro-cards">
    <div class="intro-card" onclick="activateLeft(0)">
        <img src="images/typeOfAcc.png" alt="Type of Accounts Icon" class="intro-icon">
        <span>TYPE OF ACCOUNTS</span>
    </div>

    <div class="intro-card" onclick="activateLeft(1)">
        <img src="images/riraf.png" alt="RIRAF Icon" class="intro-icon">
        <span>RIRAF</span>
    </div>

    <div class="intro-card" onclick="activateLeft(2)">
        <img src="images/stockCard.png" alt="Stock Card Icon" class="intro-icon">
        <span>STOCK CARD</span>
    </div>

    <div class="intro-card" onclick="activateLeft(3)">
        <img src="images/merchandise.png" alt="Merchandise Icon" class="intro-icon">
        <span>MERCHANDISE</span>
    </div>
</div>
    </div>

    <!-- FULL SYSTEM (hidden first) -->
    <div id="fullForms" style="display:none;">
        <div class="forms-wrapper">

            <!-- LEFT BUTTONS -->
        <div class="forms-left">
            <button onclick="showTypeAccounts(this)">TYPE OF ACCOUNTS</button>
            <button onclick="showRiraf(this)">RIRAF</button>
            <button onclick="showOtherContent(this)">STOCK CARD</button>
            <button onclick="showOtherContent(this)">MERCHANDISE</button>
        </div>

            <!-- RIGHT -->
            <div class="forms-right">
                <div class="type-header">
                    <label>Type of Accounts:</label>
                    <select id="accountType">
                        <option value="" disabled selected hidden>Select Type</option>
                        <option value="postage">POSTAGE STAMPS</option>
                    </select>
                </div>
                <div id="content-area"></div>
            </div>

        </div>
    </div>

</div>

</main>
</div>

<script>
    function activateLeft(index){
    // hide intro
    document.getElementById("introArea").style.display = "none";

    // show fullForms
    document.getElementById("fullForms").style.display = "block";

    // trigger corresponding button
    const btn = document.querySelectorAll('.forms-left button')[index];
    btn.click();
}

/* SIDEBAR */
function toggleSidebar(){
    document.querySelector('.sidebar').classList.toggle('collapsed');
}

/* INTRO VIEW */
function showIntro(){
    document.getElementById("introArea").style.display = "block";
    document.getElementById("fullForms").style.display = "none";
}

/* LOAD FULL SYSTEM */
function loadFullForms(){
    document.getElementById("introArea").style.display = "none";
    document.getElementById("fullForms").style.display = "block";
}

/* TYPE OF ACCOUNTS */
/* TYPE OF ACCOUNTS */
function showTypeAccounts(btn){
    document.querySelectorAll('.forms-left button').forEach(b=>{
        b.classList.remove("active");
    });
    btn.classList.add("active");

    const rightPanel = document.querySelector(".forms-right");
    const content = document.getElementById("content-area");

    // SHOW cards
    document.querySelector(".type-header").style.display = "none"; // optional: kung dropdown gusto i-hide
    rightPanel.classList.add("no-gray");

    content.innerHTML = `
    <div class="toa-outer">
        <div class="toa-container">
            <h3 class="toa-title">TYPES OF ACCOUNT</h3>
            <div class="toa-grid">
                <div class="toa-card toa-green" onclick="toaAction('add')">
                    <img src="images/addNew.png">
                    <span>Add New</span>
                </div>
                <div class="toa-card toa-blue">
                    <img src="images/view.png">
                    <span>View Result</span>
                </div>
                <div class="toa-card toa-orange">
                    <img src="images/edit.png">
                    <span>Edit Accounts</span>
                </div>
                <div class="toa-card toa-red">
                    <img src="images/delete.png">
                    <span>Delete Account</span>
                </div>
            </div>
        </div>
    </div>`;
}

/* RIRAF, STOCK CARD, MERCHANDISE */
function showOtherContent(btn){
    document.querySelectorAll('.forms-left button').forEach(b=>{
        b.classList.remove("active");
    });
    btn.classList.add("active");

    // I-hide jud ang dropdown para sa STOCK CARD & MERCHANDISE
    document.querySelector(".type-header").style.display = "none";

    // Load content
    const content = document.getElementById("content-area");
    content.innerHTML = "";

    if(btn.textContent.includes("STOCK CARD")){
        loadContent('stockcard.php', btn);
    }
    else if(btn.textContent.includes("MERCHANDISE")){
        loadContent('merchandise.php', btn);
    }
}

/* RIRAF */
function showRiraf(btn){
    document.querySelectorAll('.forms-left button').forEach(b=>{
        b.classList.remove("active");
    });
    btn.classList.add("active");

    document.querySelector(".type-header").style.display = "none";

    const content = document.getElementById("content-area");

    content.innerHTML = `
    <div class="riraf-ui">

        <div class="riraf-cards">
            <div class="riraf-card green" onclick="loadContent('riraf_add.php', this)">
                <img src="images/addNew.png">
                <span>Add New</span>
            </div>

            <div class="riraf-card blue" onclick="loadContent('riraf_view.php', this)">
                <img src="images/view.png">
                <span>View Result</span>
            </div>
        </div>
    </div>
    `;
}

/* LOAD OTHER */
function loadContent(url, btn){
    document.querySelectorAll('.forms-left button').forEach(b=>{
        b.classList.remove("active");
    });

    btn.classList.add("active");

    fetch(url)
    .then(res=>res.text())
    .then(html=>{
        document.getElementById("content-area").innerHTML = html;
    });
}

/* MODALS */
function toaAction(action){
    if(action==="add"){
        document.getElementById("toaModal").style.display="flex";
    }
}

function closeModal(){
    document.getElementById("toaModal").style.display="none";
}

function submitAccount(){
    const val=document.getElementById("newAccountInput").value;

    if(val===""){
        alert("Please enter account type");
        return;
    }

    document.getElementById("newAccountInput").value="";
    closeModal();
    document.getElementById("confirmationModal").style.display="flex";

    document.getElementById("yesBtn").onclick=()=>{
        document.getElementById("confirmationModal").style.display="none";
        document.getElementById("toaModal").style.display="flex";
    };

    document.getElementById("noBtn").onclick=()=>{
        document.getElementById("confirmationModal").style.display="none";
    };
}

</script>

<!-- MODALS -->
<div id="toaModal" class="toa-modal">
    <div class="toa-modal-content">
        <label>Enter Type of Account:</label>
        <input type="text" id="newAccountInput">

        <div class="modal-actions">
            <button onclick="submitAccount()">Add</button>
            <button onclick="closeModal()">Cancel</button>
        </div>
    </div>
</div>

<div id="confirmationModal" class="toa-modal">
    <div class="toa-modal-content">
        <p>Successfully Added!</p>
        <p>You want to ADD more?</p>

        <div class="modal-actions">
            <button id="yesBtn">Yes</button>
            <button id="noBtn">No</button>
        </div>
    </div>
</div>

</body>
</html>