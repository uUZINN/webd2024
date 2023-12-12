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
            <h2>이용약관</h2>
            <div class="join__index">
                <ul>
                    <li class="active">1</li>
                    <li>2</li>
                    <li>3</li>
                </ul>
            </div>

            <div class="join__agree">
                <div class="agree__box">
                    <h3 class="blind">uzin 블로그 이용약관</h3>
                    <div class="scroll scroll__style">
                        <div class="scroll__cont">제1조 (목적) 본 약관은 [회사명] (이하 "회사"라 함)이 제공하는 모든 서비스(이하 "서비스"라 함)의 이용 조건과 절차, 회사와 회원 간의 권리, 의무 및 책임사항 등을 규정하는 것을 목적으로 합니다.
                            제2조 (용어의 정의) 본 약관에서 사용하는 용어의 정의는 다음과 같습니다.
                            1. "서비스"라 함은 회사가 제공하는 모든 서비스를 의미합니다.
                            2. "회원"이라 함은 회사와 서비스 이용계약을 체결하고 회사가 제공하는 서비스를 이용하는 개인 또는 법인을 말합니다.
                            3. "아이디(ID)"라 함은 회원의 식별과 회원의 서비스 이용을 위하여 회원이 정하고 회사가 승인하는 문자와 숫자의 조합을 말합니다.
                            4. "비밀번호"라 함은 회원이 부여 받은 아이디와 일치된 회원임을 확인하고 회원의 개인정보를 보호하기 위하여 회원 자신이 정한 문자와 숫자의 조합을 말합니다.    
                        </div>
                    </div>
                    <div class="check__agree">
                        <input type="checkbox" name="agreeCheck1" id="agreeCheck1">
                        <span class="on"></span>
                        <label for="agreeCheck1">
                            <span>블로그 이용약관에 동의합니다.</span>
                        </label>
                    </div>
                </div>
                <div class="agree__box">
                    <h3 class="blind">uzin 블로그 개인정보취급방침</h3>
                    <div class="scroll scroll__style">
                        <div class="scroll__cont">[uzin주식회사] 개인정보 수집 및 이용안내
                            수집하는 개인정보의 항목 및 수집방법
                            수집항목 : 이름, 연락처(이메일 주소, 전화번호), 주소, 성별 등
                            수집방법 : 홈페이지, 모바일 앱, 이메일, 이벤트 응모, 상담 게시판 등
                            개인정보의 수집 및 이용 목적
                            &nbsp;&nbsp;&nbsp;&nbsp;회사는 수집한 개인정보를 다음의 목적을 위해 이용합니다.
                            &nbsp;&nbsp;&nbsp;&nbsp;1. 서비스 제공에 관한 계약 이행 및 서비스 제공에 따른 요금 정산
                            &nbsp;&nbsp;&nbsp;&nbsp;2. 회원 관리
                            &nbsp;&nbsp;&nbsp;&nbsp;3. 불만처리 등 민원처리
                            &nbsp;&nbsp;&nbsp;&nbsp;4. 마케팅 및 광고에 활용    
                        </div>
                    </div>
                    <div class="check__agree">
                        <input type="checkbox" name="agreeCheck2" id="agreeCheck2">
                        <span class="on"></span>
                        <label for="agreeCheck2">
                            <span>블로그 개인정보 수집 및 이용에 동의합니다.</span>
                        </label>
                    </div>
                </div>
                <div class="agree__btn">
                    <button id="agreeButton">동의하기</button> 
                </div>
            </div>
        </section>
    </main>
    <!-- //main -->

    <?php include "../include/footer.php" ?>
    <!-- //footer -->

    <script>
        document.getElementById("agreeButton").addEventListener("click", () => {
            const agreeCheck1 = document.getElementById("agreeCheck1");
            const agreeCheck2 = document.getElementById("agreeCheck2");

            if(agreeCheck1.checked && agreeCheck2.checked){
                window.location.href = "joinInsert.php";
            } else {
                alert("이용약관 및 개인정보취급방침을 동의해주세요!");
            }
        });
    </script>
</body>
</html>
