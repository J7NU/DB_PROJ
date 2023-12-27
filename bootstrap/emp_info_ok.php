<?php

include "db.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $emp_search_name = $_POST['emp_search_name'];
    $emp_search_phone = $_POST['emp_search_phone'];

    $sql3 = "CALL SEARCH_EMPLOYEE(:emp_search_name, :emp_search_phone)";

    $stmt3 = $conn->prepare($sql3);
    $stmt3->bindParam(':emp_search_name', $emp_search_name);
    $stmt3->bindParam(':emp_search_phone', $emp_search_phone);
    $stmt3->execute();

    $result3 = $stmt3->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($result3);
}
