<?php
function ConnectDB($host = "127.0.0.1", $dbname, $is_privacy = false, $port = 3306, $username = "", $password = "")
{
    try {
        if ($is_privacy) {
            return new PDO("mysql: host=$host; dbname=$dbname; port=$port", $username, $password);
        }
        return new PDO("mysql: host=$host; dbname=$dbname; port=$port");
    } catch (PDOException $e) {
        echo $e;
        die("Could not connect to database");
    }
}

$db = ConnectDB("localhost", "ecommerce", true, 3306, "root", "");
