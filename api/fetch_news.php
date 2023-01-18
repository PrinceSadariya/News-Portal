<?php

require_once $_SERVER["DOCUMENT_ROOT"] . '/controller/CRUD.php';

header("Content-Type:application/json");

if ($_POST["token"] === "prince_sadariya") {

    $crudObject = new CRUD();

    if (isset($_POST["news_id"])) {
        $newsId = $_POST["news_id"];
        $newsData = $crudObject->fetchDataSql("SELECT news_id,news_title,news_detail,news_image,created_date FROM news WHERE news_id=$newsId");
    } else {
        $newsData = $crudObject->fetchDataSql("SELECT news_id,news_title,news_detail,news_image,created_date FROM news ORDER BY sort_order ASC");
    }

    if (!empty($newsData)) {
        echo json_encode(["result" => "Data available", "data" => $newsData]);
    } else {
        echo json_encode(["result" => "No data avilable", "data" => $newsData]);
    }
} else {
    echo json_encode(["result" => "invalid token", "data" => null]);
}
