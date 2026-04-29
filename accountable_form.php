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
            <a href="masterlist_admin.php">
                <img src="images/masterlist.png" class="side-icon">
                <span>MASTERLISTS</span>
            </a>
        </li>
        <li>
            <a href="approve_requests.php">
                <img src="images/approve.png" class="side-icon">
                <span>APPROVE & RELEASE</span>
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
/* ===================== GLOBAL VARIABLES ===================== */
let typeAccounts = [];
let currentPage = 1;
const limit = 5;

/* ===================== LOAD TYPE ACCOUNTS ===================== */
window.addEventListener('DOMContentLoaded', () => {
    fetch('db/get_accounts.php')
    .then(res => res.json())
    .then(data => { typeAccounts = data.map(a => a.name); })
    .catch(err => console.error(err));
});

/* ===================== SIDEBAR ===================== */
function toggleSidebar(){ document.querySelector('.sidebar').classList.toggle('collapsed'); }
function showIntro(){
    document.getElementById("introArea").style.display = "block";
    document.getElementById("fullForms").style.display = "none";
}

/* ===================== LEFT MENU ===================== */
function activateLeft(index){
    document.getElementById("introArea").style.display = "none";
    document.getElementById("fullForms").style.display = "block";
    document.querySelectorAll('.forms-left button')[index].click();
}

/* ===================== TYPE OF ACCOUNTS ===================== */
function showTypeAccounts(btn){
    document.querySelectorAll('.forms-left button').forEach(b=> b.classList.remove("active"));
    btn.classList.add("active");

    const content = document.getElementById("content-area");
    document.querySelector(".type-header").style.display = "none";
    document.querySelector(".forms-right").classList.add("no-gray");

    content.innerHTML = `
    <div class="toa-outer">
        <div class="toa-container">
            <h3 class="toa-title">TYPES OF ACCOUNT</h3>
            <div class="toa-grid">
                <div class="toa-card toa-green" onclick="toaAction('add')">
                    <img src="images/addNew.png">
                    <span>Add New</span>
                </div>
                <div class="toa-card toa-blue" onclick="viewTypeAccounts()">
                    <img src="images/view.png">
                    <span>View Result</span>
                </div>
            </div>
        </div>
    </div>`;
}

function viewTypeAccounts(){
    const content = document.getElementById("content-area");
    let rows = typeAccounts.length
        ? typeAccounts.map(acc => `<tr>
                <td>${acc}</td>
                <td><button class="edt-btn">Edit</button>
                    <button class="del-btn" onclick="deleteAccount(this)">Delete</button>
                </td>
            </tr>`).join("")
        : `<tr><td colspan="2" style="text-align:center;">No accounts yet.</td></tr>`;

    content.innerHTML = `<div class="toa-view-wrapper">
        <div class="toa-view-container">
            <div class="toa-view-header">
                <h3>List of Accounts:</h3>
                <button class="back-btn" onclick="showTypeAccounts(document.querySelector('.forms-left button.active'))">
                    <img src="images/back.png" class="back-icon">Back
                </button>
            </div>
            <table class="toa-table">
                <thead><tr><th>Accounts</th><th>Action</th></tr></thead>
                <tbody>${rows}</tbody>
            </table>
        </div>
    </div>`;
}

function deleteAccount(btn){
    if(confirm("Are you sure?")){
        const row = btn.closest("tr");
        const accountName = row.querySelector("td").innerText;
        fetch('db/delete_account.php', {
            method:'POST',
            headers:{'Content-Type':'application/x-www-form-urlencoded'},
            body:'account=' + encodeURIComponent(accountName)
        }).then(res=>res.text()).then(res=>{
            if(res.trim()==="success"){
                typeAccounts = typeAccounts.filter(a=>a!==accountName);
                row.remove();
            } else alert(res);
        });
    }
}

/* ===================== TOA MODAL ===================== */
function toaAction(action){
    if(action==="add"){ document.getElementById("toaModal").style.display="flex"; }
}
function closeModal(){ document.getElementById("toaModal").style.display="none"; }

