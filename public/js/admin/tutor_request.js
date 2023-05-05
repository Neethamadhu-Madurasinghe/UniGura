const body = document.querySelector('body'),
    sidebar = body.querySelector('nav'),
    toggle = body.querySelector(".toggle"),
    searchBtn = body.querySelector(".search-box"),
    modeSwitch = body.querySelector(".toggle-switch"),
    modeText = body.querySelector(".mode-text");






const request_complaint = document.getElementById('request-complaint');
const nav_link = document.querySelectorAll(".nav-link");


nav_link.forEach((link) => {
    link.classList.remove('active');
})

request_complaint.classList.add('active');



/* ---------------------------------- active button ---------------------------- */

const tutor_request_btn = document.getElementById('tutor-request');

tutor_request_btn.style.background = "linear-gradient(180deg, #FFA620 0%, #FF7A20 100%)";
