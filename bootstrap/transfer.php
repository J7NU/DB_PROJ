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
            --bs-btn-color: #A3C6C4;
            --bs-btn-bg: var(--bd-violet-bg);
            --bs-btn-border-color: #A3C6C4;
            --bs-btn-hover-color: #A3C6C4;
            --bs-btn-hover-bg: #6528e0;
            --bs-btn-hover-border-color: #6528e0;
            --bs-btn-focus-shadow-rgb: #A3C6C4;
            --bs-btn-active-color: var(--bs-btn-hover-color);
            --bs-btn-active-bg: #A3C6C4;
            --bs-btn-active-border-color: #A3C6C4;
        }

        .bd-mode-toggle {
            z-index: 1500;
        }

        .bd-mode-toggle .dropdown-menu .active .bi {
            display: block !important;
        }

        .nav-link.px-2.active {
            background-color: #A3C6C4;
        }

        .containered {
            margin-top: 50px;
            margin-bottom: 228px;
            margin-left: 25%;

        }

        .container_head {
            margin-top: 28px;
            margin-left: 30px;
        }

        .btm_container {
            margin-top: 70px;
            margin-bottom: 22px;
            margin-left: 20%;
            margin-right: 40%;
        }

        .box_container {
            width: 70%;
        }

        .btn.btn-primary.btn-lg {
            background-color: #A3C6C4;
            border-color: #A3C6C4;
            margin-right: 50%;
        }

        .my-4.hrhr {
            margin-right: 33%;
        }
    </style>


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
                    <li><a href="transfer.php" class="nav-link px-2 active">송금</a></li>
                    <li><a href="loan.php" class="nav-link px-2 link-body-emphasis">대출</a></li>
                    <li><a href="cus_info.php" class="nav-link px-2 link-body-emphasis">고객정보</a></li>
                    <li><a href="emp_info.php" class="nav-link px-2 link-body-emphasis">직원정보</a></li>
                    <li><a href="bank_info.php" class="nav-link px-2 link-body-emphasis">은행정보</a></li>
                </ul>
            </div>
        </div>
    </main>

    <div class="containered">
        <main>
            <div class='container_head'>
                <h2>송금</h2>
            </div>
            <div class="col-md-10 col-lg-8">
                <form id="transfer_form" name="transfer_form" action="transfer_ok.php" method='post'>
                    <div class="box_container">
                        <div class="col-12" style="margin-top: 55px;">
                            <label for="transfer_acc" class="form-label">계좌번호</label>
                            <input type="text" class="form-control" id="transfer_acc" name="transfer_acc" placeholder="계좌번호를 입력하세요.">
                        </div>
                        <div class="col-md-5" style="margin-top: 50px;">
                            <label for="BB_CODE" class="form-label">은행</label>
                            <select class="form-select" id="BB_CODE" name="BB_CODE">
                                <option value=100>은행을 선택해주세요.</option>
                                <option value=0>지누은행</option>
                                <option value=1>KB국민은행</option>
                                <option value=2>우리은행</option>
                                <option value=3>하나은행</option>
                                <option value=4>신한은행</option>
                                <option value=5>IBK기업은행</option>
                                <option value=6>SC제일은행</option>
                                <option value=7>한국시티은행</option>
                                <option value=8>케이뱅크</option>
                                <option value=9>카카오뱅크</option>
                                <option value=10>토스</option>
                                <option value=11>대구은행</option>
                                <option value=12>부산은행</option>
                                <option value=13>경남은행</option>
                                <option value=14>광주은행</option>
                                <option value=15>전북은행</option>
                            </select>
                        </div>
                    </div>
                    <div class="btm_container">
                        <div style="margin-top: 75px">
                            <label for="transfer_amount" class="form-label">송금액</label>
                            <input type="text" class="form-control" id="transfer_amount" name="transfer_amount" placeholder="보낼금액">
                        </div>
                    </div>
                    <button class="w-100 btn btn-primary btn-lg" id="transfer_next" name="transfer_next" type="button" style="margin-top: 46px; " value="">다음</button>
                </form>
            </div>
            <hr class="my-4 hrhr">
        </main>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="./js/checkout.js"></script>
    <script>
        // 예금액 공란 방지용
        const transfer_next = document.querySelector("#transfer_next");
        transfer_next.addEventListener("click", () => {
            const transfer_amount = document.querySelector("#transfer_amount");
            if (transfer_amount.value == "") {
                alert('송금액을 입력해주세요.');
                transfer_acc.focus();
                return false;
            }

            // 비밀번호 입력 받기
            const usertypedpw_intransfer = prompt('계좌 비밀번호를 확인해주세요');
            if (!usertypedpw_intransfer) {
                alert('비밀번호를 입력해야 합니다.');
                return false;
            };

            const transfer_form = document.querySelector("#transfer_form");
            const f4 = new FormData(transfer_form);
            f4.append('usertypedpw_intransfer', usertypedpw_intransfer);

            const xhr = new XMLHttpRequest();
            xhr.open("POST", "./transfer_ok.php", true);

            xhr.send(f4);

            xhr.onload = () => {
                if (xhr.status == 200) {
                    const data = JSON.parse(xhr.responseText);
                    if (data.result == 'success') {
                        alert('송금 성공');
                        self.location.href = './dashboard.html';
                    } else if (data.result == 'fail') {
                        alert('송금 실패');
                    }
                } else {
                    alert('통신에 실패했습니다.');
                }
            };


        });
    </script>
</body>

</html>