function submitAccount(){
    const val = document.getElementById("newAccountInput").value.trim();
    if(!val){ alert("Please enter account type"); return; }
    fetch('db/add_account.php',{
        method:'POST',
        headers:{'Content-Type':'application/x-www-form-urlencoded'},
        body:'account='+encodeURIComponent(val)
    }).then(res=>res.text())
      .then(res=>{
        if(res.trim()==="success"){
            typeAccounts.push(val);
            document.getElementById("newAccountInput").value="";
            closeModal();
            document.getElementById("confirmationModal").style.display="flex";
            document.getElementById("yesBtn").onclick=()=>{
                document.getElementById("confirmationModal").style.display="none";
                document.getElementById("toaModal").style.display="flex";
            };
            document.getElementById("noBtn").onclick=()=>{
                document.getElementById("confirmationModal").style.display="none";
                viewTypeAccounts();
            };
        } else alert(res);
    }).catch(err=>console.error(err));
}

/* ===================== RIRAF ===================== */
function showRiraf(btn){
    document.querySelectorAll('.forms-left button').forEach(b=>b.classList.remove("active"));
    btn.classList.add("active");
    document.querySelector(".type-header").style.display="none";

    const content = document.getElementById("content-area");
    content.innerHTML = `<div class="riraf-ui" style="position: relative; min-height:200px;">
        <div id="riraf-form-area" class="riraf-form-overlay-small"></div>
        <div class="riraf-cards">
            <div class="riraf-card green" onclick="rirafAddForm()">
                <img src="images/addNew.png"><span>Add New</span>
            </div>
            <div class="riraf-card blue" onclick="showRirafView()">
                <img src="images/view.png"><span>View Result</span>
            </div>
        </div>
    </div>`;
}

function rirafAddForm(){
    const formArea = document.getElementById("riraf-form-area");
    formArea.innerHTML = `<div class="riraf-select-wrapper">
        <div class="riraf-select-container">
            <h3 class="riraf-title">SELECT BUTTONS TO ADD</h3>
            <div class="riraf-grid">
                ${['province','postoffice','denomination','stamp','item','entry'].map(f=>`
                    <div class="riraf-box" data-field="${f}">
                        <img src="images/${f}.png"><span>${f==="postoffice"?"Post Office Name":f.charAt(0).toUpperCase()+f.slice(1)}</span>
                    </div>`).join('')}
            </div>
        </div>
    </div>`;
    formArea.querySelectorAll('.riraf-box').forEach(box=>{
        box.addEventListener('click',()=>selectField(box.dataset.field));
    });
}

