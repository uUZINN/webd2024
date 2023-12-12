<?php
    include "../connect/connect.php";
    include "../connect/session.php";

    $youId = mysqli_real_escape_string($connect, $_POST['youId']);
    $youName = mysqli_real_escape_string($connect, $_POST['youName']);
    $youEmail = mysqli_real_escape_string($connect, $_POST['youEmail']);
    $youPass = mysqli_real_escape_string($connect, $_POST['youPass']);
    $youPhone = mysqli_real_escape_string($connect, $_POST['youPhone']);
    $youRegTime = time();

    $sql = "INSERT INTO myMembers(youId, youName, youEmail, youPass, youPhone, youRegTime) VALUES('$youId', '$youName', '$youEmail', '$youPass', '$youPhone', '$youRegTime')"
    $connect -> query($sql);

    // 데이터 베이스 연결 닫기
    mysqli_close($connect);
?>


<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP 블로그 만들기</title>

    <!-- CSS -->
    <?php include "../include/head.php" ?>
</head>
<body class="gray">
    <?php include "../include/skip.php" ?>
    <!-- //skip -->

    <?php include "../include/header.php" ?>
    <!-- //header -->

    <main id="main" role="main">
        <div class="intro__inner bmStyle container">
            <div class="intro__img main">
                <img srcset="../assets/img/intro02.jpg 1x, 
                             ../assets/img/intro02@2x.jpg 2x, 
                             ../assets/img/intro02@3x.jpg 3x" alt="소개 이미지">
            </div>
            <div class="intro__text">
                어떤 일이라도 노력하고 즐기면 그 결과는 빛을 바란다고 생각합니다.
                신입의 열정과 도정정신을 깊숙히 새기며 배움에 있어 겸손함을
                유지하며 세부적인 곳까지 파고드는 개발자가 되겠습니다.
            </div>
        </div>
        <section class="join__inner container">
            <h2>회원가입 완료</h2>
            <div class="join__index">
                <ul>
                    <li>1</li>
                    <li>2</li>
                    <li class="active">3</li>
                </ul>
            </div>
            <div class="join__result">
                <p>
                    회원가입을 축하드립니다. 환영합니다. <br>
                    로그인을 해주세요!
                </p>   
                <a href="login.html" class="result__btn mt100">로그인</a> 
            </div>
            
        </section>
    </main>
    <!-- //main -->

    <?php include "../include/footer.php" ?>
    <!-- //footer -->
</body>
</html>
