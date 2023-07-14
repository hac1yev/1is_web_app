$(".owl-carousel").owlCarousel({
    loop: true,
    autoplay:true,
    rewind: true,
    margin: 10,
    navText: ["<img src='https://1is-new.netlify.app/images/company-inner/company-inner-left.png' />","<img src='https://1is-new.netlify.app/images/company-inner/company-inner-right.png' />"],
    responsiveClass: true,
    responsive: {
      0: {
        items: 1,
        dots: true
      },
      468: {
        items: 2,
      },

      768: {
        items: 3,
      },
      1000: {
        items: 4,
        nav: true,
        loop: false,
      },
    },
  });



  var inner = document.querySelector('.inner');
//   var per = 83.33;
  inner.style.width = per + '%';



  