function selectField(type){
    setTimeout(()=>{
        document.querySelectorAll(".riraf-box").forEach(b=>b.classList.remove("selected"));
        const box = Array.from(document.querySelectorAll(".riraf-box")).find(b=>b.dataset.field===type);
        if(box) box.classList.add("selected");
    },50);

    if(document.querySelector(".riraf-popup")) return;
    const popup = document.createElement("div");
    popup.className = (type==="entry")?"riraf-popup entry-popup":"riraf-popup";

    if(type==="entry"){
        popup.innerHTML = `<div class="riraf-popup-box entry-layout">
            <div class="entry-left">
                <h3>Entry Form:</h3>
                <label>PROVINCE:</label><input type="text" id="entryProvince">
                <label>POST OFFICE NAME:</label><input type="text" id="entryPostOffice">
                <label>DENO:</label><input type="text" id="entryDeno">
                <label>KIND OF STAMPS:</label><input type="text" id="entryStamp">
                <label>ITEM:</label><input type="text" id="entryItem">
                <div class="popup-actions">
                    <button class="bck-btn" onclick="closePopup()">BACK</button>
                    <button class="sbmt-btn" onclick="submitEntry()">SUBMIT</button>
                </div>
            </div>
            <div class="entry-right"></div>
        </div>`;
    } else {
        let labelText = {"province":"Enter Province","postoffice":"Enter Post Office","denomination":"Enter Denomination","stamp":"Enter Stamp","item":"Enter Item"}[type];
        popup.innerHTML = `<div class="riraf-popup-box">
            <label>${labelText}</label>
            <input type="text" id="dynamicInput" placeholder="${labelText}">
            <div class="popup-actions">
                <button class="bck-btn" onclick="closePopup()">BACK</button>
                <button class="sbmt-btn" onclick="submitDynamic('${type}')">SUBMIT</button>
            </div>
        </div>`;
    }
    document.querySelector(".riraf-ui").appendChild(popup);
}
function submitDynamic(type){
    const val = document.getElementById("dynamicInput").value.trim();

    if(!val){
        alert("Please fill out");
        return;
    }

    fetch('db/add_riraf.php',{
        method:'POST',
        headers:{'Content-Type':'application/x-www-form-urlencoded'},
        body:'type='+encodeURIComponent(type)+'&value='+encodeURIComponent(val)
    })
    .then(res=>res.text())
    .then(res=>{
        if(res.trim()==="success"){

            closePopup();

            document.getElementById("rirafConfirm").style.display="flex";

            // ADD MORE
            document.getElementById("rirafAddMore").onclick = () => {

                document.getElementById("rirafConfirm").style.display="none";

                selectField(type); // balik sa same input form
            };

            // CANCEL
            document.getElementById("rirafCancel").onclick = () => {

                document.getElementById("rirafConfirm").style.display="none";

                showRirafView();
            };

        }else{
            alert(res);
        }
    });
}
function submitEntry(){

    const p = document.getElementById("entryProvince").value.trim();
    const po = document.getElementById("entryPostOffice").value.trim();
    const d = document.getElementById("entryDeno").value.trim();
    const s = document.getElementById("entryStamp").value.trim();
    const i = document.getElementById("entryItem").value.trim();

    if(!p||!po||!d||!s||!i){
        alert("All fields required");
        return;
    }

    fetch('db/add_riraf.php',{
        method:'POST',
        headers:{'Content-Type':'application/x-www-form-urlencoded'},
        body:`type=entry&province=${encodeURIComponent(p)}&postOffice=${encodeURIComponent(po)}&deno=${encodeURIComponent(d)}&stamp=${encodeURIComponent(s)}&item=${encodeURIComponent(i)}`
    })
    .then(res=>res.text())
    .then(res=>{
        if(res.trim()==="success"){

            closePopup();

            document.getElementById("rirafConfirm").style.display="flex";

            document.getElementById("rirafAddMore").onclick = () => {

                document.getElementById("rirafConfirm").style.display="none";

                selectField("entry"); 
            };

            document.getElementById("rirafCancel").onclick = () => {

                document.getElementById("rirafConfirm").style.display="none";

                showRirafView();
            };

        }else{
            alert(res);
        }
    });
}
function closePopup(){ const p = document.querySelector(".riraf-popup"); if(p)p.remove(); }

/* ===================== RIRAF VIEW ===================== */
function showRirafView(){
    const content = document.getElementById("content-area");
    content.innerHTML = `
    <div class="riraf-view-wrapper">
        <h3 class="riraf-view-title">VIEW RESULT</h3>
        <div class="riraf-top-bar">
            <label>SELECT TYPE:</label>
            <select id="rirafSelect" onchange="updateRirafTable()">
                <option value="province">Province</option>
                <option value="postoffice">Post Office Name</option>
                <option value="denomination">Denomination</option>
                <option value="stamp">Kinds of Stamp</option>
                <option value="item">Item</option>
                <option value="entry">Entry Form</option>
            </select>
            <div style="margin-left:auto;">
                <button onclick="showRiraf(document.querySelector('.forms-left button.active'))">Back</button>
                <button onclick="deleteSelected()">Delete</button>
            </div>
        </div>
        <div style="overflow:auto; max-height:400px;">
            <table border="1" width="100%" style="border-collapse:collapse;">
                <thead><tr id="rirafHead"></tr></thead>
                <tbody id="rirafBody"></tbody>
            </table>
        </div>
        <div style="display:flex; justify-content:space-between;">
            <button onclick="prevPage()">Previous</button>
            <button onclick="nextPage()">Next</button>
        </div>
    </div>`;
    currentPage=1; updateRirafTable();
}

