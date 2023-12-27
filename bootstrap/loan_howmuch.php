<?php
include 'db.php';
session_start();
if (!isset($_SESSION['acc']) or $_SESSION['pw'] == '') {
    echo "이 페이지에 접근할 수 없습니다.";
    header("Location: ./index.html");
    exit;
}
$interest1 = isset($_SESSION['interest1']) ? $_SESSION['interest1'] : 0;
$interest2 = isset($_SESSION['interest2']) ? $_SESSION['interest2'] : 0;
$loan_type_1 = isset($_SESSION['loan_type_1']) ? $_SESSION['loan_type_1'] : '';
$loan_type_2 = isset($_SESSION['loan_type_2']) ? $_SESSION['loan_type_2'] : '';
$string = "";
$loan_amount = $_SESSION['loan_amount'];
$acc = $_SESSION['acc'];

if ($interest1 != 0 && $loan_type_1 != '') {
    $month_return1 = $_SESSION['month_return1'];
    $interest1Formatted = number_format($interest1 * 100, 0);
    $month_return1Formatted = number_format($month_return1, 0);
    $string .= "당신의 이자율은 {$interest1Formatted}%이고, 월 상환액은 {$month_return1Formatted}원 입니다.";
    $sql_loanupdate1 = "Call INSERT_LOAN_HISTORY(1,:acc,:loan_amount,:interest)";
    $stmt_loanupdate1 = $conn->prepare($sql_loanupdate1);
    $stmt_loanupdate1->bindParam(':acc', $acc);
    $stmt_loanupdate1->bindParam(':loan_amount', $loan_amount);
    $stmt_loanupdate1->bindParam(':interest', $interest1Formatted);
    $stmt_loanupdate1->execute();
    $stmt_loanupdate1->closeCursor();
    $sql_loan_trans1 = "Call InsertTransaction_Loan(:acc,:loan_amount)";
    $stmt_loan_trans1 = $conn->prepare($sql_loan_trans1);
    $stmt_loan_trans1->bindParam(':acc', $acc);
    $stmt_loan_trans1->bindParam(':loan_amount', $loan_amount);
    $stmt_loan_trans1->execute();
}

if ($interest2 != 0 && $loan_type_2 != '') {
    $month_return2 = $_SESSION['month_return2'];
    $interest2Formatted = number_format($interest2 * 100, 0);
    $month_return2Formatted = number_format($month_return2, 0);
    $string .= "당신의 이자율은 {$interest2Formatted}% 이고, 월 상환액은 {$month_return2Formatted}원 입니다.";
    $sql_loanupdate2 = "Call INSERT_LOAN_HISTORY(2,:acc,:loan_amount,:interest)";
    $stmt_loanupdate2 = $conn->prepare($sql_loanupdate2);
    $stmt_loanupdate2->bindParam(':acc', $acc);
    $stmt_loanupdate2->bindParam(':loan_amount', $loan_amount);
    $stmt_loanupdate2->bindParam(':interest', $interest2Formatted);
    $stmt_loanupdate2->execute();
    $stmt_loanupdate2->closeCursor();
    $sql_loan_trans2 = "Call InsertTransaction_Loan(:acc,:loan_amount)";
    $stmt_loan_trans2 = $conn->prepare($sql_loan_trans2);
    $stmt_loan_trans2->bindParam(':acc', $acc);
    $stmt_loan_trans2->bindParam(':loan_amount', $loan_amount);
    $stmt_loan_trans2->execute();
}
session_unset();
?>

<!doctype html>
<html lang="ko">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.118.2">
    <title>Checkout example · Bootstrap v5.3</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/checkout/">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Favicons -->
    <meta name="theme-color" content="#712cf9">

    <style>
        .nav-link.px-2.active {
            background-color: #A3C6C4;
        }

        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .b-example-divider {
            width: 100%;
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }

        .btn-bd-primary {
            --bd-violet-bg: #712cf9;
            --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

            --bs-btn-font-weight: 600;
            --bs-btn-color: var(--bs-white);
            --bs-btn-bg: var(--bd-violet-bg);
            --bs-btn-border-color: var(--bd-violet-bg);
            --bs-btn-hover-color: var(--bs-white);
            --bs-btn-hover-bg: #6528e0;
            --bs-btn-hover-border-color: #6528e0;
            --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
            --bs-btn-active-color: var(--bs-btn-hover-color);
            --bs-btn-active-bg: #5a23c8;
            --bs-btn-active-border-color: #5a23c8;
        }

        .bd-mode-toggle {
            z-index: 1500;
        }

        .bd-mode-toggle .dropdown-menu .active .bi {
            display: block !important;
        }

        /* .containered {
            margin-top: 293px;
            margin-left: 275px;
        } */
    </style>


</head>

<body class="bg-body-tertiary">
    <main>
        <div class="container">
            <div class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
                <a href="./dashboard.html" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
                    <img class="logo-svg" src="https://raw.githubusercontent.com/J7NU/django_Ato_Z/504f2afdbcd1e394be13353b492a1238ae9be1c6/logo.svg" alt="지누은행 로고" width="50" height="34">
                </a>

                <ul class="nav nav-pills justify-content-end mb-md-0 fw-bold">

                    &nbsp;

                    <li><a href="./dashboard.html" class="nav-link px-2 link-body-emphasis">MAIN</a></li>
                    <li><a href="deposit_menu.php" class="nav-link px-2 link-body-emphasis">예출금</a></li>
                    <li><a href="transfer.php" class="nav-link px-2 link-body-emphasis">송금</a></li>
                    <li><a href="withdraw.php" class="nav-link px-2 link-body-emphasis">출금</a></li>
                    <li><a href="loan.php" class="nav-link px-2 active">대출</a></li>
                    <li><a href="cus_info.php" class="nav-link px-2 link-body-emphasis">고객정보</a></li>
                    <li><a href="emp_info.php" class="nav-link px-2 link-body-emphasis">직원정보</a></li>
                    <li><a href="bank_info.php" class="nav-link px-2 link-body-emphasis">은행정보</a></li>
                </ul>
            </div>
        </div>
    </main>
    <article>
        <div style="text-align: center;">
            <p style="margin-top: 50ps;">
                <?php
                echo $string;
                ?>
            </p>
        </div>

    </article>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</html>