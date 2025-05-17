

$(function () {
  //ハンバーガーメニュー
  $(".openbtn").click(function () {
    $(this).toggleClass("active");
    $(".header__nav").toggleClass("active");
    $(".hamburger__cover").toggleClass("active");
  });

  //ハンバーガーメニュー　同ページのアンカーに飛んでも表示消す
  $(".header__nav ul li a").click(function () {
    $(".openbtn").removeClass("active");
    $(".header__nav").removeClass("active");
    $(".hamburger__cover").removeClass("active");
  });
});



  
  //クリックした際の動き
  $(".scroll-top a").click(function () {
    var elmHash = $(this).attr("href");
    if (elmHash == "#about") {
      var pos = $(elmHash).offset().top;
      $("body,html").animate({ scrollTop: pos }, pos);
    } else {
      $("body,html").animate({ scrollTop: 0 }, 500);
    }
    return false;
  });
  
  $(window).scroll(function () {
    $("#fadeIn-img, #fadeIn-img2, #fadeIn-img3, #fadeIn-img4, #fadeIn-img5, #fadeIn-img6, #fadeIn-img7, #fadeIn-img8, #fadeIn-img9").each(function () {
      var position = $(this).offset().top;
      var scroll = $(window).scrollTop();
      var windowHeight = $(window).height();
      if (scroll > position - windowHeight + 100) {
        $(this).addClass("active");
      }
    });
  });

  $(window).scroll(function () {
    $("#fadeIn-text, #fadeIn-text2,#fadeIn-text3, #fadeIn-text4, #fadeIn-text5, #fadeIn-text6, #fadeIn-text7").each(function () {
      var position = $(this).offset().top;
      var scroll = $(window).scrollTop();
      var windowHeight = $(window).height();
      if (scroll > position - windowHeight + 100) {
        $(this).addClass("active");
      }
    });
  });

  $(window).scroll(function () {
    $("#fadeIn-box, #fadeIn-box2, #fadeIn-box3, #fadeIn-box4").each(function () {
      var position = $(this).offset().top;
      var scroll = $(window).scrollTop();
      var windowHeight = $(window).height();
      if (scroll > position - windowHeight + 100) {
        $(this).addClass("active");
      }
    });
  });