function updateRirafTable(){

    const type  = document.getElementById("rirafSelect").value;
    const head  = document.getElementById("rirafHead");
    const body  = document.getElementById("rirafBody");
    const start = (currentPage-1)*limit;

    fetch(`db/load_riraf.php?type=${type}&start=${start}&limit=${limit}`)
    .then(res=>res.json())
    .then(data=>{

        fetch(`db/load_riraf.php?type=province&start=0&limit=999`)
        .then(res=>res.json())
        .then(provinceData=>{

            let provinceOptions = "";

            provinceData.forEach(p=>{
                provinceOptions += `
                    <option value="${p.name}">
                        ${p.name}
                    </option>
                `;
            });

            let headers = "<th><input type='checkbox' onclick='toggleSelectAll(this)'></th>";
            let rows = "";

            /* ================= POST OFFICE ================= */
            if(type==="postoffice"){

                headers += `
                    <th>POST OFFICE NAME</th>
                    <th>PROVINCE</th>
                `;

                if(data.length){

                    rows = data.map(d=>`

                        <tr>

                            <td>
                                <input type='checkbox' class='rowCheck' data-id='${d.id}'>
                            </td>

                            <td>${d.name}</td>

                            <td>
                                <select class="province-dropdown" onchange="saveProvince(this, ${d.id})">

                                <option value="">Select Province</option>

                                ${provinceData.map(p=>`
                                <option value="${p.name}"
                                ${d.province===p.name ? "selected" : ""}>
                                ${p.name}
                                </option>
                                `).join('')}

                                </select>
                            </td>

                        </tr>

                    `).join('');

                }else{

                    rows = `
                        <tr>
                            <td colspan="3">No Data</td>
                        </tr>
                    `;
                }

            }

            /* NORMAL */
            else if(type!=="entry"){

                headers += `<th>${type.toUpperCase()}</th>`;

                rows = data.length ? data.map(d=>`
                    <tr>
                        <td>
                            <input type='checkbox' class='rowCheck' data-id='${d.id}'>
                        </td>
                        <td>${d.name}</td>
                    </tr>
                `).join('')
                :
                `<tr><td colspan="2">No Data</td></tr>`;
            }

            /* ENTRY */
            else{

                headers += `
                    <th>Province</th>
                    <th>Post Office</th>
                    <th>Deno</th>
                    <th>Stamp</th>
                    <th>Item</th>
                `;

                rows = data.length ? data.map(d=>`
                    <tr>
                        <td><input type='checkbox' class='rowCheck' data-id='${d.id}'></td>
                        <td>${d.province}</td>
                        <td>${d.post_office}</td>
                        <td>${d.deno}</td>
                        <td>${d.stamp}</td>
                        <td>${d.item}</td>
                    </tr>
                `).join('')
                :
                `<tr><td colspan="6">No Data</td></tr>`;
            }

            head.innerHTML = headers;
            body.innerHTML = rows;

        });

    });

}

function toggleSelectAll(master){ document.querySelectorAll(".rowCheck").forEach(cb=>cb.checked=master.checked); }
function nextPage(){ currentPage++; updateRirafTable(); }
function prevPage(){ if(currentPage>1){ currentPage--; updateRirafTable(); } }

function deleteSelected(){
    const type = document.getElementById("rirafSelect").value;
    const selected = Array.from(document.querySelectorAll(".rowCheck:checked")).map(cb=>cb.dataset.id);
    if(!selected.length){ alert("Select at least one record"); return; }
    if(!confirm("Delete selected records?")) return;

    fetch('db/delete_riraf.php',{
        method:'POST',
        headers:{'Content-Type':'application/x-www-form-urlencoded'},
        body:'type='+encodeURIComponent(type)+'&ids='+encodeURIComponent(JSON.stringify(selected))
    }).then(res=>res.text()).then(res=>{
        if(res.trim()==="Deleted successfully") updateRirafTable();
        else alert(res);
    });
}

