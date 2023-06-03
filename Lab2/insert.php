<?php
require("./connect_db.php");

$mock_data = [
    ["name" => "Akshat Arora", "password" => "123456", "email" => "AArora9396@conestogac.on.ca"],
    ["name" => "Asad Ullah Ashraf ", "password" => "1234567", "email" => "Aashraf4578@conestogac.on.ca"],
    ["name" => "Eugenio Contreras", "password" => "12345678", "email" => "Econtreraslizan1632@conestogac.on.ca"],
    ["name" => "Siyu Liu", "password" => "123456789", "email" => "Sliu9412@conestogac.on.ca"],
];

function InsertData($data, $table_name, $db)
{
    try {
        // Generate sql query
        $sql = "INSERT INTO $table_name (name, password, email) VALUES ";
        for ($i = 0; $i < count($data); $i++) {
            $sql = $sql . "(:name$i, :password$i, :email$i)";
            if ($i < count($data) - 1) {
                $sql = $sql . ",";
            }
        }
        // replace values of the sql query
        $query = $db->prepare($sql);
        for ($i = 0; $i < count($data); $i++) {
            $query->bindValue(":name$i", $data[$i]["name"]);
            $query->bindValue(":password$i", password_hash($data[$i]["password"], PASSWORD_DEFAULT));
            $query->bindValue(":email$i", $data[$i]["email"]);
        }
        $query->execute();
        return true;
    } catch (Exception $e) {
        echo $e;
    }
}

if (InsertData($mock_data, "Users", $db)) {
    echo "Insert data successfully";
}
