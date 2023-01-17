<?php

require_once 'CRUD.php';

//FOR STUDENT DATA WITH ALL FOREIGN KEY DATA
function fetchStudentData($studentId)
{
    $crudObject = new CRUD();

    $studentData = array();

    $studentData = $crudObject->fetchDataSql("SELECT * FROM students JOIN departments ON students.department = departments.department_id JOIN colleges ON students.college = colleges.college_id JOIN universities ON students.university = universities.university_id WHERE student_id=$studentId");

    return $studentData;
}

//FOR DEPARTMENT DATA WITH ORDER BY NAME
function fetchDepartmentData()
{
    $crudObject = new CRUD();

    $departmentData = array();

    $departmentData =  $crudObject->fetchDataSql('SELECT * FROM departments ORDER BY department_name');

    return $departmentData;
}

//FOR COLLEGE DATA WITH ORDER BY NAME
function fetchCollegeData()
{
    $crudObject = new CRUD();

    $collegeData = array();

    $collegeData = $crudObject->fetchDataSql('SELECT * FROM colleges ORDER BY college_name');

    return $collegeData;
}

//FOR COLLEGE DATA WITH ORDER BY NAME
function fetchUniversityData()
{
    $crudObject = new CRUD();

    $universityData = array();

    $universityData = $crudObject->fetchDataSql('SELECT * FROM universities ORDER BY university_name');

    return $universityData;
}
