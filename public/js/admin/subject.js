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

        subject_name_filed[i].classList.add("editSubject");
        subject_name_filed[i].classList.remove("cancelEditSubject");
        save_cancel_subject[i].classList.add("show");
        editSubject[i].style.display = "none";
    });
}

for (let i = 0; i < cancel_btn_js.length; i++) {
    cancel_btn_js[i].addEventListener("click", function () {
        subject_name_filed[i].disabled = true;

        subject_name_filed[i].classList.add("cancelEditSubject");
        subject_name_filed[i].classList.remove("editSubject");
        save_cancel_subject[i].classList.remove("show");
        editSubject[i].style.display = "block";
    });
}



/* ---------------------------------- MODULE update btn ---------------------------- */

const editModule = document.querySelectorAll(".editModule");
const module_input_filed = document.querySelectorAll(".module_input_filed");
const save_cancel_module = document.querySelectorAll(".save-cancel-module");
const cancel_module = document.querySelectorAll(".cancel-module");



for (let i = 0; i < editModule.length; i++) {
    editModule[i].addEventListener("click", function () {
        module_input_filed[i].disabled = false;

        module_input_filed[i].classList.add("editModule");
        module_input_filed[i].classList.remove("cancelEditModule");
        save_cancel_module[i].classList.add("show");
        editModule[i].style.display = "none";
    });
}

for (let i = 0; i < cancel_module.length; i++) {
    cancel_module[i].addEventListener("click", function () {
        module_input_filed[i].disabled = true;

        module_input_filed[i].classList.add("cancelEditModule");
        module_input_filed[i].classList.remove("editModule");
        save_cancel_module[i].classList.remove("show");
        editModule[i].style.display = "block";
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