/* ===================== OTHER CONTENT ===================== */
function showOtherContent(btn){
    document.querySelectorAll('.forms-left button').forEach(b=>b.classList.remove("active"));
    btn.classList.add("active");
    document.querySelector(".type-header").style.display="none";

    const content = document.getElementById("content-area");

    if(btn.textContent.includes("STOCK CARD")){

content.innerHTML = `
<div class="scard-container">

    <div class="scard-title">
        STOCK CARD REPORTS
    </div>

    <div class="scard-filter">

        <div class="scard-filter-left">
            <div class="scard-input-group">
                <label>Date From</label>
                <input type="date">
            </div>

            <div class="scard-input-group">
                <label>Date To</label>
                <input type="date">
            </div>
        </div>

        <div class="scard-filter-right">
            <input type="text" placeholder="Search...">
        </div>

    </div>

    <div class="scard-table-wrapper">
        <table class="scard-table">

            <thead>
                <tr>
                    <th>Date</th>
                    <th>File Name</th>
                    <th>User</th>
                    <th>Export</th>    
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td>4/16/2024</td>
                    <td>Postage-Stamp_002</td>
                    <td>Mike</td>
                    <td>
                        <button class="export-btn">
                            <img src="images/export.png" class="export-icon">
                            Export
                        </button>
                    </td>
                </tr>
            </tbody>

        </table>
    </div>

    <div class="scard-pagination">
        <button>PREVIOUS</button>

        <div class="scard-page-num">
            <span class="active">1</span>
        </div>

        <button>NEXT</button>
    </div>

</div>
`;
    }

    else if(btn.textContent.includes("MERCHANDISE")){

content.innerHTML = `
<div class="merch-ui">

    <div id="merch-form-area" class="merch-form-overlay"></div>

    <div class="merch-cards">

        <div class="merch-card green" onclick="openMerchForm()">
            <img src="images/addNew.png">
            <span>Add New</span>
        </div>

        <div class="merch-card blue" onclick="viewMerchandise()">
            <img src="images/view.png">
            <span>View Result</span>
        </div>

    </div>

</div>
`;
}
}

function openMerchForm(){
    const formArea = document.getElementById("merch-form-area");

    formArea.style.display = "flex"; // ipakita ang overlay

    formArea.innerHTML = `
    <div class="merch-popup">
        <label>Merchandise:</label>
        <input type="text" id="merchName">

        <label>Quantity:</label>
        <input type="number" id="merchQty">

        <label>Source:</label>
        <select id="merchSource">
            <option value="Supplier">Supplier</option>
            <option value="Transfer">Transfer</option>
            <option value="Return">Return</option>
        </select>

        <label>Location:</label>
        <input type="text" id="merchLocation" placeholder="Enter location">

                <!-- ✅ NEW FIELD -->
        <label>Date Received:</label>
        <input type="date" id="merchDate">

        <button onclick="submitMerch()">SUBMIT</button>
    </div>
    `;
}

function submitMerch(){

const name = document.getElementById("merchName").value.trim();
const qty = document.getElementById("merchQty").value.trim();
const source = document.getElementById("merchSource").value;
const location = document.getElementById("merchLocation").value.trim();
const date = document.getElementById("merchDate").value;

if(!name || !qty || !location || !date){
    alert("Fill all fields");
    return;
}

fetch("db/add_merchandise.php",{
    method:"POST",
    headers:{
        "Content-Type":"application/x-www-form-urlencoded"
    },
    body:
    "name="+encodeURIComponent(name)+
    "&qty="+encodeURIComponent(qty)+
    "&source="+encodeURIComponent(source)+
    "&location="+encodeURIComponent(location)+
    "&date="+encodeURIComponent(date)
})
.then(res=>res.text())
.then(res=>{

    if(res.trim()=="success"){

        alert("Added Successfully!");

        document.getElementById("merch-form-area").innerHTML="";
        document.getElementById("merch-form-area").style.display="none";

        viewMerchandise(); // auto refresh

    }else{
        alert(res);
    }

});
}

let merchPage = 1;
const merchLimit = 8;

