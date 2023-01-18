<?php

require_once $_SERVER["DOCUMENT_ROOT"] . '/controller/Department.php';

header("Content-Type:application/json");


$departmentObject = new Department();

$departmentData = $departmentObject->fetchDepartments('department_id,department_name');

if (empty($departmentData)) {
    echo json_encode(["result" => "No data available", "data" => $departmentData]);
} else {
    echo json_encode(["result" => "Data available", "data" => $departmentData]);
}
