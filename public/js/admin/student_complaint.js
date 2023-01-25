
/* ----------------------------------search student complaint ---------------------------- */

// const search_student_name = document.getElementById("search-student-name");
// const search_student_name_btn = document.getElementById("search-student-name-btn");
// const student_complain = document.getElementById("student-complain");

// search_student_name_btn.addEventListener("click", () => {
//     const search_student_name_value = search_student_name.value.toLowerCase();

//     const xhr = new XMLHttpRequest();

//     xhr.open("GET", "studentComplainSearch?search_student_name_value=" + search_student_name_value, true);

//     xhr.onload = function () {
//         if (this.status === 200) {
//             student_complain.innerHTML = this.responseText;
//         }
//     }

//     xhr.send();
// })



// /* ----------------------------------filter student complaint ---------------------------- */

// const student_complaint_filter = document.getElementById("student-complaint-filter");

// student_complaint_filter.addEventListener("change", () => {
//     var student_complaint_filter_value = student_complaint_filter.value;

//     const xhr = new XMLHttpRequest();

//     xhr.open("GET", "studentComplainFilter?student_complaint_filter_value=" + student_complaint_filter_value, true);

//     xhr.onload = function () {
//         if (this.status === 200) {
//             student_complain.innerHTML = this.responseText;
//         }
//     }

//     xhr.send();
// })



/* ---------------------------------- search and filer student complaint ---------------------------- */

const search_student_name = document.getElementById("search-student-name");
const search_student_name_btn = document.getElementById("search-student-name-btn");
const student_complain = document.getElementById("student-complain");
const student_complaint_filter = document.getElementById("student-complaint-filter");


var searchFilterResult = '';

search_student_name_btn.addEventListener("click", () => {
    var search_student_name_value = search_student_name.value.toLowerCase();

    const xhr = new XMLHttpRequest();

    xhr.open("GET", "studentComplainSearchFilter?search_student_name_value=" + search_student_name_value, true);

    xhr.onload = function () {
        if (this.status === 200) {
            student_complain.innerHTML = this.responseText;
            searchFilterResult = this.responseText;
        }
    }

    xhr.send();
})


var student_complaint_filter_value = '';

student_complaint_filter.addEventListener("change", () => {
    student_complaint_filter_value = student_complaint_filter.value;

    const xhr = new XMLHttpRequest();

    xhr.open("GET", "studentComplainSearchFilter?student_complaint_filter_value=" + student_complaint_filter_value, true);

    xhr.onload = function () {
        if (this.status === 200) {
            student_complain.innerHTML = this.responseText;
            searchFilterResult = this.responseText;
        }
    }

    xhr.send();

})





nav_link.forEach((link) => {
    link.classList.remove('active');
})

request_complaint.classList.add('active');








