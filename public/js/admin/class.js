console.log("class.js loaded");

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





const class_ = document.getElementById("class");
const nav_link = document.querySelectorAll(".nav-link");



nav_link.forEach((link) => {
    link.classList.remove('active');
})

class_.classList.add('active');





// ====================== filter section js code ==================================

const rangeInput = document.querySelectorAll(".range-input input")
const priceInput = document.querySelectorAll(".price-input input")
const range = document.querySelector(".slider .progress");


priceInput.forEach(input => {
    input.addEventListener("input", e => {
        let maxPrice = parseInt(priceInput[1].value);

        rangeInput[0].value = maxPrice;
        range.style.right = 100 - (maxPrice / rangeInput[0].max) * 100 + "%";
    });
});


rangeInput.forEach(input => {
    input.addEventListener("input", e => {
        let maxVal = parseInt(rangeInput[0].value);

        priceInput[1].value = maxVal;
        range.style.right = 100 - (maxVal / rangeInput[0].max) * 100 + "%";
    });
});


// ====================== RESET FILTER ==================================

const filterResetBtn = document.getElementById("filter-reset-btn");

filterResetBtn.addEventListener("click", () => {

    loadClass();
});



// ====================== filter section js code ==================================

const allClasses = document.getElementById('all-classes');

const filterBtn = document.getElementById('filter');
const classConductMode = document.querySelectorAll('.class-conduct-mode');

const classFeesSliderMin = document.querySelector('#class-fees-slider-min');
const classFeesSliderMax = document.querySelector('#class-fees-slider-max');
const classFeesInputMin = document.querySelector('#class-fees-input-min');
const classFeesInputMax = document.querySelector('#class-fees-input-max');

const classSubject = document.querySelectorAll('.class-subject');

const classRating = document.querySelectorAll('.class-rating');
const searchClasses = document.getElementById('search-classes');

var classConductModeValue = [];
var classFeesInputField = [];
var classFeesSliderField = [];
var selectedSubject = [];
var selectedRating = [];

function arrayRemove (arr, value) {
    return arr.filter(function (element) {
        return element != value;
    });
}

filterBtn.addEventListener('click', () => {
    for (let i = 0; i < classConductMode.length; i++) {
        if (classConductMode[i].checked == true) {
            classConductModeValue.push(classConductMode[i].value);
        }
        if (classConductMode[i].checked == false) {
            classConductModeValue = arrayRemove(classConductModeValue, classConductMode[i].value);
        }
    }

    for (let i = 0; i < classSubject.length; i++) {
        if (classSubject[i].checked == true) {
            selectedSubject.push(classSubject[i].value);
        }
        if (classSubject[i].checked == false) {
            selectedSubject = arrayRemove(selectedSubject, classSubject[i].value);
        }
    }

    for (let i = 0; i < classRating.length; i++) {
        if (classRating[i].checked == true) {
            selectedRating.push(classRating[i].value);
        }
        if (classRating[i].checked == false) {
            selectedRating = arrayRemove(selectedRating, classRating[i].value);
        }
    }



    var uniqueClassModes = [...new Set(classConductModeValue)];
    classConductModeValue = uniqueClassModes;

    var uniqueSubjects = [...new Set(selectedSubject)];
    selectedSubject = uniqueSubjects;


    const minInputFees = classFeesInputMin.value;
    const maxInputFees = classFeesInputMax.value;


    classFeesInputField = [];
    classFeesInputField.push(minInputFees);
    classFeesInputField.push(maxInputFees);

    // const minSliderFees = classFeesSliderMin.value;
    const maxSliderFees = classFeesSliderMax.value;

    classFeesSliderField = [];
    // classFeesSliderField.push(minSliderFees);
    classFeesSliderField.push(maxSliderFees);

    $searchResult = searchClasses.value;

    console.log(classConductModeValue, classFeesSliderField, selectedSubject, selectedRating);


    const xhttp = new XMLHttpRequest();
    xhttp.open('GET', `filter?classConductModeValue=${classConductModeValue}&classFeesInputField=${classFeesInputField}&classFeesSliderField=${classFeesSliderField}&selectedSubject=${selectedSubject}&selectedRating=${selectedRating}&searchResult=${$searchResult}`, true);

    xhttp.onload = function () {
        if (this.status === 200) {
            allClasses.innerHTML = this.responseText;
        }
    }
    xhttp.send();
});
