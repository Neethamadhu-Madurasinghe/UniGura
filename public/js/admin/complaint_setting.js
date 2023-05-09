const body = document.querySelector('body'),
    sidebar = body.querySelector('nav'),
    toggle = body.querySelector(".toggle"),
    searchBtn = body.querySelector(".search-box"),
    modeSwitch = body.querySelector(".toggle-switch"),
    modeText = body.querySelector(".mode-text");




const complaint = document.getElementById('complaint');
const nav_link = document.querySelectorAll(".nav-link");


nav_link.forEach((link) => {
    link.classList.remove('active');
})

complaint.classList.add('active');



const blur_filter = document.getElementById('blur-filter');
blur_filter.style.display = "none";


/* ---------------------------------- complaint update btn ---------------------------- */

const edit_icon_js = document.querySelectorAll(".edit_icon_js");
const complaint_input_filed = document.querySelectorAll(".complaint_input_filed");
const save_cancel = document.querySelectorAll(".save-cancel");
const cancel_btn_js = document.querySelectorAll(".cancel_btn_js");

const delete_icon_js = document.querySelectorAll(".delete_icon");



for (let i = 0; i < edit_icon_js.length; i++) {
    edit_icon_js[i].addEventListener("click", function () {
        complaint_input_filed[i].disabled = false;
        complaint_input_filed[i].style.borderRadius = "5px";
        complaint_input_filed[i].style.border = "2px dotted #000";
        complaint_input_filed[i].style.transition = "all 0.5s ease";
        complaint_input_filed[i].style.color = "#000";
        complaint_input_filed[i].style.padding = "8px";
        complaint_input_filed[i].style.width = "60%";
        complaint_input_filed[i].style.height = "36px";

        save_cancel[i].classList.add("show");
        edit_icon_js[i].style.display = "none";
        delete_icon_js[i].style.display = "none";
    });
}

for (let i = 0; i < cancel_btn_js.length; i++) {
    cancel_btn_js[i].addEventListener("click", function () {
        complaint_input_filed[i].disabled = true;
        complaint_input_filed[i].style.borderRadius = "0";
        complaint_input_filed[i].style.border = "none";
        complaint_input_filed[i].style.color = "#000";
        complaint_input_filed[i].style.padding = "8px";
        complaint_input_filed[i].style.width = "60%";

        save_cancel[i].classList.remove("show");
        edit_icon_js[i].style.display = "block";
        delete_icon_js[i].style.display = "block";
    });
}





/* ---------------------------------- active button ---------------------------- */

const complaint_setting_btn = document.getElementById('complaint-setting');

complaint_setting_btn.style.background = "linear-gradient(180deg, #FFA620 0%, #FF7A20 100%)";




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