/* ================= VIEW MERCHANDISE ================= */
function viewMerchandise(page = 1){

    merchPage = page;

    const content = document.getElementById("content-area");

    content.innerHTML = `
    <div class="merch-history-box">

        <!-- HISTORY HEADER -->
        <div class="merch-history-header">

        <div class="merch-history-title" onclick="toggleHistory()">
            <img src="images/history.png" class="history-icon">
            <span>History</span>
        </div>

            <input type="text" id="searchMerch" placeholder="Search..." onkeyup="viewMerchandise(1)">

        </div>

        <!-- HISTORY RECORDS -->
        <div id="historyArea" style="margin-bottom:15px;"></div>

        <!-- TABLE -->
        <table class="merch-table">

            <thead>
                <tr>
                    <th>MERCHANDISE</th>
                    <th>QUANTITY</th>
                    <th>SOURCE</th>
                    <th>LOCATION</th>
                    <th>DATE RECEIVED</th>
                    <th>ACTIONS</th>
                </tr>
            </thead>

            <tbody id="merchTable"></tbody>

        </table>

        <!-- PAGINATION -->
        <div class="merch-pagination">
            <button onclick="prevMerch()">PREVIOUS</button>
            <button onclick="nextMerch()">NEXT</button>
        </div>

    </div>

            <div id="merchHistoryPanel" class="history-panel" style="display:none;">
            <div class="history-panel-header">
                <span>MERCHANDISE HISTORY</span>
                <button onclick="toggleMerchHistory()">✖</button>
            </div>

            <div id="historyContent" class="history-panel-body">
                Loading...
            </div>
        </div>
    `;

    

    fetch("db/load_merchandise.php")
    .then(res => res.json())
    .then(data => {

        const table = document.getElementById("merchTable");
        const search = document.getElementById("searchMerch").value.toLowerCase();

        let filtered = data.filter(d =>
            d.name.toLowerCase().includes(search) ||
            d.source.toLowerCase().includes(search) ||
            d.location.toLowerCase().includes(search)
        );

        if(filtered.length === 0){
            table.innerHTML = `
            <tr>
                <td colspan="6">No Data</td>
            </tr>`;
            loadMerchHistory();
            return;
        }

        let start = (page - 1) * merchLimit;
        let end   = start + merchLimit;

        let rows = filtered.slice(start,end);

        table.innerHTML = rows.map(d => `

        <tr>

            <td>${d.name}</td>
            <td>${d.qty}</td>
            <td>${d.source}</td>
            <td>${d.location}</td>
            <td>${d.date_received}</td>

            <td class="actions">

                <button class="add" onclick="addQty(${d.id})">
                    <img src="images/add_merch.png" alt="Add">
                </button>

                <button class="edit"
                onclick="editMerch(
                    ${d.id},
                    '${d.name}',
                    '${d.qty}',
                    '${d.source}',
                    '${d.location}',
                    '${d.date_received}'
                )">
                    <img src="images/edit_merch.png" alt="Edit">
                </button>

                <button class="delete" onclick="deleteMerch(${d.id})">
                    <img src="images/del_merch.png" alt="Delete">
                </button>

            </td>

        </tr>

        `).join("");

        loadMerchHistory();

    });

}

/* ================= NEXT / PREVIOUS ================= */
function nextMerch(){
    merchPage++;
    viewMerchandise(merchPage);
}

function prevMerch(){
    if(merchPage > 1){
        merchPage--;
        viewMerchandise(merchPage);
    }
}

/* ================= ADD QUANTITY ================= */
/* kapag click + maglalagay ka quantity na idadagdag */
function addQty(id){

    let qtyAdd = prompt("Enter quantity to add:");

    if(qtyAdd === null || qtyAdd.trim() === "") return;

    fetch("db/add_qty.php",{
        method:"POST",
        headers:{
            "Content-Type":"application/x-www-form-urlencoded"
        },
        body:
        "id=" + encodeURIComponent(id) +
        "&qty=" + encodeURIComponent(qtyAdd)
    })
    .then(res=>res.text())
    .then(res=>{

        if(res.trim() === "success"){
            viewMerchandise(merchPage);   // auto refresh table
        }else{
            alert(res);
        }

    });

}


