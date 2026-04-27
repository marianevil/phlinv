<?php
include 'connection.php';

$type = $_GET['type'] ?? '';
$type = $conn->real_escape_string($type);

$query = $conn->query("SELECT * FROM account_type_inputs WHERE account_type='$type' ORDER BY row_group ASC, id ASC");
if(!$query) die("Query Error: " . $conn->error);

$html = '';

// 👉 GROUP BY ROW
$rows = [];

while($row = $query->fetch_assoc()){
    $rows[$row['row_group']][] = $row;
}

// 👉 DISPLAY BY ROW
foreach($rows as $group){
    $html .= '<div class="form-row">';

    foreach($group as $field){
        $label = htmlspecialchars($field['label']);
        $name = htmlspecialchars($field['input_name']);
        $type = htmlspecialchars($field['input_type']);
        $span = (int)$field['column_span'];

        $html .= "<div class='input-group col-$span'>";
        $html .= "<label>$label:</label>";
        $html .= "<input type='$type' name='$name'>";
        $html .= "</div>";
    }

    $html .= '</div>';
}

echo $html;
?>