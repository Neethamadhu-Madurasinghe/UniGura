const body = document.querySelector('body'),
    sidebar = body.querySelector('nav'),
    toggle = body.querySelector(".toggle"),
    searchBtn = body.querySelector(".search-box"),
    modeSwitch = body.querySelector(".toggle-switch"),
    modeText = body.querySelector(".mode-text");


const complaint = document.getElementById('complaint');
const nav_link = document.querySelectorAll(".nav-link");


nav_link.forEach((link) => {
    link.classList.remove('active');
})

complaint.classList.add('active');
