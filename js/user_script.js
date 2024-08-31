let profile = document.querySelector('.header .flex .profile-detail');
document.querySelector('#user-btn').onclick = () => {
    profile.classList.toggle('active');
    searchForm.classList.remove('active');
}

let searchForm = document.querySelector('.header .flex .search-form');
document.querySelector('#search-btn').onclick = () => {
    searchForm.classList.toggle('active');
    profile.classList.remove('active');
}

let navbar = document.querySelector('.navbar');
document.querySelector('#menu-btn').onclick = () => {
    navbar.classList.toggle('active');
}

/* ----------------------------------------home slider---------------------------------------- */

const imgBox = document.querySelector('.slider-container');
const slides = document.getElementsByClassName('slideBox');

var i = 0;

function nextSlider() {
    slides[i].classList.remove('active');
    i = (i + 1) % slides.length;
    slides[i].classList.add('active');
}

function prevSlider() {
    slides[i].classList.remove('active');
    i = (i - 1 + slides.length) % slides.length;
    slides[i].classList.add('active');
}

/* ----------------------------------------testimonial---------------------------------------- */
const btn = document.getElementsByClassName('btn1');
const slide = document.getElementById('slide');

btn[0].onclick = function () {
    slide.style.transform = 'translateX(0px)';
    for (var i = 0; i < 4; i++) {
        btn[i].classList.remove('active');
    }
    this.classList.add('active');
}
btn[1].onclick = function () {
    slide.style.transform = 'translateX(-800px)';
    for (var i = 0; i < 4; i++) {
        btn[i].classList.remove('active');
    }
    this.classList.add('active');
}
btn[2].onclick = function () {
    slide.style.transform = 'translateX(-1600px)';
    for (var i = 0; i < 4; i++) {
        btn[i].classList.remove('active');
    }
    this.classList.add('active');
}
btn[3].onclick = function () {
    slide.style.transform = 'translateX(-2400px)';
    for (var i = 0; i < 4; i++) {
        btn[i].classList.remove('active');
    }
    this.classList.add('active');
}