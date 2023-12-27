<?php
session_start();

if (!isset($_SESSION['acc']) or $_SESSION['pw'] == '') {
    echo "이 페이지에 접근할 수 없습니다.";
    header("Location: ./index.html");
    exit;
}
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

        .btn.btn-primary.w-100.py-2.fw-bold {
            background-color: #A3C6C4;
            border-color: #A3C6C4;
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
                    <li><a href="deposit_menu.php" class="nav-link px-2 active">예출금</a></li>
                    <li><a href="transfer.php" class="nav-link px-2 link-body-emphasis">송금</a></li>
                    <li><a href="withdraw.php" class="nav-link px-2 link-body-emphasis">출금</a></li>
                    <li><a href="loan.php" class="nav-link px-2 link-body-emphasis">대출</a></li>
                    <li><a href="cus_info.php" class="nav-link px-2 link-body-emphasis">고객정보</a></li>
                    <li><a href="emp_info.php" class="nav-link px-2 link-body-emphasis">직원정보</a></li>
                    <li><a href="bank_info.php" class="nav-link px-2 link-body-emphasis">은행정보</a></li>
                </ul>
            </div>
        </div>
    </main>

    <article>
        <div class="container">
            <header class="post-info">
                <h2 class="post-title">
                    출금
                </h2>
            </header>
            <div class="box_container">

                <div>
                    <form method="post" id="withdraw_form" name="withdraw_form" action=withdraw.php autocomplete="off">
                        <div class="form-floating">
                            <input type="int" class="form-control" name="withdraw_amount" id="withdraw_amount" placeholder="출금액">
                            <label for="floatingInput" class="fw-bold">출금액</label>
                        </div>
                        <button class="btn btn-primary w-100 py-2 fw-bold" type="button" id="withdraw_next" style="margin-top:30px;">다음</button>
                    </form>
                </div>
            </div>
        </div>
        <script>
            // 출금액 공란 방지용
            const withdraw_next = document.querySelector("#withdraw_next");
            withdraw_next.addEventListener("click", () => {
                const withdraw_amount = document.querySelector("#withdraw_amount");
                if (withdraw_amount.value == "") {
                    alert('출금액을 입력해주세요.');
                    withdraw_amount.focus();
                    return false;
                }

                // 비밀번호 입력 받기
                const usertypedpw_wd = prompt('계좌 비밀번호를 확인해주세요');
                if (!usertypedpw_wd) {
                    alert('비밀번호를 입력해야 합니다.');
                    return false;
                }

                // FormData에 비밀번호 추가
                const withdraw_form = document.querySelector("#withdraw_form");
                const f3 = new FormData(withdraw_form);
                f3.append('usertypedpw_wd', usertypedpw_wd);

                const xhr = new XMLHttpRequest();

                xhr.open("POST", "./withdraw_ok.php", true);
                xhr.send(f3);


                xhr.onload = () => {
                    if (xhr.status == 200) {
                        const data = JSON.parse(xhr.responseText);
                        if (data.result == 'success') {
                            alert('출금 성공');
                            self.location.href = './dashboard.html';
                        } else if (data.result === 'fail_low_balance') {
                            alert('계좌 잔액이 부족합니다.');
                        } else if (data.result == 'fail_wrong_pw') {
                            alert('잘못된 비밀 번호입니다. ');
                        }
                    } else {
                        alert('통신에 실패했습니다.');
                    }
                }

            });
        </script>


    </article>
</body>