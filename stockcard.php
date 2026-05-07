<?php include 'header.php'; ?>

<main class="dashboard-bg">

<div class="stock-header">
    <h2>STOCK CARD</h2>

    <div class="search-field">
        <label for="searchProvince">Search Province:</label>
        <input type="text" id="searchProvince" placeholder="Enter province">
    </div>

    <div class="search-date-top">
        <label for="searchDate">Search Date:</label>
        <input type="date" id="searchDate">
    </div>
</div>

<!-- DELETE THIS DESCRIPTION LATER, FOR NOW JUST FOR REFERENCE -->   
<div class="card-desc">
    <p>
        This Stock Card module displays summarized records from the RIRAF system. Unlike the RIRAF Entry Form, which captures detailed transactions (such as postage stamps, money orders, receipts, and other postal forms), this section provides a consolidated view per Type of Accounts. It helps users monitor and track summarized inventory and movement of records per province and post office.
    </p>
</div>

<div class="stock-container">

    <!-- LEFT -->
    <div class="stock-left">
        <h3>LOCATIONS</h3>
        <div id="locationPanel"></div>
    </div>

    <!-- CENTER -->
    <div class="stock-center">
        <h3>STOCK CARD RECORD DISPLAY</h3>
        <div id="stockList"></div>
    </div>

    <!-- RIGHT -->
    <div class="stock-right">
        <h3>DATE</h3>
        <div id="dateList"></div>
    </div>

</div>
</main>

<script>

let selectedProvince = "";
let selectedLocation = "";



/* ================= SAFE FETCH (IMPORTANT) ================= */
async function fetchJSON(url) {
    const res = await fetch(url);
    const text = await res.text();

    try {
        return JSON.parse(text);
    } catch (err) {
        console.error("❌ INVALID JSON FROM:", url);
        console.error("RESPONSE WAS:\n", text);
        throw err;
    }
}

/* ================= PROVINCE SEARCH ================= */
document.getElementById("searchProvince").addEventListener("input", async function () {

    selectedProvince = this.value;

    // ✅ CLEAR previous display
    document.getElementById("stockList").innerHTML = "";
    document.getElementById("dateList").innerHTML = "";

    try {
        const data = await fetchJSON("db/search_province.php?province=" + encodeURIComponent(selectedProvince));

        const panel = document.getElementById("locationPanel");
        panel.innerHTML = "";

        data.forEach(item => {

            const container = document.createElement("div");
            container.className = "dropdown-container";

            const btn = document.createElement("button");
            btn.className = "stock-btn others toggle-btn";
            btn.innerHTML = `
                ${item.post_office}
                <img src="images/arrow.png" class="arrow-icon">
            `;

            const dropdown = document.createElement("div");
            dropdown.className = "dropdown-items";

            btn.onclick = () => {

                selectedLocation = item.post_office;
                console.log("LOCATION:", selectedLocation);

                const isOpen = dropdown.classList.contains("show");

                document.querySelectorAll(".dropdown-items").forEach(d => d.classList.remove("show"));
                document.querySelectorAll(".toggle-btn").forEach(b => b.classList.remove("active"));

                if (!isOpen) {
                    dropdown.classList.add("show");
                    btn.classList.add("active");
                    loadTypes(dropdown, selectedLocation);
                }
            };

            container.appendChild(btn);
            container.appendChild(dropdown);
            panel.appendChild(container);
        });

    } catch (e) {
        console.error("Failed loading provinces");
    }
});

/* ================= LOAD TYPES ================= */
async function loadTypes(dropdown, location) {

    try {
        const data = await fetchJSON(`db/get_types.php?province=${selectedProvince}&location=${location}`);

        dropdown.innerHTML = "";

        const title = document.createElement("div");
        title.className = "dropdown-title";
        title.innerHTML = "TYPE OF ACCOUNTS";
        dropdown.appendChild(title);

        data.forEach(item => {

            const btn = document.createElement("button");
            btn.className = "stock-btn sub";
            btn.innerHTML = item.type_accounts;

            btn.onclick = () => {
                console.log("TYPE CLICK:", item.type_accounts);
                loadStockCard(item.type_accounts, location);
            };

            dropdown.appendChild(btn);
        });

    } catch (e) {
        console.error("Failed loading types");
    }
}

/* ================= LOAD STOCK CARD ================= */
async function loadStockCard(type, location) {

    console.log("LOAD:", type, location);

    try {
        const data = await fetchJSON(
            `db/load_stockcard.php?province=${selectedProvince}&location=${location}&type=${type}`
        );

        const stockList = document.getElementById("stockList");
        const dateList = document.getElementById("dateList");

        if (!data || data.length === 0) {
            return;
        }

        // 👉 create unique ID per location
        let cleanLocation = location.replace(/\s+/g, '');
        let stockGroupId = "group-" + cleanLocation;
        let dateGroupId = "group-date-" + cleanLocation;

        let stockGroup = document.getElementById(stockGroupId);
        let dateGroup = document.getElementById(dateGroupId);

        // 👉 IF wala pa (new location) → CREATE
        if (!stockGroup) {

            stockGroup = document.createElement("div");
            stockGroup.id = stockGroupId;
            stockGroup.className = "location-group";

            stockList.appendChild(stockGroup);

            dateGroup = document.createElement("div");
            dateGroup.id = dateGroupId;
            dateGroup.className = "location-group";

            dateList.appendChild(dateGroup);

        } else {
            // 👉 EXISTING location → REPLACE only this location
            stockGroup.innerHTML = "";
            dateGroup.innerHTML = "";
        }

        // 👉 local duplicate control per location
        let localKeys = new Set();

        data.forEach(item => {

            let key = item.type_accounts + item.inv_no;

            if (localKeys.has(key)) return;
            localKeys.add(key);

            stockGroup.innerHTML += `
                <div class="record-row">
                    <div class="box">
                        ${item.type_accounts} - ${item.post_office} PO - ${item.inv_no || 'SC00'}
                    </div>
                </div>
            `;

            dateGroup.innerHTML += `
                <div class="date-box">
                    <div class="box">
                        ${item.latest_date}
                    </div>
                </div>
            `;
        });

    } catch (e) {
        console.error("Failed loading stock card");
    }
}

</script>

</body>
</html>