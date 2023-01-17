<?php

require_once 'CRUD.php';

/**
 * fetch the data from the students table
 * 
 * @param number $studentId studentId of student which you want to fetch data
 * 
 * @return array array of studentData based on condition 
 */
function fetchStudentData($studentId)
{
    $crudObject = new CRUD();

    $studentData = array();

    $studentData = $crudObject->fetchDataSql("SELECT * FROM students JOIN departments ON students.department = departments.department_id JOIN colleges ON students.college = colleges.college_id JOIN universities ON students.university = universities.university_id WHERE student_id=$studentId");

    return $studentData;
}

/**
 * fetch department data with order by department_name
 * 
 * @return array array of all department with order by department_name
 */
function fetchDepartmentData()
{
    $crudObject = new CRUD();

    $departmentData = array();

    $departmentData =  $crudObject->fetchDataSql('SELECT * FROM departments ORDER BY department_name');

    return $departmentData;
}

/**
 * fetch college data with order by college_name
 * 
 * @return array array of all college with order by college_name
 */
function fetchCollegeData()
{
    $crudObject = new CRUD();

    $collegeData = array();

    $collegeData = $crudObject->fetchDataSql('SELECT * FROM colleges ORDER BY college_name');

    return $collegeData;
}


/**
 * fetch universities data with order by university_name
 * 
 * @return array array of all university with order by university_name
 */
function fetchUniversityData()
{
    $crudObject = new CRUD();

    $universityData = array();

    $universityData = $crudObject->fetchDataSql('SELECT * FROM universities ORDER BY university_name');

    return $universityData;
}
