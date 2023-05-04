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




const request_complaint = document.getElementById('request-complaint');
const nav_link = document.querySelectorAll(".nav-link");


nav_link.forEach((link) => {
    link.classList.remove('active');
})

request_complaint.classList.add('active');





/* ---------------------------------- search and filer tutor complaint ---------------------------- */

const search_tutor_name = document.getElementById("search-tutor-name");
const tutor_complaint_table_section = document.getElementById("tutor-complaint-table-section");
const tutor_complaint_filter = document.getElementById("tutor-complaint-filter");


search_tutor_name.addEventListener('keyup', () => {
    let searchTutorName = search_tutor_name.value.toLowerCase();
    let tutor_complaint_filter_value = tutor_complaint_filter.value;

    const urlParams = new URLSearchParams(window.location.search);
    const currentPageNum = urlParams.get('currentPageNum');

    console.log(searchTutorName);
    console.log(tutor_complaint_filter_value);
    console.log(currentPageNum);


    const xhr = new XMLHttpRequest();

    xhr.open("GET", `filterForTutorComplaint?search_tutor_name_value=${searchTutorName}&tutor_complaint_filter_value=${tutor_complaint_filter_value}&currentPageNum=${currentPageNum}`, true);

    xhr.onload = function () {
        if (this.status === 200) {
            tutor_complaint_table_section.innerHTML = this.responseText;
        }
    }

    xhr.send();
});




tutor_complaint_filter.addEventListener('change', () => {
    let searchTutorName = search_tutor_name.value.toLowerCase();
    let tutor_complaint_filter_value = tutor_complaint_filter.value;

    const urlParams = new URLSearchParams(window.location.search);
    const currentPageNum = urlParams.get('currentPageNum');

    console.log(searchTutorName);
    console.log(tutor_complaint_filter_value);
    console.log(currentPageNum);

    const xhr = new XMLHttpRequest();

    xhr.open("GET", `filterForTutorComplaint?search_tutor_name_value=${searchTutorName}&tutor_complaint_filter_value=${tutor_complaint_filter_value}&currentPageNum=${currentPageNum}`, true);

    xhr.onload = function () {
        if (this.status === 200) {
            tutor_complaint_table_section.innerHTML = this.responseText;
        }
    }

    xhr.send();

});




/* ---------------------------------- active button ---------------------------- */


const tutor_complaint_btn = document.getElementById('tutor-complaint');

tutor_complaint_btn.style.background = "linear-gradient(180deg, #FFA620 0%, #FF7A20 100%)";

