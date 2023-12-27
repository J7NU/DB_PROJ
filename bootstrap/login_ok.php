<?php

include "db.php";

// print_r($_POST);

$acc = $_POST['acc'];
$pw = $_POST['pw'];

$sql =  "Select * from account where acc_num=:acc and acc_pw=:pw";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':acc', $acc);
$stmt->bindParam(':pw', $pw);
$stmt->execute();
$row = $stmt->fetch();

if ($row) {
    session_start();
    $_SESSION['acc'] = $acc;
    $_SESSION['pw'] = $pw;
    $arr = ['result' => 'success'];
    die(json_encode($arr));
} else {
    $arr = ['result' => 'fail'];
    die(json_encode($arr));
}
