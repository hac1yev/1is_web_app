const body = document.querySelector("body")
const menuOpen = document.querySelector('.checkbox')
const menuItems = document.querySelector('.menu-items')
const sunIcon = document.querySelector('.dark-mode')
// const moonIcon = document.querySelector('.moon')

// dropdown js
const select = document.querySelector(".select");
const caret = document.querySelector(".caret");
const menu = document.querySelector(".menu");
const options = document.querySelectorAll(".menu li");
const selected = document.querySelector(".selected");

select.addEventListener("click", () => {
  select.classList.toggle("select-clicked");
  caret.classList.toggle("caret-rotate");
  menu.classList.toggle("menu-open");
});

options.forEach((option) => {
  option.addEventListener("click", () => {
    selected.innerText = option.innerText;
    select.classList.remove("select-clicked");
    caret.classList.remove("caret-rotate");
    menu.classList.remove("menu-open");

    options.forEach((option) => {
      option.classList.remove("activee");
    });

    option.classList.add("activee");
  });
});


// swiper js
var swiper = new Swiper(".mySwiper", {
  spaceBetween: 30,
  slidesPerGroup: 1,
  loop: true,
  loopFillGroupWithBlank: true,
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  autoplay: {
    delay: 2000,
  },
  breakpoints: {
    640: {
      slidesPerView: 1,
      spaceBetween: 10
    },
    768: {
      slidesPerView: 2,
      spaceBetween: 20,
    },
    1024: {
      slidesPerView: 3,
      spaceBetween: 0,
    },
  },
});

menuOpen.addEventListener('click' , () => {
  menuItems.classList.toggle('menu-item-active')
})

sunIcon.addEventListener('click' , () => {
  darkMode()
})

function darkMode() {
  var setTheme = document.body;
  setTheme.classList.toggle("dark");

  var theme;
  if (setTheme.classList.contains("dark")) {
    theme = "DARK";
    
  } else {
    theme = "LIGHT";
  }

  localStorage.setItem("PageTheme", JSON.stringify(theme));
}

let GetTheme = JSON.parse(localStorage.getItem("PageTheme"));

if (GetTheme === "DARK") {
  document.body.classList = "dark";
  sunIcon.style.display = 'block'
}
else if(GetTheme === 'LIGHT'){
  // sunIcon.style.display = 'none'
  // moonIcon.style.display = 'block'
} 




