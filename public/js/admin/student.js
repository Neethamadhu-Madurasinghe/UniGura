
// *========================================== STUDENT PAGE ===========================================================

console.log("student.js loaded");

const body = document.querySelector('body'),
    sidebar = body.querySelector('nav'),
    toggle = body.querySelector(".toggle"),
    searchBtn = body.querySelector(".search-box"),
    modeSwitch = body.querySelector(".toggle-switch"),
    modeText = body.querySelector(".mode-text");


const image = document.getElementById("image");


toggle.addEventListener("click", () => {
    sidebar.classList.toggle("close");

    image.src = "images/without-logo.png";
    image.style.width = "50px";
})




const student = document.getElementById("student");
const nav_link = document.querySelectorAll(".nav-link");


nav_link.forEach((link) => {
    link.classList.remove('active');
})

student.classList.add('active');





// --------------------MENU SELECTION----------------------------------------

const finished_classes = document.querySelectorAll('.finished-classes');
const active_classes = document.querySelectorAll('.active-classes');
const student_info = document.querySelectorAll('.student-info');


const info_btn = document.querySelectorAll('.info-btn');
const active_class_btn = document.querySelectorAll('.active-class-btn');
const finished_class_btn = document.querySelectorAll('.finished-class-btn');


student_info[0].style.display = 'flex';

info_btn[0].addEventListener('click', function () {
    student_info[0].style.display = 'flex';
    active_classes[0].style.display = 'none';
    finished_classes[0].style.display = 'none';
});

active_class_btn[0].addEventListener('click', function () {
    student_info[0].style.display = 'none';
    active_classes[0].style.display = 'grid';
    finished_classes[0].style.display = 'none';
});

finished_class_btn[0].addEventListener('click', function () {
    student_info[0].style.display = 'none';
    active_classes[0].style.display = 'none';
    finished_classes[0].style.display = 'grid';
});



