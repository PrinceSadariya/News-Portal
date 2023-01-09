<?php

require_once $_SERVER["DOCUMENT_ROOT"] . '/controller/CRUD.php';

header("Content-Type:application/json");

if ($_POST["token"] === "prince_sadariya") {

    $crudObject = new CRUD();

    $newsData = $crudObject->fetchDataSql("SELECT * FROM news ORDER BY sort_order ASC");

    echo json_encode(["result" => "data found", "data" => $newsData]);
} else {
    echo json_encode(["result" => "invalid token", "data" => null]);
}
