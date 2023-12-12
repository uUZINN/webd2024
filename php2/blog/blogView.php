<?php
    include "../connect/connect.php";
    include "../connect/session.php";

    if(isset($_SESSION['memberId'])){
        $memberId = $_SESSION['memberId'];
    } else {
        $memberId = 0;
    }

    if(isset($_GET['blogId'])){
        $blogId = $_GET['blogId'];
    } else {
        Header("Location: blog.php");
    }

    // 조회수 추가
    $updateViewSql = "UPDATE blog SET blogView = blogView + 1 WHERE blogId = '$blogId'";
    $connect -> query($updateViewSql);

    // 블로그 정보 가져오기
    $blogSql = "SELECT * FROM blog WHERE blogId = '$blogId'";
    $blogResult = $connect -> query($blogSql);
    $blogInfo = $blogResult -> fetch_array(MYSQLI_ASSOC);

    // 이전글 가져오기
    $prevBlogSql = "SELECT * FROM blog WHERE blogId < '$blogId' ORDER BY blogId DESC LIMIT 1";
    $prevBlogResult = $connect -> query($prevBlogSql);
    $prevBlogInfo = $prevBlogResult -> fetch_array(MYSQLI_ASSOC);

    // 다음글 가져오기
    $nextBlogSql = "SELECT * FROM blog WHERE blogId > '$blogId' ORDER BY blogId ASC LIMIT 1";
    $nextBlogResult = $connect -> query($nextBlogSql);
    $nextBlogInfo = $nextBlogResult -> fetch_array(MYSQLI_ASSOC);

    // 댓글 정보 가져오기
    $commentSql = "SELECT * FROM blogComment WHERE blogId = '$blogId' AND commentDelete = '1' ORDER BY commentId ASC";
    $commentResult = $connect -> query($commentSql);
    $commentInfo = $commentResult -> fetch_array(MYSQLI_ASSOC);
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
        <div class="intro__inner blogStyle bmStyle container">
            <div class="intro__img main">
                <img srcset="../assets/img/intro02.jpg 1x, 
                             ../assets/img/intro02@2x.jpg 2x, 
                             ../assets/img/intro02@3x.jpg 3x" alt="소개 이미지">
            </div>
            <div class="intro__text">
                <h3>글보기 페이지</h3>
                <p>개발에 필요한 지식을 한눈에!<br>웹 개발과 관련된 최신 정보를 한 눈에 볼 수 있습니다.</p>
            </div>
        </div>

        <div class="blog__layout container">
            <div class="blog__contents">
                <section class="blog__view">
                    <h3><?=$blogInfo['blogTitle']?></h3>
                    <div class="info">
                        <span class="author"><?=$blogInfo['blogAuthor']?></span>
                        <span class="date"><?=date('Y-m-d', $blogInfo['blogRegTime'])?></span>
                    </div>
                    <div class="contents">
                        <img src="../assets/blog/<?=$blogInfo['blogImgFile']?>" alt="<?=$blogInfo['blogTitle']?>">
                        <?=$blogInfo['blogContents']?>
                    </div>
                </section>

                <section class="blog__index">
                    <h4 class="blind">이전글/다음글 가기</h4>

                    <?php if(!empty($prevBlogInfo)){ ?>
                        <a href="blogView.php?blogId=<?=$prevBlogInfo['blogId'];?>" class="prev">
                            이전글 <?=substr($prevBlogInfo['blogTitle'], 0, 20);?>...
                        </a>
                    <?php } else { ?>
                        <span class="prev">이전글이 없습니다.</span>
                    <?php } ?>

                    <?php if(!empty($nextBlogInfo)){ ?>
                        <a href="blogView.php?blogId=<?=$nextBlogInfo['blogId'];?>" class="next">
                            다음글 <?=substr($nextBlogInfo['blogTitle'], 0, 20);?>...
                        </a>
                    <?php } else { ?>
                        <span class="next">다음글이 없습니다.</span>
                    <?php } ?>
                </section>

                <section id="blogComment" class="blog__comment">
                    <h4>댓글 쓰기</h4>
                    <div class="comment">

<?php
    if($commentResult->num_rows == 0){?>
        <div class="comment__view">
            <div class="avata"></div>
            <div class="text">
                <span>
                    아무런 흔적이 없어!!!!!
                </span>
                <p>댓글이 없어!!!🤣 누가 좀 써라!!!</p>
            </div>
        </div>
    <?php } else { 
        forEach($commentResult as $comment){ ?>
            <div class="comment__view">
                <div class="avata"></div>
                <div class="text">
                    <span>
                        <span class="author"><?=$comment['commentName']?></span>
                        <span class="date"><?=date('Y-m-d H:i', $comment['regTime'])?></span>
                        <a href="#" class="modify" data-comment-id="<?=$comment['commentId']?>">수정</a>
                        <a href="#" class="delete" data-comment-id="<?=$comment['commentId']?>">삭제</a>
                    </span>
                    <p><?=$comment['commentMsg']?></p>
                </div>
            </div> 
    <?php }
    }
