
// *========================================== TUTOR PAGE ===========================================================


const body = document.querySelector('body'),
    sidebar = body.querySelector('nav'),
    toggle = body.querySelector(".toggle"),
    searchBtn = body.querySelector(".search-box"),
    modeSwitch = body.querySelector(".toggle-switch"),
    modeText = body.querySelector(".mode-text");



const tutor = document.getElementById("tutor");
const nav_link = document.querySelectorAll(".nav-link");


nav_link.forEach((link) => {
    link.classList.remove('active');
})

tutor.classList.add('active');




// ------------------------- FILTER & SEARCH SELECTION ---------------------------------------

const cardSection = document.getElementById('card-section');
const searchTutor = document.getElementById('searchTutor');


let classConductModeFilterValue = [];
let visibilityFilterValue = [];
let permissionFilterValue = [];
let tutorDurationFilterValue = [];


function arrayRemove (arr, value) {
    return arr.filter(function (element) {
        return element != value;
    });
}

const checkboxes = document.querySelectorAll('input[type="checkbox"]');
var selectedValues = [];


searchTutor.addEventListener('keyup', function () {
    let searchTutorName = searchTutor.value.toLowerCase();

    const xhr = new XMLHttpRequest();
    xhr.open('GET', `filterForTutorPage?classConductModeFilterValue=${classConductModeFilterValue}&visibilityFilterValue=${visibilityFilterValue}&permissionFilterValue=${permissionFilterValue}&tutorDurationFilterValue=${tutorDurationFilterValue}&searchTutorName=${searchTutorName}`, true);

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

        let searchTutorName = searchTutor.value.toLowerCase();


        classConductModeFilterValue = selectedValues.filter(value => value === 'both' || value === 'online' || value === 'physical');
        visibilityFilterValue = selectedValues.filter(value => value === 'show' || value === 'hide');
        permissionFilterValue = selectedValues.filter(value => value === 'unblock' || value === 'block');
        tutorDurationFilterValue = selectedValues.filter(value => value === '1' || value === '2' || value === '3' || value === '4');

        console.log(classConductModeFilterValue, visibilityFilterValue, permissionFilterValue, tutorDurationFilterValue);

        const xhr = new XMLHttpRequest();
        xhr.open('GET', `filterForTutorPage?classConductModeFilterValue=${classConductModeFilterValue}&visibilityFilterValue=${visibilityFilterValue}&permissionFilterValue=${permissionFilterValue}&tutorDurationFilterValue=${tutorDurationFilterValue}&searchTutorName=${searchTutorName}`, true);

        xhr.onload = function () {
            if (this.status === 200) {
                cardSection.innerHTML = this.responseText;
            }
        }

        xhr.send();
    });
}

