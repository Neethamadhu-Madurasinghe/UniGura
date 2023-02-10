
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






const filterBtn = document.getElementById('filter');
const classConductModeFilter = document.querySelectorAll('.class-conduct-mode');
const cardSection = document.getElementById('card-section');
const visibilityFilter = document.querySelectorAll('.visibility-filter');
const searchStudent = document.getElementById('searchStudent');

let classConductModeFilterValue = [];
let visibilityFilterValue = [];


function arrayRemove (arr, value) {
    return arr.filter(function (element) {
        return element != value;
    });
}


filterBtn.addEventListener('click', () => {
    let searchStudentName = searchStudent.value.toLowerCase();

    for (let i = 0; i < classConductModeFilter.length; i++) {
        if (classConductModeFilter[i].checked == true) {
            classConductModeFilterValue.push(classConductModeFilter[i].value);
        }
        if (classConductModeFilter[i].checked == false) {
            classConductModeFilterValue = arrayRemove(classConductModeFilterValue, classConductModeFilter[i].value);
        }
    }

    for (let i = 0; i < visibilityFilter.length; i++) {
        if (visibilityFilter[i].checked == true) {
            visibilityFilterValue.push(visibilityFilter[i].value);
        }
        if (visibilityFilter[i].checked == false) {
            visibilityFilterValue = arrayRemove(visibilityFilterValue, visibilityFilter[i].value);
        }
    }


    let uniqueClassModes = [...new Set(classConductModeFilterValue)];
    classConductModeFilterValue = uniqueClassModes;

    let uniqueVisibility = [...new Set(visibilityFilterValue)];
    visibilityFilterValue = uniqueVisibility;


    console.log(classConductModeFilterValue, visibilityFilterValue, searchStudentName);

    const xhttp = new XMLHttpRequest();
    xhttp.open('GET', `filterForStudentPage?classConductModeFilterValue=${classConductModeFilterValue}&visibilityFilterValue=${visibilityFilterValue}$searchStudentName=${searchStudentName}`, true);

    xhttp.onload = function () {
        if (this.status === 200) {
            cardSection.innerHTML = this.responseText;
        }
    }

    xhttp.send();

});



