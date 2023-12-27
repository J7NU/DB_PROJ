<?php
include "db.php";

$sql1 = "SELECT BB_NAME FROM BANK_BRANCH ";
$stmt1 = $conn->prepare($sql1);
$stmt1->execute();

$bank_branches = $stmt1->fetchAll(PDO::FETCH_ASSOC);

$sql2 = "SELECT C_JOB_DESCRIPT FROM c_job";
$stmt2 = $conn->prepare($sql2);
$stmt2->execute();

$jobs = $stmt2->fetchAll(PDO::FETCH_ASSOC);


?>
<!doctype html>
<html lang="en" data-bs-theme="auto">

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

        .container {
            max-width: 960px;
        }

        .nav-link.px-2.active {
            background-color: #A3C6C4;
        }

        .btn.btn-primary.btn-lg {
            background-color: #A3C6C4;
            border-color: #A3C6C4;
        }
    </style>

</head>

<body>
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
                <li><a href="loan.php" class="nav-link px-2 link-body-emphasis">대출</a></li>
                <li><a href="cus_info.php" class="nav-link px-2 link-body-emphasis">고객정보</a></li>
                <li><a href="emp_info.php" class="nav-link px-2 link-body-emphasis">직원정보</a></li>
                <li><a href="bank_info.php" class="nav-link px-2 link-body-emphasis">은행정보</a></li>
            </ul>
        </div>
        <main>
            <div class="py-5 text-center">
                <h2>회원가입</h2>
                <p class="lead fw-bold" style="color:red; margin-bottom:1px; ">회원가입 시에 계좌가 생성됩니다.</p>
            </div>


            <div class="col-md-8 col-lg-9" style="margin-left:15%">

                <form method="post" id="signup_ok_form" name="signup_ok_form" action=signup_ok.php>
                    <div class="row g-3">
                        <hr class="my-4">
                        <div class="col-8" style="margin-left: 15%;">
                            <label for="cus_name" class="form-label">성함</label>
                            <input type="text" class="form-control" id="cus_name" name="cus_name" placeholder="이름을 입력해주세요." value="">
                        </div>

                        <div class="col-8" style="margin-left: 15%;">
                            <label for="cus_phone" class="form-label">휴대전화</label>
                            <input type="cus_phone" class="form-control" id="cus_phone" name="cus_phone" placeholder="010-xxxx-xxxx의 형태로 입력해주세요.">
                        </div>

                        <div class="col-8" style="margin-left: 15%;">
                            <label for="address" class="form-label">주소</label>
                            <input type="text" class="form-control" id="address" name="address" placeholder=" XX시 XX구 XX동">

                        </div>

                        <div class="col-8" style="margin-left: 15%;">
                            <label for="bank_branch" class="form-label">지점명</label>
                            <select class="form-select" id="bank_branch" name="bank_branch">
                                <option value="">은행지점을 선택해주세요.</option>
                                <?php
                                $count1 = 1;
                                foreach ($bank_branches as $bank_branch) {
                                    echo "<option value='{$count1}'>{$bank_branch['BB_NAME']}</option>";
                                    $count1++;
                                }
                                ?>
                            </select>
                        </div>

                        <div class="col-8" style="margin-left: 15%;">
                            <label for="emp_code" class="form-label">직원번호&nbsp; <span class="text-body-secondary"> (이 칸은 직원이 작성합니다.)</span></label>
                            <input type="text" class="form-control" id="emp_code" name="emp_code placeholder=" 담당 직원의 코드를 작성해주세요" value="">
                        </div>

                        <div class="col-8" style="margin-left: 15%;">
                            <label for="job" class="form-label">직업</label>
                            <select class="form-select" id="job" name="job" required>
                                <option value="">직업을 선택해주세요.</option>
                                <?php
                                $count2 = 1;
                                foreach ($jobs as $job) {
                                    echo "<option value='{$count2}'>{$job['C_JOB_DESCRIPT']}</option>";
                                    $count2++;
                                }
                                ?>
                            </select>
                        </div>

                    </div>
                    <hr class="my-4">
                    <button class="w-100 btn btn-primary btn-lg" type="submit" id="signup_next" name="signup_next" value="">회원가입</button>
                </form>

            </div>
    </div>
    </main>

    </div>
    <script>
        const signup_next = document.querySelector("#signup_next");
        signup_next.addEventListener("click", () => {
            const cus_name = document.querySelector("#cus_name");
            if (cus_name.value == "") {
                alert('성함을 입력해주세요.');
                cus_name.focus();
                return false;
            }
            const cus_phone = document.querySelector("#cus_phone");
            if (cus_phone.value == "") {
                alert('휴대전화을 입력해주세요.');
                cus_phone.focus();
                return false;
            }
            const address = document.querySelector("#address");
            if (address.value == "") {
                alert('주소을 입력해주세요.');
                address.focus();
                return false;
            }
            const country = document.querySelector("#country");
            if (country.value == "") {
                alert('을 입력해주세요.');
                country.focus();
                return false;
            }
            const job = document.querySelector("#job");
            if (job.value == "") {
                alert('주소을 입력해주세요.');
                job.focus();
                return false;
            }

            const signup_ok_form = document.querySelector("#signup_ok_form");
            const f6 = new FormData(signup_ok_form);

            const xhr = new XMLHttpRequest();
            xhr.open("POST", "./signup_ok.php", true);

            xhr.send(f6);

        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="./js/checkout.js"></script>
</body>

</html>