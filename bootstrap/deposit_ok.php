<?php

include "db.php";

session_start();

$deposit_amount = $_POST['deposit_amount'];
$acc = $_SESSION['acc'];
$pw = $_SESSION['pw'];

#입력받은 비번
$usertypedpw = $_POST['usertypedpw'];

if ($usertypedpw != $pw) {
    $arr = ['result' => 'fail', 'message' => 'Wrong PW'];
    die(json_encode($arr));
}


$sql_deposit123 =  "CALL DEPOSIT(:acc, :deposit_amount)";

$stmt_deposit123 = $conn->prepare($sql_deposit123);
$stmt_deposit123->bindParam(':acc', $acc);
$stmt_deposit123->bindParam(':deposit_amount', $deposit_amount);
$stmt_deposit123->execute();
$stmt_deposit123->closeCursor();

$sql_trans_update = "Call InsertTransaction(:acc, :acc,0,:deposit_amount,1)";
$stmt_trans_update = $conn->prepare($sql_trans_update);
$stmt_trans_update->bindParam(':acc', $acc);
$stmt_trans_update->bindParam(':deposit_amount', $deposit_amount);

if ($stmt_trans_update->execute()) {
    $arr = ['result' => 'success'];
    die(json_encode($arr));
} else {
    $arr = ['result' => 'fail', 'message' => 'Fail to deposit.'];
    die(json_encode($arr));
}
