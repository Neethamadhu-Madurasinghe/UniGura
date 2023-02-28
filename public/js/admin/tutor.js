
// *========================================== TUTOR PAGE ===========================================================


console.log("tutor.js loaded");

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





const tutor = document.getElementById("tutor");
const nav_link = document.querySelectorAll(".nav-link");


nav_link.forEach((link) => {
    link.classList.remove('active');
})

tutor.classList.add('active');



const menu_1 = document.getElementsByClassName('menu-1');
const menu_2 = document.getElementsByClassName('menu-2');
const menu_3 = document.getElementsByClassName('menu-3');

const info_1 = document.getElementsByClassName('info-1');
const info_2 = document.getElementsByClassName('info-2');
const info_3 = document.getElementsByClassName('info-3');


for (let i = 0; i < menu_1.length; i++) {
    info_1[i].style.display = 'block';
    info_2[i].style.display = 'none';
    info_3[i].style.display = 'none';
}

for (let i = 0; i < menu_1.length; i++) {
    menu_1[i].style.backgroundColor = 'white';
}


for (let i = 0; i < menu_1.length; i++) {
    menu_1[i].addEventListener('click', function () {
        info_1[i].style.display = 'block';
        info_2[i].style.display = 'none';
        info_3[i].style.display = 'none';
        menu_1[i].style.backgroundColor = 'white';
        menu_2[i].style.backgroundColor = '#fbc36e';
        menu_3[i].style.backgroundColor = '#fbc36e';

    });
}


for (let i = 0; i < menu_1.length; i++) {
    menu_2[i].addEventListener('click', function () {
        info_1[i].style.display = 'none';
        info_2[i].style.display = 'block';
        info_3[i].style.display = 'none';
        menu_1[i].style.backgroundColor = '#fbc36e';
        menu_2[i].style.backgroundColor = 'white';
        menu_3[i].style.backgroundColor = '#fbc36e';
    });
}


for (let i = 0; i < menu_1.length; i++) {
    menu_3[i].addEventListener('click', function () {
        info_1[i].style.display = 'none';
        info_2[i].style.display = 'none';
        info_3[i].style.display = 'block';
        menu_1[i].style.backgroundColor = '#fbc36e';
        menu_2[i].style.backgroundColor = '#fbc36e';
        menu_3[i].style.backgroundColor = 'white';
    });
}



// -------------------------CARD SHOW PROFILE BUTTON---------------------------------------

const profilePicture = document.querySelectorAll('.profile-picture');
const cardBlurEffect = document.querySelectorAll('.card-blur-effect');
const card = document.querySelectorAll('.card');
const viewProfileBtn = document.querySelectorAll('.view-profile-btn');



for (let i = 0; i < card.length; i++) {
    card[i].addEventListener('mouseenter', function () {
        cardBlurEffect[i].style.height = '70%';
        viewProfileBtn[i].style.zIndex = '10';
        card[i].style.backgroundColor = '#fbc36e';
    });
}

for (let i = 0; i < card.length; i++) {
    card[i].addEventListener('mouseleave', function () {
        cardBlurEffect[i].style.height = '0%';
        viewProfileBtn[i].style.zIndex = '-1';
        card[i].style.backgroundColor = '#fbc36e';

    });
}





// --------------------MENU SELECTION----------------------------------------

const finished_classes = document.querySelectorAll('.finished-classes');
const active_classes = document.querySelectorAll('.active-classes');
const tutor_info = document.querySelectorAll('.tutor-info');


const info_btn = document.querySelectorAll('.info-btn');
const active_class_btn = document.querySelectorAll('.active-class-btn');
const finished_class_btn = document.querySelectorAll('.finished-class-btn');


tutor_info[0].style.display = 'flex';

info_btn[0].addEventListener('click', function () {
    tutor_info[0].style.display = 'flex';
    active_classes[0].style.display = 'none';
    finished_classes[0].style.display = 'none';
});

active_class_btn[0].addEventListener('click', function () {
    tutor_info[0].style.display = 'none';
    active_classes[0].style.display = 'grid';
    finished_classes[0].style.display = 'none';
});

finished_class_btn[0].addEventListener('click', function () {
    tutor_info[0].style.display = 'none';
    active_classes[0].style.display = 'none';
    finished_classes[0].style.display = 'grid';
});

