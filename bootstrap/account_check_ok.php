<?php

include "db.php";

session_start();

$acc = $_SESSION['acc'];
$pw = $_SESSION['pw'];

$sql = "SELECT cus_name, acc_num, acc_balance
FROM ACCOUNT JOIN CUSTOMER ON ACCOUNT.CUS_CODE = CUSTOMER.`CUS_CODE`
WHERE acc_num = :acc AND ACC_PW = :pw";

$stmt = $conn->prepare($sql);
$stmt->bindParam(':acc', $acc);
$stmt->bindParam(':pw', $pw);
$stmt->execute();

$result = $stmt->fetch(PDO::FETCH_ASSOC);

echo json_encode($result);
