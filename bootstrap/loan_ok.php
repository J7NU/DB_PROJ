<?php

include "db.php";

session_start();

$loan_type_1 = isset($_POST['loan_type_1']) ? $_POST['loan_type_1'] : '';
$loan_type_2 = isset($_POST['loan_type_2']) ? $_POST['loan_type_2'] : '';
$property_value = isset($_POST['property_value']) ? $_POST['property_value'] : 0;
$loan_amount = isset($_POST['loan_amount']) ? $_POST['loan_amount'] : 0;

$acc = $_SESSION['acc'];
$pw = $_SESSION['pw'];

if (isset($loan_type_1) && $loan_amount != 0 && $loan_type_1 == 'yes') {
    $sql_type1 =  "SELECT RANK_POINT FROM CUSTOMER JOIN ACCOUNT ON CUSTOMER.CUS_CODE = ACCOUNT.CUS_CODE JOIN CUS_RANK ON CUSTOMER.CUS_RANK_CODE = CUS_RANK.CUS_RANK_CODE
WHERE ACC_NUM = :acc";
    $stmt_type1 = $conn->prepare($sql_type1);
    $stmt_type1->bindParam(':acc', $acc);
    $stmt_type1->execute();
    $result_type1 = $stmt_type1->fetch(PDO::FETCH_ASSOC);;
    $interest1 = ((2 / 9) * (100 - $result_type1['RANK_POINT'])) / 100;
    $_SESSION['interest1'] = $interest1;
    $month_return1 = ($loan_amount * $interest1) / 12;
    $_SESSION['month_return1'] = $month_return1;
    $_SESSION['loan_type_1'] = $loan_type_1;
    $_SESSION['loan_amount'] = $loan_amount;
}

if (isset($loan_type_2) && $loan_amount != 0 && $property_value != 0 && $loan_type_2 == 'yes') {
    $sql = "SELECT CHECK_SECURITY(:property_value, :acc) AS `security_score`";
    $stmt_type2 = $conn->prepare($sql);
    $stmt_type2->bindParam(':acc', $acc);
    $stmt_type2->bindParam(':property_value', $property_value);
    $stmt_type2->execute();
    $result_type2 = $stmt_type2->fetch(PDO::FETCH_ASSOC);
    $interest2 = ((2 / 9) * (100 - $result_type2['security_score'])) / 100;
    $_SESSION['interest2'] = $interest2;
    $month_return2 = ($loan_amount * $interest2) / 12;
    $_SESSION['month_return2'] = $month_return2;
    $_SESSION['loan_type_2'] = $loan_type_2;
    $_SESSION['loan_amount'] = $loan_amount;
}



header("Location: ./loan_howmuch.php");


exit;
