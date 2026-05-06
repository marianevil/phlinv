<?php
include 'connection.php';

// check if form submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST['id'] ?? '';

    $province = $_POST['province'] ?? '';
    $post_office = $_POST['post_office'] ?? '';
    $date = $_POST['date'] ?? '';
    $inv_no = $_POST['inv_no'] ?? '';
    $weight = $_POST['weight'] ?? '';
    $type_accounts = $_POST['type_accounts'] ?? '';
    $deno = $_POST['deno'] ?? '';
    $quantity = $_POST['quantity'] ?? '';
    $weighted = $_POST['weighted'] ?? '';
    $kind_stamp = $_POST['kind_stamp'] ?? '';
    $sheet = $_POST['sheet'] ?? '';
    $unit_cost = $_POST['unit_cost'] ?? '';
    $pieces = $_POST['pieces'] ?? '';
    $stamp_from = $_POST['stamp_from'] ?? '';
    $stamp_to = $_POST['stamp_to'] ?? '';
    $stamp_total = $_POST['stamp_total'] ?? '';
    $stamp_total_weighted = $_POST['stamp_total_weighted'] ?? '';
    $stamp_amount = $_POST['stamp_amount'] ?? '';
    $stamp_total_words = $_POST['stamp_total_words'] ?? '';

    $sql = "UPDATE riraf_records SET
        province='$province',
        post_office='$post_office',
        date='$date',
        inv_no='$inv_no',
        weight='$weight',
        type_accounts='$type_accounts',
        deno='$deno',
        quantity='$quantity',
        weighted='$weighted',
        kind_stamp='$kind_stamp',
        sheet='$sheet',
        unit_cost='$unit_cost',
        pieces='$pieces',
        stamp_from='$stamp_from',
        stamp_to='$stamp_to',
        stamp_total='$stamp_total',
        stamp_total_weighted='$stamp_total_weighted',
        stamp_amount='$stamp_amount',
        stamp_total_words='$stamp_total_words'
        WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {

        header("Location: ../riraf.php?update=success");
        exit();

    } else {

        echo "Error updating record: " . $conn->error;

    }

} else {

    echo "Invalid request.";

}
?>