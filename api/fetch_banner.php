<?php

require_once $_SERVER["DOCUMENT_ROOT"] . '/controller/CRUD.php';

header("Content-Type:application/json");

if ($_POST["token"] === "prince_sadariya") {

    $crudObject = new CRUD();

    $bannerData = $crudObject->fetchDataSql("SELECT * FROM banners WHERE banner_status = 1");

    echo json_encode(["result" => "data found", "data" => $bannerData]);
} else {
    echo json_encode(["result" => "invalid token", "data" => $bannerData]);
}
