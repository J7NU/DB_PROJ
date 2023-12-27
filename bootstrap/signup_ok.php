<?php

include "db.php";

session_start();

$cus_name = $_POST['cus_name'];
$cus_phone = $_POST['cus_phone'];
$address = $_POST['address'];
$bank_branch = $_POST['bank_branch'];
$job = $_POST['job'];
$bank_branch = $_POST['bank_branch'];


// $newacc_num = $_POST['acc_num'];

$sql_signup =  "CALL SIGN_UP(:cus_name, 
:cus_phone, :job, :address, :bank_branch)";
$stmt_signup = $conn->prepare($sql_signup);
$stmt_signup->bindParam(':cus_name', $cus_name);
$stmt_signup->bindParam(':cus_phone', $cus_phone);
$stmt_signup->bindParam(':job', $job);
$stmt_signup->bindParam(':address', $address);
$stmt_signup->bindParam(':bank_branch', $bank_branch);

$stmt_signup->execute();
