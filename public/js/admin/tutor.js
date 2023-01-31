
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
        menu_2[i].style.backgroundColor = '#fc941d93';
        menu_3[i].style.backgroundColor = '#fc941d93';

    });
}


for (let i = 0; i < menu_1.length; i++) {
    menu_2[i].addEventListener('click', function () {
        info_1[i].style.display = 'none';
        info_2[i].style.display = 'block';
        info_3[i].style.display = 'none';
        menu_1[i].style.backgroundColor = '#fc941d93';
        menu_2[i].style.backgroundColor = 'white';
        menu_3[i].style.backgroundColor = '#fc941d93';
    });
}


for (let i = 0; i < menu_1.length; i++) {
    menu_3[i].addEventListener('click', function () {
        info_1[i].style.display = 'none';
        info_2[i].style.display = 'none';
        info_3[i].style.display = 'block';
        menu_1[i].style.backgroundColor = '#fc941d93';
        menu_2[i].style.backgroundColor = '#fc941d93';
        menu_3[i].style.backgroundColor = 'white';
    });
}


// -------------------------HIDE SHOW BUTTON---------------------------------------

const btn = document.querySelectorAll('.btn');
const hide = document.querySelectorAll('.hide');
const show = document.querySelectorAll('.show');

for (let i = 0; i < hide.length; i++) {
    hide[i].addEventListener('click', function () {
        btn[i].style.left = '42px';
        btn[i].style.backgroundColor = 'red';
        btn[i].style.borderTopRightRadius = '30px';
        btn[i].style.borderBottomRightRadius = '30px';
        btn[i].style.borderTopLeftRadius = '0px';
        btn[i].style.borderBottomLeftRadius = '0px';
        hide[i].style.color = 'white';
    });
}

for (let i = 0; i < show.length; i++) {
    show[i].addEventListener('click', function () {
        btn[i].style.left = '0px';
        btn[i].style.backgroundColor = '#6ab04c';
        btn[i].style.borderTopRightRadius = '0px';
        btn[i].style.borderBottomRightRadius = '0px';
        btn[i].style.borderTopLeftRadius = '30px';
        btn[i].style.borderBottomLeftRadius = '30px';
        hide[i].style.color = 'black';
    });
}

// -------------------------CARD SHOW PROFILE BUTTON---------------------------------------

const profilePicture = document.querySelectorAll('.profile-picture');
const cardBlurEffect = document.querySelectorAll('.card-blur-effect');
const card = document.querySelectorAll('.card');
const viewProfileBtn = document.querySelectorAll('.view-profile-btn');



for (let i = 0; i < card.length; i++) {
    card[i].addEventListener('mouseenter', function () {
        cardBlurEffect[i].style.height = '59.5%';
        viewProfileBtn[i].style.zIndex = '10';
    });
}

for (let i = 0; i < card.length; i++) {
    card[i].addEventListener('mouseleave', function () {
        cardBlurEffect[i].style.height = '0%';
        viewProfileBtn[i].style.zIndex = '-1';
    });
}

// ------------------------- TUTOR VIEW PROFILE BUTTON  ---------------------------------------

const view_profile_btn = document.querySelectorAll('.view-profile-btn');

view_profile_btn.forEach((viewProfile) => {
    viewProfile.addEventListener('click', function () {
        console.log('clicked');
        const xhr = new XMLHttpRequest();
        xhr.open("GET", "viewTutorProfile", true);

        xhr.onload = function () {
            if (this.status === 200) {
                home.innerHTML = this.responseText;
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
        }

        xhr.send();
    })
})
