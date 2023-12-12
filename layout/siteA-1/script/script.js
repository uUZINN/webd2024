$(function(){
    let currentIndex = 0;
    $(".slider_wrap").append($(".slider").first().clone(true));

    setInterval(function(){
        currentIndex++;
        $(".slider_wrap").animate({marginLeft: -100 * currentIndex+"%"}, 600);

        if(currentIndex == 3){
            setTimeout(function(){
                $(".slider").animate({marginLeft: 0}, 0);
                currentIndex = 0;
            }, 600);
        }
    }, 3000);
    
    $("nav > ul > li").mouseover(function(){
        $(this).find(".submenu").stop().slideDown(200);
    });
    $("nav > ul > li").mouseleave(function(){
        $(this).find(".submenu").stop().slideUp(200);
    });

    const tabBtn = $(".tab_menu > a");
    const tabCont = $(".tab_cont > div");

    tabCont.hide().eq(0).show();

    tabBtn.click(function(){
        const index = $(this).index();

        $(this).addClass("active").siblings().removeClass("active");
        tabCont.eq(index).show().siblings().hide();
    });

    
});