?>

                        <!-- <div class="comment__view">
                            <div class="avata"></div>
                            <div class="text">
                                <span>
                                    <span class="author">정유진</span>
                                    <span class="date">2023.10.30</span>
                                    <a href="#" class="modify">수정</a>
                                    <a href="#" class="delete">삭제</a>
                                </span>
                                <p>방가워뇽1!1!!!!!ㅁㄴ</p>
                            </div>
                        </div> -->

                        <div class="comment__input">
                            <form action="#">
                                <fieldset>
                                    <legend class="blind">댓글쓰기</legend>
                                    <label for="commentName" class="blind">이름</label>
                                    <input type="text" id="commentName" class="input__style" name="commentName" placeholder="이름" required>
                                    <label for="commentPass" class="blind">비밀번호</label>
                                    <input type="password" id="commentPass" class="input__style" name="commentPass" placeholder="비밀번호" required>
                                    <label for="commentWrite" class="blind">댓글쓰기</label>
                                    <input type="text" id="commentWrite" class="input__style" name="commentWrite" placeholder="댓글을 써주세요!" required>
                                    <button type="button" id="commentWriteBtn" class="btn__style2 mt10">댓글쓰기</button>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </section>

            </div>
            <div class="blog__aside">
                <?php include "blogAd.php" ?>
                <?php include "blogIntro.php" ?>
                <?php include "blogCategory.php" ?>
                <?php include "blogPopular.php" ?>
                <?php include "blogComment.php" ?>

            </div>
        </div>
    </main>
    <!-- //main -->

    <?php include "../include/footer.php" ?>
    <!-- //footer -->

    <div id="popupDelete" class="none">
        <div class="comment__delete">
            <h4>댓글 삭제</h4>
            <label for="commentDeletePass" class="blind">비밀번호</label>
            <input type="password" id="commentDeletePass" name="commentDeletePass" placeholder="비밀번호">
            <p>* 입력했던 비밀번호를 입력해주세요!</p>
            <div class="btn">
                <button id="commentDeleteCancel">취소</button>
                <button id="commentDeleteButton">삭제</button>
            </div>
        </div>
    </div>

    <div id="popupModify" class="none">
        <div class="comment__modify">
            <h4>댓글 수정</h4>
            <label for="commentModifyMsg" class="blind">비밀번호</label>
            <textarea name="commentModifyMsg" id="commentModifyMsg" rows="4" placeholder="수정할 내용을 적어주세요!"></textarea>
            <input type="password" id="commentModifyPass" name="commentModifyPass" placeholder="비밀번호">
            <p>* 입력했던 비밀번호를 입력해주세요!</p>
            <div class="btn">
                <button id="commentModifyCancel">취소</button>
                <button id="commentModifyButton">수정</button>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script>
        let commentId = "";

        // 댓글 쓰기 버튼
        $("#commentWriteBtn").click(function(){
            if($("#commentWrite").val() == ""){
                alert("댓글을 작성해주세요!");
                $("#commentWrite").focus();
            } else {
                $.ajax({
                    url: "blogCommentWrite.php",
                    method: "POST",
                    dataType: "json",
                    data: {
                        "blogId": <?=$blogId?>,
                        "memberId": <?=$memberId?>,
                        "name": $("#commentName").val(),
                        "pass": $("#commentPass").val(),
                        "msg": $("#commentWrite").val(),
                    },
                    success: function(data){
                        console.log(data);
                        location.reload();
                    },
                    error: function(request, status, error){
                        console.log("request" + request);
                        console.log("status" + status);
                        console.log("error" + error);
                    }
                })
            }
        });

        // 댓글 삭제 버튼
        $(".comment__view .delete").click(function(e){
            e.preventDefault();
            $("#popupDelete").removeClass("none");
            commentId = $(this).data("comment-id");
        });

        // 댓글 삭제 버튼 -> 취소버튼
        $("#commentDeleteCancel").click(function(){
            $("#popupDelete").addClass("none");
        });

        // 댓글 삭제 버튼 -> 삭제버튼
        $("#commentDeleteButton").click(function(){
            if($("#commentDeletePass").val() == ""){
                alert("댓글 작성시 비밀번호를 작성해주세요!");
                $("#commentDeletePass").focus();
            } else {
                $.ajax({
                    url: "blogCommentDelete.php",
                    method: "POST",
                    dataType: "json",
                    data: {
                        "commentPass": $("#commentDeletePass").val(),
                        "commentId": commentId,
                    },
                    success: function(data){
                        console.log(data);
                        if(data.result == "bad"){
                            alert("비밀번호가 일치하지 않습니다.");
                        } else {
                            alert("댓글이 삭제되었습니다.");
                        }
                        location.reload();
                    },
                    error: function(request, status, error){
                        console.log("request" + request);
                        console.log("status" + status);
                        console.log("error" + error);
                    }
                })
            }
        })


        // 댓글 수정 버튼
        $(".comment__view .modify").click(function(e){
            e.preventDefault();
            $("#popupModify").removeClass("none");
            commentId = $(this).data("comment-id");

            let commentMsg = $(this).closest(".comment__view").find("p").text();
            $("#commentModifyMsg").val(commentMsg);
        });

        // 댓글 수정 버튼 -> 취소버튼
        $("#commentModifyCancel").click(function(){
            $("#popupModify").addClass("none");
        });

        // 댓글 수정 버튼 -> 수정버튼
        $("#commentModifyButton").click(function(){
            if($("#commentModifyPass").val() == ""){
                alert("댓글 작성시 비밀번호를 작성해주세요!");
                $("#commentModifyPass").focus();
            } else {
                $.ajax({
                    url: "blogCommentModify.php",
                    method: "POST",
                    dataType: "json",
                    data: {
                        "commentMsg": $("#commentModifyMsg").val(),
                        "commentPass": $("#commentModifyPass").val(),
                        "commentId": commentId,
                    },
                    success: function(data){
                        console.log(data);
                        if(data.result == "bad"){
                            alert("비밀번호가 일치하지 않습니다.");
                        } else {
                            alert("댓글이 수정되었습니다.");
                        }
                        location.reload();
                    },
                    error: function(request, status, error){
                        console.log("request" + request);
                        console.log("status" + status);
                        console.log("error" + error);
                    }
                })
            }
        })
    </script>
</body>
</html>
