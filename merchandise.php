<?php
include 'db/connection.php';
include 'header.php';

/* ================= PAGINATION ================= */

$rowsPerPage = 10;

$currentPage = isset($_GET['page'])
    ? max(1, intval($_GET['page']))
    : 1;

$totalQuery = $conn->query("
    SELECT COUNT(*) AS total
    FROM merchandise
");

$totalRow = $totalQuery->fetch_assoc();

$totalRows = $totalRow['total'];

$totalPages = ceil($totalRows / $rowsPerPage);

$offset = ($currentPage - 1) * $rowsPerPage;

/* ================= FETCH DATA ================= */

$query = $conn->query("
    SELECT *
    FROM merchandise
    ORDER BY id DESC
    LIMIT $offset, $rowsPerPage
");
?>

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<main class="dashboard-bg">

    <!-- TOP -->
    <div class="riraf-table-header">

        <div class="riraf-top-left">
            MERCHANDISE
        </div>


<!--delete this description later, for now just for reference-->


        <div class="card-desc">
            <p>
                This module manages all merchandise records including incoming, transferred, returned, and distributed items.
                It allows users to track quantity, source, location, and date received for proper inventory monitoring and control.
            </p>
        </div>

        <div class="riraf-search">

            <input type="text"
                   id="searchMerch"
                   placeholder="Search Merchandise...">

            <button class="blue-btn"
                    onclick="openMerchModal()">

                <i class="fa-solid fa-plus"></i>
                Add New

            </button>

        </div>

    </div>

    <!-- TABLE WRAPPER -->
    <div class="riraf-table-wrapper">

        <!-- TITLE -->
        <div class="riraf-table-header">

            <div class="riraf-center">
                MERCHANDISE RECORDS
            </div>

        </div>

        <!-- TABLE -->
        <table class="riraf-table" id="merchTable">

            <thead>
                <tr>
                    <th>Merchandise</th>
                    <th>Quantity</th>
                    <th>Source</th>
                    <th>Location</th>
                    <th>Date Received</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>

<?php
while($row = $query->fetch_assoc()){

echo "
<tr>

    <td>".$row['name']."</td>

    <td>".$row['qty']."</td>

    <td>".$row['source']."</td>

    <td>".$row['location']."</td>

    <td>".$row['date_received']."</td>

    <td>

        <!-- ADD QTY -->
        <button class='riraf-edit-btn'
        onclick='addQty(".$row['id'].")'>

            <i class='fa-solid fa-plus'></i>

        </button>

        <!-- EDIT -->
        <button class='riraf-edit-btn'

        onclick=\"editMerch(
            ".$row['id'].",
            '".htmlspecialchars($row['name'],ENT_QUOTES)."',
            '".$row['qty']."',
            '".htmlspecialchars($row['source'],ENT_QUOTES)."',
            '".htmlspecialchars($row['location'],ENT_QUOTES)."',
            '".$row['date_received']."'
        )\">

            <i class='fa-solid fa-pen'></i>
            Edit

        </button>

        <!-- DELETE -->
        <button class='print-btn'
        onclick='deleteMerch(".$row['id'].")'>

            <i class='fa-solid fa-trash'></i>
            Delete

        </button>

    </td>

</tr>
";
}
?>

            </tbody>

        </table>

        <!-- PAGINATION -->
        <div class="pagination">

            <button class="blue-btn"

            <?php
            if($currentPage <= 1) echo 'disabled';
            ?>

            onclick="window.location='?page=<?php echo $currentPage-1 ?>'">

                <i class="fa-solid fa-arrow-left"></i>
                Previous

            </button>

            <button class="blue-btn"

            <?php
            if($currentPage >= $totalPages) echo 'disabled';
            ?>

            onclick="window.location='?page=<?php echo $currentPage+1 ?>'">

                Next
                <i class="fa-solid fa-arrow-right"></i>

            </button>

        </div>

    </div>

</main>


<!-- ================= MODAL ================= -->

<div id="merchModal" class="toa-modal" onclick="outsideClose(event)">

    <div class="toa-modal-content merch-float-box">

        <h3 id="modalTitle">Add Merchandise</h3>

        <input type="hidden" id="editId">

        <label>Merchandise</label>
        <input type="text" id="merchName">

        <label>Quantity</label>
        <input type="number" id="merchQty">

        <label>Source</label>
        <select id="merchSource">

            <option value="Supplier">Supplier</option>
            <option value="Transfer">Transfer</option>
            <option value="Return">Return</option>

        </select>

        <label>Location</label>
        <input type="text" id="merchLocation">

        <label>Date Received</label>
        <input type="date" id="merchDate">

        <div class="modal-actions">

            <button onclick="submitMerch()">
                SAVE
            </button>

            <button onclick="closeMerchModal()">
                CANCEL
            </button>

        </div>

    </div>

</div>

<div id="merchMessage" class="merch-message">
    <span id="merchMessageText"></span>
</div>

<script>

/* ================= SEARCH ================= */

document.getElementById("searchMerch")
.addEventListener("keyup", function(){

    let input = this.value.toLowerCase();

    let rows = document.querySelectorAll("#merchTable tbody tr");

    rows.forEach(row => {

        let text = row.innerText.toLowerCase();

        row.style.display =
            text.includes(input)
            ? ""
            : "none";

    });

});

/* ================= OPEN ADD ================= */

function openMerchModal(){

    document.getElementById("modalTitle").innerText =
        "Add Merchandise";

    document.getElementById("editId").value = "";

    document.getElementById("merchName").value = "";
    document.getElementById("merchQty").value = "";
    document.getElementById("merchLocation").value = "";
    document.getElementById("merchDate").value = "";

    document.getElementById("merchModal").style.display =
        "flex";
}

/* ================= CLOSE ================= */

function closeMerchModal(){

    document.getElementById("merchModal").style.display =
        "none";
}

/* ================= ADD / UPDATE ================= */

function submitMerch(){

    let id = document.getElementById("editId").value;

    let name = document.getElementById("merchName").value.trim();

    let qty = document.getElementById("merchQty").value.trim();

    let source = document.getElementById("merchSource").value;

    let location =
        document.getElementById("merchLocation").value.trim();

    let date =
        document.getElementById("merchDate").value;

    if(!name || !qty || !location || !date){

        alert("Fill all fields");
        return;
    }

    let url =
        id
        ? "db/edit_merchandise.php"
        : "db/add_merchandise.php";

    let body =
        (id ? "id="+encodeURIComponent(id)+"&" : "") +

        "name="+encodeURIComponent(name)+
        "&qty="+encodeURIComponent(qty)+
        "&source="+encodeURIComponent(source)+
        "&location="+encodeURIComponent(location)+
        "&date="+encodeURIComponent(date);

    fetch(url,{
        method:"POST",
        headers:{
            "Content-Type":
            "application/x-www-form-urlencoded"
        },
        body:body
    })
    .then(res=>res.text())
    .then(res=>{

        if(res.trim()=="success"){

            closeMerchModal();

            showMessage(id ? "Updated successfully!" : "Saved successfully!");

            setTimeout(() => {
                location.reload();
            }, 1200);

        }else{

            showMessage("Error: " + res);

        }

    });

}

/* ================= EDIT ================= */

function editMerch(
    id,
    name,
    qty,
    source,
    location,
    date
){

    document.getElementById("modalTitle").innerText =
        "Edit Merchandise";

    document.getElementById("editId").value = id;

    document.getElementById("merchName").value = name;

    document.getElementById("merchQty").value = qty;

    document.getElementById("merchSource").value = source;

    document.getElementById("merchLocation").value =
        location;

    document.getElementById("merchDate").value = date;

    document.getElementById("merchModal").style.display =
        "flex";
}

/* ================= DELETE ================= */

function deleteMerch(id){

    if(!confirm("Delete this record?")) return;

    fetch("db/delete_merchandise.php",{
        method:"POST",
        headers:{
            "Content-Type":
            "application/x-www-form-urlencoded"
        },
        body:"id="+encodeURIComponent(id)
    })
    .then(res=>res.text())
    .then(res=>{

        location.reload();

    });

}

/* ================= ADD QTY ================= */

function addQty(id){

    let qty = prompt("Enter quantity to add:");

    if(qty===null || qty.trim()==="") return;

    fetch("db/add_qty.php",{
        method:"POST",
        headers:{
            "Content-Type":
            "application/x-www-form-urlencoded"
        },
        body:
        "id="+encodeURIComponent(id)+
        "&qty="+encodeURIComponent(qty)
    })
    .then(res=>res.text())
    .then(res=>{

        if(res.trim()=="success"){

            location.reload();

        }else{

            alert(res);

        }

    });

}

/* ================= CLICK OUTSIDE CLOSE ================= */

function outsideClose(event){

    const modal = document.getElementById("merchModal");

    if(event.target === modal){

        closeMerchModal();

    }

}

function showMessage(text){

    const msg = document.getElementById("merchMessage");
    const msgText = document.getElementById("merchMessageText");

    msgText.innerText = text;

    msg.classList.add("show");

    setTimeout(() => {
        msg.classList.remove("show");
    }, 2000);

}

</script>