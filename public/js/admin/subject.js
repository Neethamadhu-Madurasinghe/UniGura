console.log("dashboard.js loaded");

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




const subjectPage = document.getElementById('subject');
const nav_link = document.querySelectorAll(".nav-link");



nav_link.forEach((link) => {
    link.classList.remove('active');
})

subjectPage.classList.add('active');



const blur_filter = document.getElementById('blur-filter');
blur_filter.style.display = "none";




// *========================================== SUBJECT PAGE ===========================================================


/* ---------------------------------- SUBJECT update btn ---------------------------- */

const editSubject = document.querySelectorAll(".editSubject");
const subject_name_filed = document.querySelectorAll(".subject_name_filed");
const save_cancel_subject = document.querySelectorAll(".save-cancel-subject");
const cancel_btn_js = document.querySelectorAll(".cancel_btn_js");



for (let i = 0; i < editSubject.length; i++) {
    editSubject[i].addEventListener("click", function () {
        subject_name_filed[i].disabled = false;
        subject_name_filed[i].style.borderRadius = "5px";
        subject_name_filed[i].style.border = "1px dotted #000";
        subject_name_filed[i].style.transition = "all 0.5s ease";
        subject_name_filed[i].style.backgroundColor = "#f2f2f2";
        subject_name_filed[i].style.color = "#000";
        subject_name_filed[i].style.padding = "3px";
        subject_name_filed[i].style.width = "100%";


        save_cancel_subject[i].classList.add("show");
        editSubject[i].style.display = "none";
    });
}

for (let i = 0; i < cancel_btn_js.length; i++) {
    cancel_btn_js[i].addEventListener("click", function () {
        location.reload();

    });
}


/* ---------------------------------- MODULE update btn ---------------------------- */

const editModule = document.querySelectorAll(".editModule");
const module_input_filed = document.querySelectorAll(".module_input_filed");
const save_cancel_module = document.querySelectorAll(".save-cancel-module");
const cancel_module = document.querySelectorAll(".cancel-module");



for (let i = 0; i < editSubject.length; i++) {
    editModule[i].addEventListener("click", function () {
        module_input_filed[i].disabled = false;
        module_input_filed[i].style.borderRadius = "5px";
        module_input_filed[i].style.border = "1px dotted #000";
        module_input_filed[i].style.transition = "all 0.5s ease";
        module_input_filed[i].style.backgroundColor = "#f2f2f2";
        module_input_filed[i].style.color = "#000";
        module_input_filed[i].style.padding = "3px";
        module_input_filed[i].style.width = "100%";


        save_cancel_module[i].classList.add("show");
        editModule[i].style.display = "none";
    });
}

for (let i = 0; i < cancel_module.length; i++) {
    cancel_module[i].addEventListener("click", function () {
        location.reload();

    });
}


/* --------------------------- DUPLICATE ENTRY POPUP ERROR MESSAGE -------------------------------- */

const popup = document.getElementById('popup');
const closePopupBtn = document.getElementById('closePopup');
const container = document.getElementById('container');

closePopupBtn.addEventListener("click", function () {
    popup.style.display = "none";
    blur_filter.style.display = "none";
})



var blurElement = document.querySelector(".popup");

if (blurElement) {
    blur_filter.style.display = "block";
}