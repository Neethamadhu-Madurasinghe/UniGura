// *========================================== SATANISTIC PAGE ===========================================================


const body = document.querySelector('body'),
    sidebar = body.querySelector('nav'),
    toggle = body.querySelector(".toggle"),
    searchBtn = body.querySelector(".search-box"),
    modeSwitch = body.querySelector(".toggle-switch"),
    modeText = body.querySelector(".mode-text");




const statistic = document.getElementById("statistic");
const nav_link = document.querySelectorAll(".nav-link");

nav_link.forEach((link) => {
    link.classList.remove('active');
})

statistic.classList.add('active');

