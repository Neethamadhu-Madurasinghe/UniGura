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




const dashboard = document.getElementById("dashboard");
const student = document.getElementById("student");
const tutor = document.getElementById("tutor");
const class_ = document.getElementById("class");
const subject = document.getElementById('subject');
const payment = document.getElementById('payment');
const chat = document.getElementById('chat');
const notification = document.getElementById('notification');
const request_complaint = document.getElementById('request-complaint');
const nav_link = document.querySelectorAll(".nav-link");
const view_student_profile = document.getElementById('view-student-profile');
const profile = document.getElementById('profile');


// view_student_profile.addEventListener("click", () => {
//     nav_link.forEach((link) => {
//         link.classList.remove('active');
//     })

//     student.classList.add('active');
//     loadStudentProfile();
// })

// function loadStudentProfile () {
//     const home = document.getElementById("home");

//     const xhr = new XMLHttpRequest();

//     xhr.open("GET", "../student-profile/index.html", true);

//     xhr.onload = function () {
//         if (this.status === 200) {
//             home.innerHTML = this.responseText;
//         }

//         // load the student js file
//         const script = document.createElement('script');
//         script.src = "../student-profile/main.js";
//         document.head.prepend(script);
//     }

//     xhr.send();
// }




request_complaint.addEventListener("click", () => {
    nav_link.forEach((link) => {
        link.classList.remove('active');
    })

    request_complaint.classList.add('active');

    loadRequestComplaint();
})




// // load page using ajax

// dashboard.addEventListener("click", () => {
//     nav_link.forEach((link) => {
//         link.classList.remove('active');
//     })

//     dashboard.classList.add('active');
//     loadDashboard();
// })

// function loadDashboard () {

//     const home = document.getElementById("home");

//     const xhr = new XMLHttpRequest();

//     // load AdminDashboard controller

//     // xhr.open("GET", "<?php echo URLROOT; ?>/app/views/admin/admin_dashboard.php", true);



//     xhr.onload = function () {
//         if (this.status === 200) {
//             home.innerHTML = this.responseText;
//         }

//         // load the dashboard js file
//         const script = document.createElement('script');
//         script.src = "../admin-dashboard/main.js";
//         document.head.prepend(script);
//     }

//     xhr.send();
// }


