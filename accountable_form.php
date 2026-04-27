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

                selectField("entry"); // balik entry form
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
    const type = document.getElementById("rirafSelect").value;
    const head = document.getElementById("rirafHead");
    const body = document.getElementById("rirafBody");
    const start = (currentPage-1)*limit;

    fetch(`db/load_riraf.php?type=${type}&start=${start}&limit=${limit}`)
    .then(res=>res.json()).then(data=>{
        let headers = "<th><input type='checkbox' id='selectAll' onclick='toggleSelectAll(this)'></th>";
        let rows = "";
        if(type!=="entry"){
            headers+=`<th>${type.toUpperCase()}</th>`;
            rows = data.length?data.map(d=>`<tr>
                <td><input type='checkbox' class='rowCheck' data-id='${d.id}'></td>
                <td>${d.name}</td>
            </tr>`).join(''):`<tr><td colspan="2">No Data</td></tr>`;
        } else {
            headers+="<th>Province</th><th>Post Office</th><th>Deno</th><th>Stamp</th><th>Item</th>";
            rows = data.length?data.map(d=>`<tr>
                <td><input type='checkbox' class='rowCheck' data-id='${d.id}'></td>
                <td>${d.province}</td>
                <td>${d.post_office}</td>
                <td>${d.deno}</td>
                <td>${d.stamp}</td>
                <td>${d.item}</td>
            </tr>`).join(''):`<tr><td colspan="6">No Data</td></tr>`;
        }
        head.innerHTML = headers;
        body.innerHTML = rows;
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

        <button onclick="submitMerch()">SUBMIT</button>
    </div>
    `;
}
function submitMerch(){
    const name = document.getElementById("merchName").value.trim();
    const qty = document.getElementById("merchQty").value.trim();
    const source = document.getElementById("merchSource").value;
    const location = document.getElementById("merchLocation").value.trim();

    if(!name || !qty || !source || !location){
        alert("Please fill all fields");
        return;
    }

    fetch('db/add_merchandise.php',{
        method:'POST',
        headers:{'Content-Type':'application/x-www-form-urlencoded'},
        body:
            'name=' + encodeURIComponent(name) +
            '&qty=' + encodeURIComponent(qty) +
            '&source=' + encodeURIComponent(source) +
            '&location=' + encodeURIComponent(location)
    })
    .then(res=>res.text())
    .then(res=>{
        if(res.trim()==="success"){
            alert("Saved!");

            const formArea = document.getElementById("merch-form-area");
            formArea.innerHTML = "";
            formArea.style.display = "none";

            viewMerchandise();
        } else {
            alert(res);
        }
    });
}
function viewMerchandise(){
    const content = document.getElementById("content-area");

    content.innerHTML = `
    <div class="merch-history-box">

<div class="merch-history-header">

        <div class="merch-history-title">
            <img src="images/history.png" class="history-icon">
            <span>History</span>
        </div>

    <input type="text" id="searchMerch" placeholder="Search...">

</div>

        <table class="merch-table">
        <thead>
            <tr>
                <th>MERCHANDISE</th>
                <th>Quantity</th>
                <th>Source</th>
                <th>Location</th>
                <th>Actions</th>
            </tr>
        </thead>
            <tbody id="merchTable"></tbody>
        </table>

        <div class="merch-pagination">
            <button>PREVIOUS</button>
            <button>NEXT</button>
        </div>

    </div>
    `;

    fetch('db/load_merchandise.php')
    .then(res=>res.json())
    .then(data=>{
        const table = document.getElementById("merchTable");

        if(!data.length){
            table.innerHTML = "<tr><td colspan='3'>No Data</td></tr>";
            return;
        }

        table.innerHTML = data.map(d=>`
            <tr>
                <td>${d.name}</td>
                <td>${d.qty}</td>
                <td>${d.source}</td>
                <td>${d.location}</td>
            <td class="actions">

                <button class="add">
                    <img src="images/add_merch.png" alt="Add">
                </button>

                <button class="edit">
                    <img src="images/edit_merch.png" alt="Edit">
                </button>

                <button class="delete" onclick="confirmDelete(${d.id})">
                    <img src="images/del_merch.png">
                </button>

            </td>
            </tr>
        `).join('');
    });
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