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




/* ---------------------------------- search and filer student complaint ---------------------------- */

const search_student_name = document.getElementById("search-student-name");
const student_complaint_table_section = document.getElementById("student-complaint-table-section");
const student_complaint_filter = document.getElementById("student-complaint-filter");


search_student_name.addEventListener('keyup', () => {
    let searchStudentName = search_student_name.value.toLowerCase();
    let student_complaint_filter_value = student_complaint_filter.value;

    const urlParams = new URLSearchParams(window.location.search);
    const currentPageNum = urlParams.get('currentPageNum');

    console.log(searchStudentName);
    console.log(student_complaint_filter_value);
    console.log(currentPageNum);


    const xhr = new XMLHttpRequest();

    xhr.open("GET", `filterForStudentComplaint?search_student_name_value=${searchStudentName}&student_complaint_filter_value=${student_complaint_filter_value}&currentPageNum=${currentPageNum}`, true);

    xhr.onload = function () {
        if (this.status === 200) {
            student_complaint_table_section.innerHTML = this.responseText;
        }
    }

    xhr.send();
});




student_complaint_filter.addEventListener('change', () => {
    let searchStudentName = search_student_name.value.toLowerCase();
    let student_complaint_filter_value = student_complaint_filter.value;

    const urlParams = new URLSearchParams(window.location.search);
    const currentPageNum = urlParams.get('currentPageNum');

    console.log(searchStudentName);
    console.log(student_complaint_filter_value);

    const xhr = new XMLHttpRequest();

    xhr.open("GET", `filterForStudentComplaint?search_student_name_value=${searchStudentName}&student_complaint_filter_value=${student_complaint_filter_value}&currentPageNum=${currentPageNum}`, true);

    xhr.onload = function () {
        if (this.status === 200) {
            student_complaint_table_section.innerHTML = this.responseText;
        }
    }

    xhr.send();

});


/* ---------------------------------- active button ---------------------------- */


const student_complaint_btn = document.getElementById('student-complaint');

student_complaint_btn.style.background = "linear-gradient(180deg, #FFA620 0%, #FF7A20 100%)";


