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

const edit_icon_js = document.querySelectorAll(".edit_icon_js");
const subject_name_filed = document.querySelectorAll(".subject_name_filed");
const save_cancel = document.querySelectorAll(".save-cancel");
const cancel_btn_js = document.querySelectorAll(".cancel_btn_js");



for (let i = 0; i < edit_icon_js.length; i++) {
    edit_icon_js[i].addEventListener("click", function () {
        subject_name_filed[i].disabled = false;
        subject_name_filed[i].style.borderRadius = "5px";
        subject_name_filed[i].style.border = "1px dotted #000";
        subject_name_filed[i].style.transition = "all 0.5s ease";
        subject_name_filed[i].style.backgroundColor = "#f2f2f2";
        subject_name_filed[i].style.color = "#000";
        subject_name_filed[i].style.padding = "3px";
        subject_name_filed[i].style.width = "100%";


        save_cancel[i].classList.add("show");
        edit_icon_js[i].style.display = "none";
    });
}

for (let i = 0; i < cancel_btn_js.length; i++) {
    cancel_btn_js[i].addEventListener("click", function () {
        subject_name_filed[i].disabled = true;
        subject_name_filed[i].style.borderRadius = "0";
        subject_name_filed[i].style.border = "none";
        subject_name_filed[i].style.backgroundColor = "#f2f2f2";
        subject_name_filed[i].style.color = "#000";
        subject_name_filed[i].style.padding = "0px";
        subject_name_filed[i].style.width = "100%";

        save_cancel[i].classList.remove("show");
        edit_icon_js[i].style.display = "inline-block";
    });
}

