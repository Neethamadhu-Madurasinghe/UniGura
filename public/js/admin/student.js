
// *========================================== STUDENT PAGE ===========================================================


const body = document.querySelector('body'),
    sidebar = body.querySelector('nav'),
    toggle = body.querySelector(".toggle"),
    searchBtn = body.querySelector(".search-box"),
    modeSwitch = body.querySelector(".toggle-switch"),
    modeText = body.querySelector(".mode-text");






const student = document.getElementById("student");
const nav_link = document.querySelectorAll(".nav-link");

nav_link.forEach((link) => {
    link.classList.remove('active');
})

student.classList.add('active');



// ------------------------- FILTER & SEARCH SELECTION ---------------------------------------


const classConductModeFilter = document.querySelectorAll('.class-conduct-mode');
const cardSection = document.getElementById('card-section');
const visibilityFilter = document.querySelectorAll('.student-visibility-filter');
const searchStudent = document.getElementById('searchStudent');


let classConductModeFilterValue = [];
let visibilityFilterValue = [];


function arrayRemove (arr, value) {
    return arr.filter(function (element) {
        return element != value;
    });
}

const checkboxes = document.querySelectorAll('input[type="checkbox"]');
var selectedValues = [];


searchStudent.addEventListener('keyup', function () {
    let searchStudentName = searchStudent.value.toLowerCase();

    const xhr = new XMLHttpRequest();
    xhr.open('GET', `filterForStudentPage?classConductModeFilterValue=${classConductModeFilterValue}&visibilityFilterValue=${visibilityFilterValue}&searchStudentName=${searchStudentName}`, true);

    xhr.onload = function () {
        if (this.status === 200) {
            cardSection.innerHTML = this.responseText;
        }
    }

    xhr.send();
})



for (var i = 0; i < checkboxes.length; i++) {
    checkboxes[i].addEventListener('click', function () {
        if (this.checked) {
            selectedValues.push(this.value);
        } else {
            var index = selectedValues.indexOf(this.value);
            if (index !== -1) {
                selectedValues.splice(index, 1);
            }
        }

        let searchStudentName = searchStudent.value.toLowerCase();


        classConductModeFilterValue = selectedValues.filter(values => values === 'online' || values === 'physical' || values === 'both');
        visibilityFilterValue = selectedValues.filter(values => values === 'block' || values === 'unblock');

        console.log(searchStudentName,classConductModeFilterValue, visibilityFilterValue);

        const xhr = new XMLHttpRequest();
        xhr.open('GET', `filterForStudentPage?classConductModeFilterValue=${classConductModeFilterValue}&visibilityFilterValue=${visibilityFilterValue}&searchStudentName=${searchStudentName}`, true);

        xhr.onload = function () {
            if (this.status === 200) {
                cardSection.innerHTML = this.responseText;
            }
        }

        xhr.send();
    });
}