/* ================= EDIT ================= */
/* same style ng Add New popup form */
function editMerch(id,name,qty,source,location,date){

    const formArea = document.getElementById("merch-form-area");

    if(formArea){
        formArea.style.display = "flex";
        formArea.innerHTML = `
        <div class="merch-popup">

            <label>Merchandise:</label>
            <input type="text" id="editName" value="${name}">

            <label>Quantity:</label>
            <input type="number" id="editQty" value="${qty}">

            <label>Source:</label>
            <select id="editSource">
                <option value="Supplier" ${source==="Supplier"?"selected":""}>Supplier</option>
                <option value="Transfer" ${source==="Transfer"?"selected":""}>Transfer</option>
                <option value="Return" ${source==="Return"?"selected":""}>Return</option>
            </select>

            <label>Location:</label>
            <input type="text" id="editLocation" value="${location}">

            <label>Date Received:</label>
            <input type="date" id="editDate" value="${date}">

            <div style="margin-top:10px; display:flex; gap:10px;">

                <button onclick="submitEdit(${id})">UPDATE</button>

                <button onclick="closeEditMerch()">CANCEL</button>

            </div>

        </div>
        `;
    }else{
        /* fallback kung nasa View Result page */
        document.body.insertAdjacentHTML("beforeend",`
        <div id="editMerchModal" class="toa-modal" style="display:flex;">
            <div class="toa-modal-content">

                <label>Merchandise:</label>
                <input type="text" id="editName" value="${name}">

                <label>Quantity:</label>
                <input type="number" id="editQty" value="${qty}">

                <label>Source:</label>
                <select id="editSource">
                    <option value="Supplier" ${source==="Supplier"?"selected":""}>Supplier</option>
                    <option value="Transfer" ${source==="Transfer"?"selected":""}>Transfer</option>
                    <option value="Return" ${source==="Return"?"selected":""}>Return</option>
                </select>

                <label>Location:</label>
                <input type="text" id="editLocation" value="${location}">

                <label>Date Received:</label>
                <input type="date" id="editDate" value="${date}">

                <div class="modal-actions">
                    <button onclick="submitEdit(${id})">Update</button>
                    <button onclick="closeEditMerch()">Cancel</button>
                </div>

            </div>
        </div>
        `);
    }

}

/* ================= DELETE ================= */
function deleteMerch(id){

    if(confirm("Delete this record?")){

        fetch("db/delete_merchandise.php",{
            method:"POST",
            headers:{
                "Content-Type":"application/x-www-form-urlencoded"
            },
            body:"id="+id
        })
        .then(res=>res.text())
        .then(()=>{
            viewMerchandise(merchPage);
        });

    }

}


/* ================= SUBMIT EDIT ================= */
function submitEdit(id){

    const name = document.getElementById("editName").value.trim();
    const qty  = document.getElementById("editQty").value.trim();
    const source = document.getElementById("editSource").value;
    const location = document.getElementById("editLocation").value.trim();
    const date = document.getElementById("editDate").value;

    if(!name || !qty || !location || !date){
        alert("Please fill all fields");
        return;
    }

    fetch("db/edit_merchandise.php",{
        method:"POST",
        headers:{
            "Content-Type":"application/x-www-form-urlencoded"
        },
        body:
        "id=" + encodeURIComponent(id) +
        "&name=" + encodeURIComponent(name) +
        "&qty=" + encodeURIComponent(qty) +
        "&source=" + encodeURIComponent(source) +
        "&location=" + encodeURIComponent(location) +
        "&date=" + encodeURIComponent(date)
    })
    .then(res=>res.text())
    .then(res=>{

        if(res.trim() === "success"){
            closeEditMerch();
            viewMerchandise(merchPage);   // auto refresh
        }else{
            alert(res);
        }

    });

}


/* ================= CLOSE EDIT ================= */
function closeEditMerch(){

    const popup = document.getElementById("merch-form-area");
    if(popup){
        popup.innerHTML = "";
        popup.style.display = "none";
    }

    const modal = document.getElementById("editMerchModal");
    if(modal) modal.remove();

}

/* ================= HISTORY ================= */
let historyPage = 1;

