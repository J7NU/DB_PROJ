<?php

include "db.php";
session_start();

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     $cus_search_name = $_POST['cus_search_name'];
//     $cus_search_phone = $_POST['cus_search_phone'];

//     $sql = "CALL SEARCH_CUSTOMER(:cus_search_name, :cus_search_phone)";

//     $stmt = $conn->prepare($sql);
//     $stmt->bindParam(':cus_search_name', $cus_search_name);
//     $stmt->bindParam(':cus_search_phone', $cus_search_phone);
//     $stmt->execute();

//     $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
//     echo json_encode($result);
// }
