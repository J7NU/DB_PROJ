<?php

include "db.php";

session_start();

$transfer_acc = $_POST["transfer_acc"];
$BB_CODE = $_POST["BB_CODE"];
$transfer_amount = $_POST["transfer_amount"];
$usertypedpw_intransfer = $_POST['usertypedpw_intransfer'];

$acc = $_SESSION['acc'];
$pw = $_SESSION['pw'];

if ($usertypedpw_intransfer != $pw) {
    $arr = ['result' => 'fail', 'message' => 'Wrong PW'];
    die(json_encode($arr));
}

if ($BB_CODE != 0 && isset($BB_CODE)) {
    $sql_trans_update3 = "Call InsertTransaction(:acc, :transfer_acc, :BB_CODE, :transfer_amount, 3)";
    $stmt_trans_update3 = $conn->prepare($sql_trans_update3);
    $stmt_trans_update3->bindParam(':acc', $acc);
    $stmt_trans_update3->bindParam(':transfer_acc', $transfer_acc);
    $stmt_trans_update3->bindParam(':BB_CODE', $BB_CODE);
    $stmt_trans_update3->bindParam(':transfer_amount', $transfer_amount);
    $stmt_trans_update3->execute();
    $stmt_trans_update3->closeCursor();

    $sql_trans_otherbank = "Call Transfer(:transfer_amount,:acc)";
    $stmt_trans_otherbank = $conn->prepare($sql_trans_otherbank);
    $stmt_trans_otherbank->bindParam(":transfer_amount", $transfer_amount);
    $stmt_trans_otherbank->bindParam(":acc", $acc);

    if ($stmt_trans_otherbank->execute()) {
        $arr = ['result' => 'success'];
        die(json_encode($arr));
    } else {
        $arr = ['result' => 'fail', 'message' => 'Fail to Transfer.'];
        die(json_encode($arr));
    }
}

if ($BB_CODE == 0 && isset($BB_CODE)) {
    $sql_trans_update4 = "CALL TRANSFER_INBANK(:transfer_amount, :acc, :transfer_acc)";
    $stmt_trans_update4 = $conn->prepare($sql_trans_update4);
    $stmt_trans_update4->bindParam(':transfer_amount', $transfer_amount);
    $stmt_trans_update4->bindParam(':acc', $acc);
    $stmt_trans_update4->bindParam(':transfer_acc', $transfer_acc);
    $stmt_trans_update4->execute();
    $stmt_trans_update4->closeCursor();

    $sql_trans_update5 = "CALL InsertTransaction(:acc, :transfer_acc, 0, :transfer_amount, 3)";
    $stmt_trans_update5 = $conn->prepare($sql_trans_update5);
    $stmt_trans_update5->bindParam(':acc', $acc);
    $stmt_trans_update5->bindParam(':transfer_acc', $transfer_acc);
    $stmt_trans_update5->bindParam(':transfer_amount', $transfer_amount);

    if ($stmt_trans_update5->execute()) {
        $arr = ['result' => 'success'];
        die(json_encode($arr));
    } else {
        $arr = ['result' => 'fail', 'message' => 'Fail to Transfer.'];
        die(json_encode($arr));
    }
}
