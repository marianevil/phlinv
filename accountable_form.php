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

                    <p class="card-desc">
                        Stores and manages different classifications of accountable forms that the admin can add or update.
                    </p>
            </div>

            <div class="intro-card" onclick="activateLeft(1)">
                <img src="images/riraf.png" alt="RIRAF Icon" class="intro-icon">
                <span>RIRAF</span>

                    <p class="card-desc">
                        Pre-setup module where the admin configures all required data so users can select from ready-made dropdown options.
                    </p>
            </div>

            <div class="intro-card" onclick="activateLeft(2)">
                <img src="images/stockCard.png" alt="Stock Card Icon" class="intro-icon">
                <span>STOCK CARD</span>

                    <p class="card-desc">
                        Records all issued accountable forms by the users and tracks who issued them along with the transaction details.
                    </p>
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

                    <p class="card-desc">
                        Allows the admin to add new account types such as "postage stamps, philatelic stamps etc.".
                    </p>
                </div>
                <div class="toa-card toa-blue" onclick="viewTypeAccounts()">
                    <img src="images/view.png">
                    <span>View Result</span>

                    <p class="card-desc">
                        Displays all the account types that have been added and recorded in the system.
                    </p>
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
                <p class="card-desc">
                    Allows the admin add provinces, post offices, denominations, kinds of stamps, and items that users can select when filling out forms.
                </p>
            </div>
            <div class="riraf-card blue" onclick="showRirafView()">
                <img src="images/view.png"><span>View Result</span>

                <p class="card-desc">
                    Displays all the pre-configured data for provinces, post offices, denominations, kinds of stamps, and items that have been added by the admin.
                </p>
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
            
          
            ${[ /*remove lang dayun ang DESC KAY FOR DESCRIPTION RAN*/
            {
                key:'province',
                title:'Province',
                desc:'Add new provinces for selection forms in user.' 
            },
            {
                key:'postoffice',
                title:'Post Office Name',
                desc:'Add post office names together with ZIP codes.' 
            },
            {
                key:'denomination',
                title:'Denomination',
                desc:'Add new denomination values for accountable forms.'
            },
            {
                key:'stamp',
                title:'Stamps',
                desc:'Add new kinds of stamps used in transactions.'
            },
            {
                key:'item',
                title:'Item',
                desc:'Add new accountable form items for selection.'
            }
            ].map(f=>`
                <div class="riraf-box" data-field="${f.key}">
                    <img src="images/${f.key}.png">

                    <span class="riraf-box-title">
                        ${f.title}
                    </span>

                    <p class="riraf-box-desc">
                        ${f.desc}
                    </p>
                </div>
            `).join('')}
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


/* ✅ NEW POST OFFICE FORM */
if(type==="postoffice"){
    popup.innerHTML = `<div class="riraf-popup-box">

        <label>Post Office Name</label>
        <input type="text" id="poName">

        <label>Zip Code</label>
        <input type="text" id="poZip">

        <div class="popup-actions">
            <button class="bck-btn" onclick="closePopup()">BACK</button>
            <button class="sbmt-btn" onclick="submitPostOffice()">SUBMIT</button>
        </div>

    </div>`;
}

else{
    let labelText = {
        "province":"Enter Province",
        "denomination":"Enter Denomination",
        "stamp":"Enter Stamp",
        "item":"Enter Item"
    }[type];

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
                    <th>ZIP CODE</th>
                    <th>PROVINCE</th>
                `;

                if(data.length){

                    rows = data.map(d=>`
                    <tr>
                        <td><input type='checkbox' class='rowCheck' data-id='${d.id}'></td>
                        <td>${d.name}</td>
                        <td>${d.zip || ''}</td>
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
            else{

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
                    <th>Province</th>
                    <th>Post Office</th>
                    <th>User</th>
                    <th>Export</th>
                </tr>
            </thead>

            <tbody></tbody>

        </table>
    </div>

</div>
`;

loadStockCardAdmin(); // ✅ CALL HERE

}


    

}
async function loadStockCardAdmin(){

    const res = await fetch("db/load_stockcard_admin.php");
    const data = await res.json();

    const tbody = document.querySelector(".scard-table tbody");

    tbody.innerHTML = data.map(d => `
        <tr>
            <td>${d.date}</td>
            <td>${d.filename}</td>
            <td>${d.province}</td>
            <td>${d.post_office}</td>
            <td>${d.created_by}</td>
            <td>
                <button class="export-btn">
                    <img src="images/export.png" class="export-icon">
                    Export
                </button>
            </td>
        </tr>
    `).join("");

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