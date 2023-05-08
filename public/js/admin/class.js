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



// ====================== filter section js code ==================================

const allClasses = document.getElementById('all-classes');

const filterBtn = document.getElementById('filter');
const classConductMode = document.querySelectorAll('.class-conduct-mode');

const classFeesInputMax = document.querySelector('#class-fees-input-max');
const classFeesSliderMax = document.querySelector('#class-fees-slider-max');

const classSubject = document.querySelectorAll('.class-subject');

const classRating = document.querySelectorAll('.class-rating');
const searchClasses = document.getElementById('search-classes');

const cardSection = document.getElementById('card-section');


let completionStatusFilterValue = [];
let classFeesInputField = [];
let classFeesSliderField = [];
let selectedSubject = [];
let selectedRating = [];

function arrayRemove (arr, value) {
    return arr.filter(function (element) {
        return element != value;
    });
}



classFeesInputMax.addEventListener('input', function () {
    let classFeesInputMaxValue = classFeesInputMax.value;

    console.log(classFeesInputMaxValue);

    const xhr = new XMLHttpRequest();
    xhr.open('GET', `filterForClassPage?classFeesInputMaxValue=${classFeesInputMaxValue}&ratingFilterValue=${ratingFilterValue}&completionStatusFilterValue=${completionStatusFilterValue}&subjectFilterValue=${subjectFilterValue}`, true);

    xhr.onload = function () {
        if (this.status === 200) {
            allClasses.innerHTML = this.responseText;
        }
    }

    xhr.send();
});


classFeesSliderMax.addEventListener('input', function () {
    let classFeesInputMaxValue = classFeesInputMax.value;

    console.log(classFeesInputMaxValue);

    const xhr = new XMLHttpRequest();
    xhr.open('GET', `filterForClassPage?classFeesInputMaxValue=${classFeesInputMaxValue}&ratingFilterValue=${ratingFilterValue}&completionStatusFilterValue=${completionStatusFilterValue}&subjectFilterValue=${subjectFilterValue}`, true);

    xhr.onload = function () {
        if (this.status === 200) {
            allClasses.innerHTML = this.responseText;
        }
    }

    xhr.send();
});


const checkboxes = document.querySelectorAll('input[type="checkbox"]');
var selectedValues = [];
var ratingFilterValue = [];
var classConductModeFilterValue = [];
var subjectFilterValue = [];


// let searchClassValue = searchClasses.value.toLowerCase();
// let classFeesInputMaxValue = classFeesInputMax.value;

// console.log(searchClassValue, classFeesInputMaxValue);

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

        // let searchClassValue = searchClasses.value.toLowerCase();
        let classFeesInputMaxValue = classFeesInputMax.value;


        ratingFilterValue = selectedValues.filter(value => value === '1' || value === '2' || value === '3' || value === '4' || value === '5');
        completionStatusFilterValue = selectedValues.filter(value => value === 'active' || value === 'complete');
        subjectFilterValue = selectedValues.filter(value => value !== 'active' && value !== 'complete' && value !== '1' && value !== '2' && value !== '3' && value !== '4' && value !== '5');


        console.log(classFeesInputMaxValue, ratingFilterValue, completionStatusFilterValue, subjectFilterValue);

        const xhr = new XMLHttpRequest();
        xhr.open('GET', `filterForClassPage?classFeesInputMaxValue=${classFeesInputMaxValue}&ratingFilterValue=${ratingFilterValue}&completionStatusFilterValue=${completionStatusFilterValue}&subjectFilterValue=${subjectFilterValue}`, true);

        xhr.onload = function () {
            if (this.status === 200) {
                allClasses.innerHTML = this.responseText;
            }
        }

        xhr.send();
    });
}

