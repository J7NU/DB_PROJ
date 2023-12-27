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
    <link href='//spoqa.github.io/spoqa-han-sans/css/SpoqaHanSansNeo.css' rel='stylesheet' type='text/css'>
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
                    <li><a href="#" class="nav-link px-2 link-body-emphasis">송금</a></li>
                    <li><a href="#" class="nav-link px-2 link-body-emphasis">대출</a></li>
                    <li><a href="#" class="nav-link px-2 link-body-emphasis">고객정보</a></li>
                    <li><a href="#" class="nav-link px-2 link-body-emphasis">직원정보</a></li>
                    <li><a href="#" class="nav-link px-2 link-body-emphasis">은행정보</a></li>
                </ul>
            </div>
        </div>
    </main>

    <article>
        <div class="container">
            <div class="box_container">
                <div>
                    <button class="btn btn-primary w-100 py-2 fw-bold" type="button" id="deposit_check">예금조회</button>
                </div>
                <!-- 결과를 출력할 영역 -->
                <div style="margin-top: 50px;">
                    <p id="result" style="text-align: center;"></p>
                </div>
            </div>
            <script>
                document.getElementById("deposit_check").addEventListener("click", function() {
                    // AJAX를 사용하여 PHP 파일에 데이터 요청
                    var xhr = new XMLHttpRequest();
                    xhr.open("POST", "account_check_ok.php", true);
                    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

                    xhr.onreadystatechange = function() {
                        if (xhr.readyState == 4 && xhr.status == 200) {
                            // 요청이 완료되고 응답이 정상적으로 받아졌을 때 결과를 처리
                            var result = JSON.parse(xhr.responseText);

                            // 결과를 출력
                            showResult(result);
                        }
                    };

                    xhr.send();
                });

                // 결과를 출력하는 함수
                function showResult(result) {
                    var resultDiv = document.getElementById("result");

                    // 결과를 출력
                    resultDiv.innerHTML = "<p>고객님의 성함은 " + result.cus_name + "입니다. <br><br>당신의 계좌번호는 " + result.acc_num + " 입니다. <br><br> 당신의 계좌잔액은 " + result.acc_balance + "원 입니다.</p>";
                }
            </script>
        </div>


    </article>
</body>