<?php
include "db.php";
session_start();
$sql = "select avg(bb_balance) 
from customer c join bank_branch b on c.bb_code = b.bb_code";
$stmt_info_2 = $conn->prepare($sql);
$stmt_info_2->execute();

$result_2 = $stmt_info_2->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($result_2);
