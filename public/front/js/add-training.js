const training_icon1 = document.querySelector('#training_icon1');
const training_icon2 = document.querySelector('#training_icon2');
const training_icon3 = document.querySelector('#training_icon3');

const trending_nav_link1 = document.querySelector('.trending-nav-link1');
const trending_nav_link2 = document.querySelector('.trending-nav-link2');
const trending_nav_link3 = document.querySelector('.trending-nav-link3');

trending_nav_link1.addEventListener('click', () => {
    if(trending_nav_link2.classList.contains('active') || trending_nav_link3.classList.contains('active')) {
        if(document.body.classList.contains('dark')) {
            training_icon1.src = 'https://1is.butagrup.az/back/assets/images/icons/add-training-white.png';
            training_icon2.src = 'https://1is.butagrup.az/back/assets/images/icons/training-list-purple1.png';
            training_icon3.src = 'https://1is.butagrup.az/back/assets/images/icons/training-list-purple1.png';
        }else {
            training_icon1.src = 'https://1is.butagrup.az/back/assets/images/icons/add-training-white.png';
            training_icon2.src = 'https://1is.butagrup.az/back/assets/images/icons/training-list-purple1.png';
            training_icon3.src = 'https://1is.butagrup.az/back/assets/images/icons/training-list-purple1.png';
        }
    }
});

trending_nav_link2.addEventListener('click', () => {
    if(trending_nav_link1.classList.contains('active') || trending_nav_link3.classList.contains('active')) {
        if(document.body.classList.contains('dark')) {
            training_icon2.src = 'https://1is.butagrup.az/back/assets/images/icons/training-list-white.png';
            training_icon3.src = 'https://1is.butagrup.az/back/assets/images/icons/training-list-purple1.png';
            training_icon1.src = 'https://1is.butagrup.az/back/assets/images/icons/add-training-purple.png';
        }else {
            training_icon2.src = 'https://1is.butagrup.az/back/assets/images/icons/training-list-white.png';
            training_icon3.src = 'https://1is.butagrup.az/back/assets/images/icons/training-list-purple1.png';
            training_icon1.src = 'https://1is.butagrup.az/back/assets/images/icons/add-training-purple.png';
        }
    } 
});
trending_nav_link3.addEventListener('click', () => {
    if(trending_nav_link1.classList.contains('active') || trending_nav_link2.classList.contains('active')) {
        if(document.body.classList.contains('dark')) {
            training_icon3.src = 'https://1is.butagrup.az/back/assets/images/icons/training-list-white.png';
            training_icon2.src = 'https://1is.butagrup.az/back/assets/images/icons/training-list-purple1.png';
            training_icon1.src = 'https://1is.butagrup.az/back/assets/images/icons/add-training-purple.png';
        }else {
            training_icon3.src = 'https://1is.butagrup.az/back/assets/images/icons/training-list-white.png';
            training_icon2.src = 'https://1is.butagrup.az/back/assets/images/icons/training-list-purple1.png';
            training_icon1.src = 'https://1is.butagrup.az/back/assets/images/icons/add-training-purple.png';
        }
    } 
});