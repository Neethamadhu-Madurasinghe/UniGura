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
// const student_complaint = document.getElementById("student-complain");
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

    xhr.open("GET", `filterForTutorComplaint?search_student_name_value=${searchTutorName}&student_complaint_filter_value=${tutor_complaint_filter_value}&currentPageNum=${currentPageNum}`, true);

    xhr.onload = function () {
        if (this.status === 200) {
            student_complain.innerHTML = this.responseText;
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
            student_complain.innerHTML = this.responseText;
        }
    }

    xhr.send();

});
