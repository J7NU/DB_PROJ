<?php
include 'db.php';
session_start();


$sql = "SELECT CUSTOMER.CUS_NAME , CUS_PHONE, CUS_ADDRESS, BB_NAME, C_JOB_DESCRIPT, CUS_RANK_NAME, COUNT(ACC_NUM)
FROM CUSTOMER JOIN CUS_RANK ON CUSTOMER.CUS_RANK_CODE = CUS_RANK.CUS_RANK_CODE JOIN C_JOB ON CUSTOMER.C_JOB_CODE = C_JOB.C_JOB_CODE JOIN ACCOUNT ON CUSTOMER.CUS_CODE = ACCOUNT.CUS_CODE JOIN BANK_BRANCH ON CUSTOMER.BB_CODE = BANK_BRANCH.BB_CODE
GROUP BY CUSTOMER.CUS_CODE";
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
                    <li><a href="cus_info.php" class="nav-link px-2 active">고객정보</a></li>
                    <li><a href="emp_info.php" class="nav-link px-2 link-body-emphasis">직원정보</a></li>
                    <li><a href="bank_info.php" class="nav-link px-2 link-body-emphasis">은행정보</a></li>
                </ul>
            </div>
        </div>
    </main>
    <div class="row g-5">
    </div>

    <div class="containered ">
        <div class="col-md-7 col-lg-5" style="margin-top:50px; margin-left:1000px;">
            <form class=" col-md-5 col-md-5" method="post" id="cus_search_form" name="cus_search_form" action="cus_info_ok.php">
                <input class="form-control" id="cus_search_name" name="cus_search_name" placeholder="고객이름">
                <input class="form-control" style="margin-top: 5px;" id="cus_search_phone" name="cus_search_phone" placeholder="전화번호">
                <button class="btn btn-outline-success" style="margin-top: 15px; margin-left:200px;" id="cus_search_next" name="cus_search_next" type="button">검색</button>
            </form>
        </div>
        <div class="row md-5">
            <div class="card mt-5">
                <div class="container">
                    <div class="card-header">
                        <h2 class="display-6 text-center">고객정보</h2>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered text-center">
                            <thead>
                                <tr>
                                    <th>이름</th>
                                    <th>전화번호</th>
                                    <th>고객 주소</th>
                                    <th>은행 지점명</th>
                                    <th>직업</th>
                                    <th>등급</th>
                                    <th>개설 계좌수</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                <?php
                                while ($result = $stmt_basic->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                                    <tr>
                                        <td><?php echo $result['CUS_NAME'] ?></td>
                                        <td><?php echo $result['CUS_PHONE'] ?></td>
                                        <td><?php echo $result['CUS_ADDRESS'] ?></td>
                                        <td><?php echo $result['BB_NAME'] ?></td>
                                        <td><?php echo $result['C_JOB_DESCRIPT'] ?></td>
                                        <td><?php echo $result['CUS_RANK_NAME'] ?></td>
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
        const cus_search_next = document.querySelector("#cus_search_next");
        cus_search_next.addEventListener("click", () => {
            const cus_search_name = document.querySelector("#cus_search_name");
            if (cus_search_name.value == "") {
                alert('찾으시려는 고객의 이름을 입력해주세요.');
                cus_search_name.focus();
                return false;
            }
            const cus_search_phone = document.querySelector("#cus_search_phone");
            if (cus_search_phone.value == "") {
                alert('찾으시려는 고객의 전화번호를 입력해주세요.');
                cus_search_phone.focus();
                return false;
            }
            const cus_search_form = document.querySelector("#cus_search_form");
            const f2 = new FormData(cus_search_form);

            var xhr = new XMLHttpRequest();
            xhr.open("POST", "./cus_info_ok.php", true);

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

            xhr.send(f2);
        });

        function updateTable(result) {
            const tableBody = document.querySelector(".table-group-divider");
            tableBody.innerHTML = "";

            const newRow = document.createElement("tr");
            newRow.innerHTML = `
            <td>${result[0]['CUS_NAME']}</td>
            <td>${result[0]['CUS_PHONE']}</td>
            <td>${result[0]['CUS_ADDRESS']}</td>
            <td>${result[0]['BB_NAME']}</td>
            <td>${result[0]['C_JOB_DESCRIPT']}</td>
            <td>${result[0]['CUS_RANK_NAME']}</td>
            <td>${result[0]['COUNT(ACC_NUM)']}</td>
        `;
            tableBody.appendChild(newRow);
        }
    </script>
</body>

</html>