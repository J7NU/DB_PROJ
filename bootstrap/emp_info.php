<?php
include 'db.php';
session_start();

$sql = "SELECT EMP_NAME, EMP_PHONE, EMP_ADDRESS, E_POSITION_DESCRIPT, BB_NAME, COUNT(ACC_NUM)
FROM EMPLOYEE JOIN E_POSITION ON EMPLOYEE.E_POSITION_CODE = E_POSITION.E_POSITION_CODE JOIN BANK_BRANCH ON EMPLOYEE.BB_CODE = BANK_BRANCH.BB_CODE JOIN ACCOUNT ON EMPLOYEE.EMP_CODE = ACCOUNT.EMP_CODE
GROUP BY EMPLOYEE.EMP_CODE;";
$stmt_basic = $conn->prepare($sql);
$stmt_basic->execute();

?>

<!doctype html>
<html lang="ko" data-bs-theme="auto">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.118.2">
    <title>Headers · Bootstrap v5.3</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/headers/">



    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- Favicons -->
    <meta name="theme-color" content="#712cf9">


    <style>
        .nav-link.px-2.active {
            background-color: #A3C6C4;
        }

        .post-info {
            position: relative;
            padding-top: 4px;
            padding-left: 80px;
            margin-bottom: 40px;
        }

        .box_container {
            position: absolute;
            top: 382px;
            left: 504px;
            width: 432px;
            height: 260px;
            display: flex;
        }

        .containered {
            margin-top: 10px;
            margin-bottom: 228px;
            margin-left: 1%;
            margin-right: 1%;

        }
    </style>

    <!-- Custom styles for this template -->
    <link href="css/headers.css" rel="stylesheet">
</head>

<body>
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
                    <li><a href="loan.php" class="nav-link px-2 link-body-emphasis">대출</a></li>
                    <li><a href="cus_info.php" class="nav-link px-2 link-body-emphasis">고객정보</a></li>
                    <li><a href="emp_info.php" class="nav-link px-2 active">직원정보</a></li>
                    <li><a href="bank_info.php" class="nav-link px-2 link-body-emphasis">은행정보</a></li>
                </ul>
            </div>
        </div>
    </main>
    <div class="row g-5">
    </div>

    <div class="containered">
        <div class="row col-md-4 col-lg-12" style="margin-top:50px; margin-left:200px;">
            <div class="col-md-7 col-lg-5">
                <div>
                    <?php

                    $sql = "SELECT AVG(bb_balance) AS avg_balance FROM customer c JOIN bank_branch b ON c.bb_code = b.bb_code";

                    $stmt = $conn->prepare($sql);
                    $stmt->execute();

                    $result = $stmt->fetch(PDO::FETCH_ASSOC);
                    $avgBalance = number_format($result['avg_balance'], 2);
                    echo "<p> 평균 잔액: {$avgBalance} 원</p>";
                    ?>

                </div>

                <div>
                    <?php
                    $sql2 = "SELECT AVG(subquery.CUS_COUNT) AS avg_cus_count FROM (SELECT COUNT(CUS_CODE) AS CUS_COUNT FROM BANK_BRANCH JOIN CUSTOMER ON BANK_BRANCH.BB_CODE = CUSTOMER.BB_CODE GROUP BY BANK_BRANCH.BB_CODE) AS subquery";
                    $stmt2 = $conn->prepare($sql2);
                    $stmt2->execute();
                    $result2 = $stmt2->fetch(PDO::FETCH_ASSOC);
                    $avgcus = number_format($result2['avg_cus_count'], 2);
                    echo "<p> 평균 고객: {$avgcus} 명</p>";
                    ?>
                </div>


            </div>
            <form class=" col-md-3 col-md-3" method="post" id="emp_search_form" name="emp_search_form" action="emp_info_ok.php" style="margin-left:170px;">
                <input class="form-control" id="emp_search_name" name="emp_search_name" placeholder="직원이름">
                <input class="form-control" style="margin-top: 5px;" id="emp_search_phone" name="emp_search_phone" placeholder="전화번호">
                <button class="btn btn-outline-success" style="margin-top: 15px; margin-left:200px;" id="emp_search_next" name="emp_search_next" type="button">검색</button>
            </form>
        </div>
        <div class="row md-5">
            <div class="card mt-5">
                <div class="container">
                    <div class="card-header">
                        <h2 class="display-6 text-center">직원정보</h2>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered text-center">
                            <thead>
                                <tr>
                                    <th>이름</th>
                                    <th>전화번호</th>
                                    <th>직원 주소</th>
                                    <th>직급</th>
                                    <th>소속 지점</th>
                                    <th>개설 계좌수</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                <?php
                                while ($result = $stmt_basic->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                                    <tr>
                                        <td><?php echo $result['EMP_NAME'] ?></td>
                                        <td><?php echo $result['EMP_PHONE'] ?></td>
                                        <td><?php echo $result['EMP_ADDRESS'] ?></td>
                                        <td><?php echo $result['E_POSITION_DESCRIPT'] ?></td>
                                        <td><?php echo $result['BB_NAME'] ?></td>
                                        <td><?php echo $result['COUNT(ACC_NUM)'] ?></td>
                                    </tr>
                                <?php
                                }
                                ?>

                        </table>
                    </div>

                </div>

            </div>

        </div>

    </div>
    <script>
        const emp_search_next = document.querySelector("#emp_search_next");
        emp_search_next.addEventListener("click", () => {
            const emp_search_name = document.querySelector("#emp_search_name");
            if (emp_search_name.value == "") {
                alert('찾으시려는 직원의 이름을 입력해주세요.');
                emp_search_name.focus();
                return false;
            }
            const emp_search_phone = document.querySelector("#emp_search_phone");
            if (emp_search_phone.value == "") {
                alert('찾으시려는 직원의 전화번호를 입력해주세요.');
                emp_search_phone.focus();
                return false;
            }
            const emp_search_form = document.querySelector("#emp_search_form");
            const f3 = new FormData(emp_search_form);

            var xhr = new XMLHttpRequest();
            xhr.open("POST", "./emp_info_ok.php", true);

            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    try {
                        const result = JSON.parse(xhr.responseText);
                        if (Array.isArray(result)) {
                            updateTable(result);
                        }
                    } catch (error) {
                        console.error("Error parsing JSON:", error);
                    }
                }
            };

            xhr.send(f3);
        });

        function updateTable(result) {
            const tableBody = document.querySelector(".table-group-divider");
            tableBody.innerHTML = "";

            const newRow = document.createElement("tr");
            newRow.innerHTML = `
            <td>${result[0]['EMP_NAME']}</td>
            <td>${result[0]['EMP_PHONE']}</td>
            <td>${result[0]['EMP_ADDRESS']}</td>
            <td>${result[0]['E_POSITION_DESCRIPT']}</td>
            <td>${result[0]['BB_NAME']}</td>
            <td>${result[0]['COUNT(ACC_NUM)']}</td>
        `;
            tableBody.appendChild(newRow);
        }
    </script>
</body>

</html>