function requestComplainJS () {

    /* ----------------------------------search student complaint ---------------------------- */

    const search_student_name = document.getElementById("search-student-name");
    const search_student_name_btn = document.getElementById("search-student-name-btn");

    search_student_name_btn.addEventListener("click", () => {
        const search_student_name_value = search_student_name.value.toLowerCase();

        const xhr = new XMLHttpRequest();

        xhr.open("GET", "studentComplainSearch?search_student_name_value=" + search_student_name_value, true);

        xhr.onload = function () {
            if (this.status === 200) {
                home.innerHTML = this.responseText;
            }

            requestComplainJS();
        }

        xhr.send();
    })



    /* ----------------------------------filter student complaint ---------------------------- */

    const student_complaint_filter = document.getElementById("student-complaint-filter");

    student_complaint_filter.addEventListener("change", () => {
        var student_complaint_filter_value = student_complaint_filter.value;

        const xhr = new XMLHttpRequest();

        xhr.open("GET", "studentComplainFilter?student_complaint_filter_value=" + student_complaint_filter_value, true);

        xhr.onload = function () {
            if (this.status === 200) {
                home.innerHTML = this.responseText;
            }

            requestComplainJS();
        }

        xhr.send();
    })


    // --------------------MENU SELECTION----------------------------------------

    const tutor_request_table = document.getElementById("tutor-request-table");
    const student_complaint_table = document.getElementById("student-complaint-table");
    const tutor_complaint_table = document.getElementById("tutor-complaint-table");
    const complaint_setting_box = document.getElementById("complaint-setting-box");


    const tutor_request_btn = document.getElementById("tutor-request-btn");
    const student_complaint_btn = document.getElementById("student-complaint-btn");
    const tutor_complaint_btn = document.getElementById("tutor-complaint-btn");
    const complaint_setting_btn = document.getElementById("complaint-setting-btn");

    tutor_request_table.style.display = "block";
    student_complaint_table.style.display = "none";
    tutor_complaint_table.style.display = "none";
    complaint_setting_box.style.display = "none";

    tutor_request_btn.addEventListener("click", () => {
        tutor_request_table.style.display = "block";
        student_complaint_table.style.display = "none";
        tutor_complaint_table.style.display = "none";
        complaint_setting_box.style.display = "none";
    })

    student_complaint_btn.addEventListener("click", () => {
        tutor_request_table.style.display = "none";
        student_complaint_table.style.display = "block";
        tutor_complaint_table.style.display = "none";
        complaint_setting_box.style.display = "none";
    })

    tutor_complaint_btn.addEventListener("click", () => {
        tutor_request_table.style.display = "none";
        tutor_complaint_table.style.display = "block";
        student_complaint_table.style.display = "none";
        complaint_setting_box.style.display = "none";
    })

    complaint_setting_btn.addEventListener("click", () => {
        tutor_request_table.style.display = "none";
        student_complaint_table.style.display = "none";
        tutor_complaint_table.style.display = "none";
        complaint_setting_box.style.display = "block";
    })


    /* ---------------------------------- add complaint reason ---------------------------- */


    const add_student_complain_reason = document.getElementById("add-student-complain-reason");
    const type_student_complain_reason = document.getElementById("type-student-complain-reason");


    add_student_complain_reason.addEventListener("click", () => {
        var inputReason = type_student_complain_reason.value;

        if (inputReason == "") {
            alert("Warning: Please enter a reason");
        } else {
            const xhr = new XMLHttpRequest();

            xhr.open("GET", "addStudentComplainReason?inputStudentReason=" + inputReason, true);

            xhr.onload = function () {
                if (this.status === 200) {
                    home.innerHTML = this.responseText;
                }

                // const complaint_setting = document.querySelector(".complaint-setting");

                // complaint_setting.style.visibility = "visible";
                // complaint_setting.style.scale = "1";
                // complaint_setting.style.transform = "translate(-50%,-50%)";
                // complaint_setting.style.position = "absolute";
                // complaint_setting.style.top = "50%";

                const complaint_setting_box = document.getElementById("complaint-setting-box");
                complaint_setting_box.classList.add("open_complaint_setting");

                loadRequestComplaint();
            }

            xhr.send();


        }
    })



    /* ---------------------------------- complaint update btn ---------------------------- */

    const edit_icon_js = document.querySelectorAll(".edit_icon_js");
    const complaint_input_filed = document.querySelectorAll(".complaint_input_filed");
    const save_cancel = document.querySelectorAll(".save-cancel");
    const cancel_btn_js = document.querySelectorAll(".cancel_btn_js");



    for (let i = 0; i < edit_icon_js.length; i++) {
        edit_icon_js[i].addEventListener("click", function () {
            complaint_input_filed[i].disabled = false;
            complaint_input_filed[i].style.borderRadius = "5px";
            complaint_input_filed[i].style.border = "2px dotted #000";
            complaint_input_filed[i].style.transition = "all 0.5s ease";
            complaint_input_filed[i].style.backgroundColor = "#fff";
            complaint_input_filed[i].style.color = "#000";
            complaint_input_filed[i].style.padding = "3px";
            complaint_input_filed[i].style.width = "50%";
            complaint_input_filed[i].style.height = "30px";

            save_cancel[i].classList.add("show");
            edit_icon_js[i].style.display = "none";
        });
    }

    for (let i = 0; i < cancel_btn_js.length; i++) {
        cancel_btn_js[i].addEventListener("click", function () {
            complaint_input_filed[i].disabled = true;
            complaint_input_filed[i].style.borderRadius = "0";
            complaint_input_filed[i].style.border = "none";
            complaint_input_filed[i].style.backgroundColor = "transparent";
            complaint_input_filed[i].style.color = "#000";
            complaint_input_filed[i].style.padding = "0";

            save_cancel[i].classList.remove("show");
            edit_icon_js[i].style.display = "block";
        });
    }

    /* ---------------------------------- view student complaint btn ---------------------------- */

    const view_student_complaint = document.querySelectorAll(".view-student-complaint");
    const complaint_id = document.querySelectorAll(".complaint-id");

    for (let i = 0; i < view_student_complaint.length; i++) {
        view_student_complaint[i].addEventListener("click", function () {
            const studentComplaintId = complaint_id[i].value;
            console.log(studentComplaintId);

            const xhr = new XMLHttpRequest();

            xhr.open("GET", "viewComplaint?studentComplaintId=" + studentComplaintId, true);


            xhr.onload = function () {
                if (this.status === 200) {
                    home.innerHTML = this.responseText;
                }


                /* ---------------------------------- checkbox checking the complain is inquire or not ---------------------------- */

                const submit_status_btn = document.getElementById("submit-status-btn");
                const complainStatus = document.getElementById("complainStatus");


                submit_status_btn.addEventListener("click", function () {
                    console.log("checked");

                    const xhr = new XMLHttpRequest();

                    xhr.open("GET", "updateComplainInquire?studentComplaintId=" + studentComplaintId + "&complainStatus=" + complainStatus.value, true);

                    xhr.onload = function () {
                        if (this.status === 200) {
                            home.innerHTML = this.responseText;
                        }

                        loadRequestComplaint();
                    }

                    xhr.send();
                })


                /* ---------------------------------- back btn for student complain ---------------------------- */

                const student_complaint_back_btn = document.getElementById("student-complaint-back-btn");

                student_complaint_back_btn.addEventListener("click", () => {
                    loadRequestComplaint();
                })
            }

            xhr.send();
        });
    }
}



