
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





const filterBtn = document.getElementById('filter');
const classConductModeFilter = document.querySelectorAll('.class-conduct-mode');
const cardSection = document.getElementById('card-section');
const visibilityFilter = document.querySelectorAll('.visibility-filter');

let classConductModeFilterValue = [];
let visibilityFilterValue = [];


function arrayRemove (arr, value) {
    return arr.filter(function (element) {
        return element != value;
    });
}


filterBtn.addEventListener('click', () => {
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


    console.log(classConductModeFilterValue, visibilityFilterValue);

    const xhttp = new XMLHttpRequest();
    xhttp.open('GET', `filterForStudentPage?classConductModeFilterValue=${classConductModeFilterValue}&visibilityFilterValue=${visibilityFilterValue}`, true);

    xhttp.onload = function () {
        if (this.status === 200) {
            cardSection.innerHTML = this.responseText;
        }
    }

    xhttp.send();

});