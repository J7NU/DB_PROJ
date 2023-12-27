<?php
session_start();

if (!isset($_SESSION['acc']) or $_SESSION['pw'] == '') {
    echo "이 페이지에 접근할 수 없습니다.";
    header("Location: ./index.html");
    exit;
}
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

        .nav-link.px-2.active {
            background-color: #A3C6C4;
        }

        .btn.btn-primary.btn-lg {
            background-color: #A3C6C4;
            border-color: #A3C6C4;
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
                    <li><a href="loan.php" class="nav-link px-2 active">대출</a></li>
                    <li><a href="cus_info.php" class="nav-link px-2 link-body-emphasis">고객정보</a></li>
                    <li><a href="emp_info.php" class="nav-link px-2 link-body-emphasis">직원정보</a></li>
                    <li><a href="bank_info.php" class="nav-link px-2 link-body-emphasis">은행정보</a></li>
                </ul>
            </div>
        </div>
    </main>


    <div class="containered">
        <main>
            <div class='container_head' style="margin-left: 14%;">
                <h2>어떤 종류의 대출을 원하십니까?</h2>
            </div>
            <!-- 대출 박스 송금이랑 같이 처리하기. -->
            <div class="col-md-10 col-lg-8">
                <form class="needs-validation" novalidate action="loan_ok.php" method="post">

                    <hr class="my-4">

                    <div class="form-check" style="margin-top: 30px;">
                        <input type="checkbox" class="form-check-input" id="loan_type_1" name="loan_type_1" value="yes">
                        <label class="form-check-label" for="loan_type1">신용대출</label>
                    </div>

                    <div class="form-check" style="margin-top: 15px;">
                        <input type="checkbox" class="form-check-input" id="loan_type_2" name="loan_type_2" value="yes">
                        <label class="form-check-label" for="loan_type_2">주택담보대출</label>
                    </div>
                    <div class="col-12" style="margin-top: 30px;">
                        <label for="text" class="form-label">공시가액 <span class="text-body-secondary">직원에게 인증받은 공시가액을 입력해주세요.</span></label>
                        <input type="text" class="form-control" id="property_value" name="property_value" placeholder="공시가액을 입력해주세요.">
                    </div>

                    <div class="col-12" style="margin-top: 15px;">
                        <label for="loan_amount" class="form-label">대출액</label>
                        <input type="loan_amount" class="form-control" id="loan_amount" name="loan_amount" placeholder="대출액을 입력해주세요.">
                    </div>
                    <hr class="my-4" style="margin-top: 30px;">
                    <a href="./loan_howmuch.php">
                        <button class="w-100 btn btn-primary btn-lg" type="submit" id="loan_next" name="loan_next">다음</button>
                    </a>
                </form>
            </div>
    </div>
    </main>
    </div>
    <script>
        var checkboxes = document.querySelectorAll('input[name^="loan_type"]');
        var propertyValueInput = document.getElementById('property_value');
        var loanAmountInput = document.getElementById('loan_amount');

        checkboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                if (checkbox.id === 'loan_type_1') {
                    propertyValueInput.disabled = checkbox.checked;
                    loanAmountInput.disabled = !checkbox.checked;
                } else if (checkbox.id === 'loan_type_2') {
                    propertyValueInput.disabled = !checkbox.checked;
                    loanAmountInput.disabled = !checkbox.checked;
                }

                var bothUnchecked = !checkboxes[0].checked && !checkboxes[1].checked;

                if (bothUnchecked) {
                    propertyValueInput.disabled = false;
                    loanAmountInput.disabled = false;
                }

                checkboxes.forEach(function(otherCheckbox) {
                    if (otherCheckbox !== checkbox) {
                        otherCheckbox.checked = false;
                    }
                });
            });
        });


        const loan_next = document.querySelector("#loan_next");
        const property_value = document.querySelector('#property_value');
        const loan_type_2_checkbox = document.getElementById('loan_type_2');
        const loan_amount = document.querySelector('#loan_amount');

        loan_next.addEventListener("click", function(event) {
            checkLoanType1(event);
        });

        loan_type_2_checkbox.addEventListener('change', function(event) {
            checkLoanType2(event);
        });

        function checkLoanType1(event) {
            const loan_amount = document.querySelector("#loan_amount");
            // Check the state of the checkboxes directly
            if (document.getElementById('loan_type_1').checked && loan_amount.value === "") {
                alert('대출액을 입력해주세요.');
                loan_amount.focus();
                event.preventDefault();
            }
        }

        function checkLoanType2(event) {
            if (loan_type_2_checkbox.checked) {
                if (property_value.value === "" || loan_amount.value === "") {
                    alert('공란을 채워주세요');
                    if (property_value.value === "") {
                        property_value.focus();
                    } else if (loan_amount.value === "") {
                        loan_amount.focus();
                    }
                    event.preventDefault();
                } else if (property_value.value === "") {
                    alert('공시가액을 입력해주세요.');
                    property_value.focus();
                    event.preventDefault();
                } else if (loan_amount.value === "") {
                    alert('대출액을 입력해주세요.');
                    loan_amount.focus();
                    event.preventDefault();
                }
            }
        };
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="./js/checkout.js"></script>
</body>

</html>