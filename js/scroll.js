$(document).ready(function(){
  $("a[href*=#]").on("click", function(e){
    var anchor = target;
    $('html, body').stop().animate({
      scrollTop: $(anchor.attr('href')).offset().top
    }, 777);
    e.preventDefault();
    return false;
  });
  var buyBtns = document.querySelectorAll('.card-product .btn-buy');
  buyBtns.forEach( item => {
    item.addEventListener('click', function (e) {
      $('html, body').stop().animate({
        scrollTop: $('#where-buy').offset().top
      }, 777);
      e.preventDefault();
      return false;
    })
  })
});