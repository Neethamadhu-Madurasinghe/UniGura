
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




// --------------------MENU SELECTION( fro tutor profile page)----------------------------------------

menuSelection();

function menuSelection () {
    const finished_classes = document.querySelectorAll('.finished-classes');
    const active_classes = document.querySelectorAll('.active-classes');
    const tutor_info = document.querySelectorAll('.tutor-info');


    const info_btn = document.querySelectorAll('.info-btn');
    const active_class_btn = document.querySelectorAll('.active-class-btn');
    const finished_class_btn = document.querySelectorAll('.finished-class-btn');


    tutor_info[0].style.display = 'flex';
    info_btn[0].style.background = "linear-gradient(180deg, #FFA620 0%, #FF7A20 100%)";


    info_btn[0].addEventListener('click', function () {
        tutor_info[0].style.display = 'flex';
        active_classes[0].style.display = 'none';
        finished_classes[0].style.display = 'none';
        
        info_btn[0].style.background = "linear-gradient(180deg, #FFA620 0%, #FF7A20 100%)";
        active_class_btn[0].style.background = "white";
        finished_class_btn[0].style.background = "white";
    });

    active_class_btn[0].addEventListener('click', function () {
        tutor_info[0].style.display = 'none';
        active_classes[0].style.display = 'grid';
        finished_classes[0].style.display = 'none';

        active_class_btn[0].style.background = "linear-gradient(180deg, #FFA620 0%, #FF7A20 100%)";
        info_btn[0].style.background = "white";
        finished_class_btn[0].style.background = "white";
    });

    finished_class_btn[0].addEventListener('click', function () {
        tutor_info[0].style.display = 'none';
        active_classes[0].style.display = 'none';
        finished_classes[0].style.display = 'grid';

        finished_class_btn[0].style.background = "linear-gradient(180deg, #FFA620 0%, #FF7A20 100%)";
        active_class_btn[0].style.background = "white";
        info_btn[0].style.background = "white";
    });


}

