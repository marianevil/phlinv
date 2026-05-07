<?php include 'header.php'; ?>

<main class="dashboard-bg">

<div class="deno-title">DENO</div>

<div class="card-desc">
    <p>
        This module is used for managing denomination (Deno) entries and records. It allows users to input transaction details such as post office, invoice number, weight, date, denomination type, and quantity. The right side displays a summary record of all saved deno transactions for monitoring and reference purposes.
    </p>
</div>

<div class="deno-container">

    <!-- LEFT SIDE -->
    <div class="deno-left">

        <h2>ENTRY FORM</h2>

        <div class="deno-form">

            <!-- POST OFFICE -->
            <div class="deno-line">
                <label>Post Office Name:</label>
                <select>
                    <option>Select Post Office</option>
                </select>
            </div>

            <!-- INV + WT -->
            <div class="deno-row">

                <div class="deno-line">
                    <label>INV No.:</label>
                    <input type="text">
                </div>

                <div class="deno-line">
                    <label>Wt:</label>
                    <input type="text">
                </div>

            </div>

            <!-- DATE -->
            <div class="deno-line">
                <label>Date:</label>
                <input type="date">
            </div>

            <!-- DENO + QUANTITY -->
            <div class="deno-row">

                <div class="deno-line">
                    <label>Deno:</label>
                    <select>
                        <option>Select Deno</option>
                    </select>
                </div>

                <div class="deno-line">
                    <label>Quantity:</label>
                    <input type="text">
                </div>

            </div>

            <button class="submit-btn">SUBMIT</button>

        </div>

    </div>


    <!-- RIGHT SIDE -->
    <div class="deno-right">

        <div class="deno-record-header">

            <h2>DENO RECORD</h2>

            <div class="search-date">
                <label>Search Date</label>
                <input type="date">
            </div>

        </div>

        <table class="deno-table">

            <thead>
                <tr>
                    <th>Deno</th>
                    <th>Quantity</th>
                    <th>Date</th>
                </tr>
            </thead>

            <tbody>

            <?php for($i=0;$i<10;$i++){ ?>

                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>

            <?php } ?>

            </tbody>

        </table>

    </div>

</div>

</main>

</body>
</html>