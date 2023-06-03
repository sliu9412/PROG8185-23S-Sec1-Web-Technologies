<?php
require("./connect_db.php");
header("Content-Type: application/json");

function RetrieveData($db, $table_name)
{
    $data_array = [];
    $query = $db->prepare("SELECT * FROM $table_name");
    $query->execute();
    while ($row = $query->fetch()) {
        $row_data = [
            "name" => $row['name'],
            "email" => $row['email'],
            "password_hash" => $row['password'],
        ];
        array_push($data_array, $row_data);
    }
    return json_encode($data_array);
}

print_r(RetrieveData($db, "Users"));