function loadMerchHistory(page=1){

    fetch("db/load_merch_history.php")
    .then(res=>res.json())
    .then(data=>{

        let records = data.records || [];

        let limit = 4;
        let start = (page-1)*limit;
        let end = start + limit;

        let rows = records.slice(start,end);

        let html = `
        <div class="history-panel">

            <div class="history-panel-header">
                <span>MERCHANDISE HISTORY</span>
                <button onclick="document.querySelector('.history-panel').style.display='none'">X</button>
            </div>

            <div class="history-panel-body">
            <input type="text"
                id="historySearch"
                placeholder="Search merchandise history..."
                onkeyup="filterHistory()">

            <div id="historyTableWrap">

            <table class="history-table">
            <thead>
            <tr>
                <th>ACTIONS</th>
                <th>OLD DETAILS</th>
                <th>NEW DETAILS</th>
                <th>DATE</th>
            </tr>
            </thead>
            <tbody>
        `;

        rows.forEach(r => {

            html += `
            <tr>
                <td>${r.action}</td>

                <td style="white-space:pre-line; text-align:left;">
                    ${r.old_details}
                </td>

                <td style="white-space:pre-line; text-align:left;">
                    ${r.new_details}
                </td>

                <td>${r.date_created}</td>
            </tr>
            `;
        });

        html += `
                </tbody>
            </table>

            </div>

            <div class="history-pagination">
                <button ${page <= 1 ? "disabled" : ""} onclick="loadMerchHistory(${page-1})">PREVIOUS</button>
                <button onclick="loadMerchHistory(${page+1})">NEXT</button>
            </div>

        </div>

                </div> <!-- end historyTableWrap -->
        </div>
        `;

        let panel = document.querySelector(".history-panel");

        if(!panel){
            document.body.insertAdjacentHTML("beforeend",html);
        }else{
            panel.outerHTML = html;
        }

    });

}

let historyTimer;

function filterHistory(){

    clearTimeout(historyTimer);

    historyTimer = setTimeout(() => {

        let input = document.getElementById("historySearch").value.toLowerCase();
        let rows = document.querySelectorAll(".history-table tbody tr");

        rows.forEach(row => {
            let text = row.innerText.toLowerCase();
            row.style.display = text.includes(input) ? "" : "none";
        });

    }, 150); // delay para smooth

}

function extractField(text, field){
    if(!text) return "";

    let match = text.match(new RegExp(field + ":\\s*(.*)"));
    return match ? match[1] : "";
}

function nextHistory(){
    historyPage++;
    loadMerchHistory(historyPage);
}

function prevHistory(){
    if(historyPage > 1){
        historyPage--;
        loadMerchHistory(historyPage);
    }
}

function saveProvince(select,id){

    let province = select.value;

    fetch("db/save_postoffice_province.php",{
        method:"POST",
        headers:{
            "Content-Type":"application/x-www-form-urlencoded"
        },
        body:
        "id="+encodeURIComponent(id)+
        "&province="+encodeURIComponent(province)
    })
    .then(res=>res.text())
    .then(res=>{

        if(res.trim()=="success"){
            console.log("Saved");
        }else{
            alert("Failed to save");
        }

    });

}

function toggleMerchHistory(){

    const panel = document.getElementById("merchHistoryPanel");

    if(panel.style.display === "flex"){
        panel.style.display = "none";
    }else{
        panel.style.display = "flex";
        loadMerchHistory();
    }

}

function toggleHistory(){

    let panel = document.querySelector(".history-panel");

    // if wala pa, create first
    if(!panel){
        loadMerchHistory(); // create panel muna
        return;
    }

    // toggle show/hide
    if(panel.style.display === "flex"){
        panel.style.display = "none";
    }else{
        panel.style.display = "flex";
    }
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
<div id="rirafConfirm" class="toa-modal">
    <div class="toa-modal-content">
        <p>Successfully Added!</p>
        <p>Do you want to add more?</p>

        <div class="modal-actions">
            <button id="rirafAddMore">Add More</button>
            <button id="rirafCancel">Cancel</button>
        </div>
    </div>
</div>

</body>
</html>