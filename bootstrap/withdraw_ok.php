<?php

include "db.php";

session_start();

$withdraw_amount = $_POST['withdraw_amount'];
$acc = $_SESSION['acc'];
$pw = $_SESSION['pw'];
$error_code_lb = 'fail_low_balance';
$error_code_wp = 'fail_wrong_pw';

$sql = "CALL WITHDRAW(:acc, :withdraw_amount)";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':acc', $acc);
$stmt->bindParam(':withdraw_amount', $withdraw_amount);
$stmt->execute();

$row = $stmt->fetch(PDO::FETCH_ASSOC);

# 잔고가 출금액보다 적은경우
if ($row !== false) {
    $arr = ['result' => $error_code_lb, 'message' => 'Low balance.'];
    die(json_encode($arr));
}
# 입력받은 비번
$usertypedpw_wd = $_POST['usertypedpw_wd'];

#비밀번호가 틀린경우
if ($usertypedpw_wd != $pw) {
    $arr = ['result' => $error_code_wp, 'message' => 'Wrong PW'];
    die(json_encode($arr));
}
# 정상 출금
$arr = ['result' => 'success', 'message' => 'Enough balance.'];

$sql_trans_update2 = "Call InsertTransaction(:acc, :acc,0,:withdraw_amount,2)";
$stmt_trans_update2 = $conn->prepare($sql_trans_update2);
$stmt_trans_update2->bindParam(':acc', $acc);
$stmt_trans_update2->bindParam(':withdraw_amount', $withdraw_amount);

if ($stmt_trans_update2->execute()) {
    $arr = ['result' => 'success'];
    die(json_encode($arr));
} else {
    $arr = ['result' => 'fail', 'message' => 'Fail to deposit.'];
    die(json_encode($arr));
}