function loadRequestComplaint () {

    const home = document.getElementById("home");

    const xhr = new XMLHttpRequest();

    xhr.open("GET", "requirementComplaints", true);

    xhr.onload = function () {
        if (this.status === 200) {
            home.innerHTML = this.responseText;
        }

        /* ----------------------------------search student complaint ---------------------------- */

        const search_student_name = document.getElementById("search-student-name");
        const search_student_name_btn = document.getElementById("search-student-name-btn");

        search_student_name_btn.addEventListener("click", () => {
            const search_student_name_value = search_student_name.value.toLowerCase();

            const xhr = new XMLHttpRequest();

            xhr.open("GET", "studentComplainSearch?search_student_name_value=" + search_student_name_value, true);

            xhr.onload = function () {
                if (this.status === 200) {
                    home.innerHTML = this.responseText;
                }

                requestComplainJS();
            }

            xhr.send();
        })

        /* ----------------------------------filter student complaint ---------------------------- */

        const student_complaint_filter = document.getElementById("student-complaint-filter");

        student_complaint_filter.addEventListener("change", () => {
            var student_complaint_filter_value = student_complaint_filter.value;

            const xhr = new XMLHttpRequest();

            xhr.open("GET", "studentComplainFilter?student_complaint_filter_value=" + student_complaint_filter_value, true);

            xhr.onload = function () {
                if (this.status === 200) {
                    home.innerHTML = this.responseText;
                }

                requestComplainJS();
            }

            xhr.send();
        })


        // --------------------MENU SELECTION----------------------------------------

        const tutor_request_table = document.getElementById("tutor-request-table");
        const student_complaint_table = document.getElementById("student-complaint-table");
        const tutor_complaint_table = document.getElementById("tutor-complaint-table");
        const complaint_setting_box = document.getElementById("complaint-setting-box");


        const tutor_request_btn = document.getElementById("tutor-request-btn");
        const student_complaint_btn = document.getElementById("student-complaint-btn");
        const tutor_complaint_btn = document.getElementById("tutor-complaint-btn");
        const complaint_setting_btn = document.getElementById("complaint-setting-btn");

        tutor_request_table.style.display = "block";
        student_complaint_table.style.display = "none";
        tutor_complaint_table.style.display = "none";
        complaint_setting_box.style.display = "none";

        tutor_request_btn.addEventListener("click", () => {
            tutor_request_table.style.display = "block";
            student_complaint_table.style.display = "none";
            tutor_complaint_table.style.display = "none";
            complaint_setting_box.style.display = "none";
        })

        student_complaint_btn.addEventListener("click", () => {
            tutor_request_table.style.display = "none";
            student_complaint_table.style.display = "block";
            tutor_complaint_table.style.display = "none";
            complaint_setting_box.style.display = "none";
        })

        tutor_complaint_btn.addEventListener("click", () => {
            tutor_request_table.style.display = "none";
            tutor_complaint_table.style.display = "block";
            student_complaint_table.style.display = "none";
            complaint_setting_box.style.display = "none";
        })

        complaint_setting_btn.addEventListener("click", () => {
            tutor_request_table.style.display = "none";
            student_complaint_table.style.display = "none";
            tutor_complaint_table.style.display = "none";
            complaint_setting_box.style.display = "block";
        })


        requestComplainJS();



    }

    xhr.send();
}










