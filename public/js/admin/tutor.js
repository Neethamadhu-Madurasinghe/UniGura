
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


// menuSelection();

// function menuSelection () {

//     const menu_1 = document.getElementsByClassName('menu-1');
//     const menu_2 = document.getElementsByClassName('menu-2');
//     const menu_3 = document.getElementsByClassName('menu-3');

//     const info_1 = document.getElementsByClassName('info-1');
//     const info_2 = document.getElementsByClassName('info-2');
//     const info_3 = document.getElementsByClassName('info-3');


//     for (let i = 0; i < menu_1.length; i++) {
//         info_1[i].style.display = 'block';
//         info_2[i].style.display = 'none';
//         info_3[i].style.display = 'none';
//     }

//     for (let i = 0; i < menu_1.length; i++) {
//         menu_1[i].style.backgroundColor = 'white';
//     }


//     for (let i = 0; i < menu_1.length; i++) {
//         menu_1[i].addEventListener('click', function () {
//             info_1[i].style.display = 'block';
//             info_2[i].style.display = 'none';
//             info_3[i].style.display = 'none';
//             menu_1[i].style.backgroundColor = 'white';
//             menu_2[i].style.backgroundColor = '#ffb75e';
//             menu_3[i].style.backgroundColor = '#ffb75e';

//         });
//     }


//     for (let i = 0; i < menu_1.length; i++) {
//         menu_2[i].addEventListener('click', function () {
//             info_1[i].style.display = 'none';
//             info_2[i].style.display = 'block';
//             info_3[i].style.display = 'none';
//             menu_1[i].style.backgroundColor = '#ffb75e';
//             menu_2[i].style.backgroundColor = 'white';
//             menu_3[i].style.backgroundColor = '#ffb75e';
//         });
//     }


//     for (let i = 0; i < menu_1.length; i++) {
//         menu_3[i].addEventListener('click', function () {
//             info_1[i].style.display = 'none';
//             info_2[i].style.display = 'none';
//             info_3[i].style.display = 'block';
//             menu_1[i].style.backgroundColor = '#ffb75e';
//             menu_2[i].style.backgroundColor = '#ffb75e';
//             menu_3[i].style.backgroundColor = 'white';
//         });
//     }

// }



// ------------------------- FILTER & SEARCH SELECTION ---------------------------------------

const cardSection = document.getElementById('card-section');
const searchTutor = document.getElementById('searchTutor');


let classConductModeFilterValue = [];
let visibilityFilterValue = [];
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
    xhr.open('GET', `filterForTutorPage?classConductModeFilterValue=${classConductModeFilterValue}&visibilityFilterValue=${visibilityFilterValue}&tutorDurationFilterValue=${tutorDurationFilterValue}&searchTutorName=${searchTutorName}`, true);

    xhr.onload = function () {
        if (this.status === 200) {
            cardSection.innerHTML = this.responseText;
        }
        showProfileBtn();
        menuSelection();
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
        visibilityFilterValue = selectedValues.filter(value => value === 'show' || value === 'hide' || value === 'unblock' || value === 'block');
        tutorDurationFilterValue = selectedValues.filter(value => value === '1' || value === '2' || value === '3' || value === '4');

        console.log(classConductModeFilterValue, visibilityFilterValue, tutorDurationFilterValue);

        const xhr = new XMLHttpRequest();
        xhr.open('GET', `filterForTutorPage?classConductModeFilterValue=${classConductModeFilterValue}&visibilityFilterValue=${visibilityFilterValue}&tutorDurationFilterValue=${tutorDurationFilterValue}&searchTutorName=${searchTutorName}`, true);

        xhr.onload = function () {
            if (this.status === 200) {
                cardSection.innerHTML = this.responseText;
            }
            showProfileBtn();
            menuSelection();
        }

        xhr.send();
    });
}





// // -------------------------CARD SHOW PROFILE BUTTON---------------------------------------

// showProfileBtn();

// function showProfileBtn () {
//     const profilePicture = document.querySelectorAll('.profile-picture');
//     const cardBlurEffect = document.querySelectorAll('.card-blur-effect');
//     const card = document.querySelectorAll('.card');
//     const viewProfileBtn = document.querySelectorAll('.view-profile-btn');



//     for (let i = 0; i < card.length; i++) {
//         card[i].addEventListener('mouseenter', function () {
//             cardBlurEffect[i].style.height = '70%';
//             viewProfileBtn[i].style.zIndex = '10';
//             card[i].style.backgroundColor = '#ffb75e';
//         });
//     }

//     for (let i = 0; i < card.length; i++) {
//         card[i].addEventListener('mouseleave', function () {
//             cardBlurEffect[i].style.height = '0%';
//             viewProfileBtn[i].style.zIndex = '-1';
//             card[i].style.backgroundColor = '#ffb75e';

//         });
//     }

// }


