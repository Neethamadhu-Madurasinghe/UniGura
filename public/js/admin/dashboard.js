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

// searchBtn.addEventListener("click", () => {
//     sidebar.classList.remove("close");
// })

// modeSwitch.addEventListener("click", () => {
//     body.classList.toggle("dark");

//     if (body.classList.contains("dark")) {
//         modeText.innerText = "Light mode";
//     } else {
//         modeText.innerText = "Dark mode";

//     }
// });



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







class_.addEventListener("click", () => {
    nav_link.forEach((link) => {
        link.classList.remove('active');
    })

    class_.classList.add('active');

    loadClass();
})






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





function loadRequestComplaint () {

    const home = document.getElementById("home");

    const xhr = new XMLHttpRequest();

    xhr.open("GET", "requirementComplaints", true);

    xhr.onload = function () {
        if (this.status === 200) {
            home.innerHTML = this.responseText;
        }


        /* ---------------------------------- complaint setting ---------------------------- */



        const complaints_settings_btn = document.getElementById("complaints-settings-btn");
        const complaints_close_btn = document.getElementById("complaints-close-btn");
        const complaint_setting_box = document.getElementById("complaint-setting-box");



        complaints_settings_btn.addEventListener("click", () => {
            complaint_setting_box.classList.add("open_complaint_setting");
            // home.classList.add("blur");

        })

        complaints_close_btn.addEventListener("click", () => {
            complaint_setting_box.classList.remove("open_complaint_setting");
            // home.classList.remove("blur");
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

        view_student_complaint.forEach((view_stu_complaint) => {

            view_stu_complaint.addEventListener("click", () => {
                const xhr = new XMLHttpRequest();

                xhr.open("GET", "viewComplaint", true);

                xhr.onload = function () {
                    if (this.status === 200) {
                        home.innerHTML = this.responseText;
                    }

                    /* ---------------------------------- back btn for student complain ---------------------------- */

                    const student_complaint_back_btn = document.getElementById("student-complaint-back-btn");

                    student_complaint_back_btn.addEventListener("click", () => {
                        loadRequestComplaint();
                    })
                }

                xhr.send();
            })
        })

    }

    xhr.send();
}


// *========================================== CHAT PAGE ===========================================================


chat.addEventListener("click", () => {
    nav_link.forEach((link) => {
        link.classList.remove('active');
    })

    chat.classList.add('active');

    loadChat();
})



function loadChat () {

    const home = document.getElementById("home");

    const xhr = new XMLHttpRequest();

    xhr.open("GET", "chat", true);

    xhr.onload = function () {
        if (this.status === 200) {
            home.innerHTML = this.responseText;
        }
    }

    xhr.send();
}



function loadClass () {

    const home = document.getElementById("home");

    const xhr = new XMLHttpRequest();

    xhr.open("GET", "class", true);

    xhr.onload = function () {
        if (this.status === 200) {
            home.innerHTML = this.responseText;
        }


        // ====================== filter section js code ==================================

        const rangeInput = document.querySelectorAll(".range-input input")
        const priceInput = document.querySelectorAll(".price-input input")
        const range = document.querySelector(".slider .progress");

        // let priceGap = 10;


        priceInput.forEach(input => {
            input.addEventListener("input", e => {
                // let minPrice = parseInt(priceInput[0].value);
                let maxPrice = parseInt(priceInput[1].value);

                // if ((maxPrice - minPrice >= priceGap) && maxPrice <= rangeInput[1].max) {
                // if (e.target.className === "input-max") {
                rangeInput[0].value = maxPrice;
                range.style.right = 100 - (maxPrice / rangeInput[0].max) * 100 + "%";
                // } 
                // else {
                //     rangeInput[1].value = maxPrice;
                //     range.style.right = 100 - (maxPrice / rangeInput[1].max) * 100 + "%";
                // }
                // }
            });
        });
        rangeInput.forEach(input => {
            input.addEventListener("input", e => {
                // let minVal = parseInt(rangeInput[0].value);
                let maxVal = parseInt(rangeInput[0].value);

                // if ((maxVal - minVal) < priceGap) {
                //     if (e.target.className === "range-min") {
                //         rangeInput[0].value = maxVal - priceGap
                //     } else {
                //         rangeInput[1].value = minVal + priceGap;
                //     }
                // } else {
                // priceInput[0].value = minVal;
                priceInput[1].value = maxVal;
                // range.style.left = ((minVal / rangeInput[0].max) * 100) + "%";
                range.style.right = 100 - (maxVal / rangeInput[0].max) * 100 + "%";
                // }
            });
        });


        // ====================== RESET FILTER ==================================

        const filterResetBtn = document.getElementById("filter-reset-btn");

        filterResetBtn.addEventListener("click", () => {

            loadClass();
        });



        // ====================== filter section js code ==================================

        const allClasses = document.getElementById('all-classes');

        const filterBtn = document.getElementById('filter');
        const classConductMode = document.querySelectorAll('.class-conduct-mode');

        const classFeesSliderMin = document.querySelector('#class-fees-slider-min');
        const classFeesSliderMax = document.querySelector('#class-fees-slider-max');
        const classFeesInputMin = document.querySelector('#class-fees-input-min');
        const classFeesInputMax = document.querySelector('#class-fees-input-max');

        const classSubject = document.querySelectorAll('.class-subject');

        const classRating = document.querySelectorAll('.class-rating');

        var classConductModeValue = [];
        var classFeesInputField = [];
        var classFeesSliderField = [];
        var selectedSubject = [];
        var selectedRating = [];

        function arrayRemove (arr, value) {
            return arr.filter(function (element) {
                return element != value;
            });
        }

        filterBtn.addEventListener('click', () => {
            for (let i = 0; i < classConductMode.length; i++) {
                if (classConductMode[i].checked == true) {
                    classConductModeValue.push(classConductMode[i].value);
                }
                if (classConductMode[i].checked == false) {
                    classConductModeValue = arrayRemove(classConductModeValue, classConductMode[i].value);
                }
            }

            for (let i = 0; i < classSubject.length; i++) {
                if (classSubject[i].checked == true) {
                    selectedSubject.push(classSubject[i].value);
                }
                if (classSubject[i].checked == false) {
                    selectedSubject = arrayRemove(selectedSubject, classSubject[i].value);
                }
            }

            for (let i = 0; i < classRating.length; i++) {
                if (classRating[i].checked == true) {
                    selectedRating.push(classRating[i].value);
                }
                if (classRating[i].checked == false) {
                    selectedRating = arrayRemove(selectedRating, classRating[i].value);
                }
            }



            var uniqueClassModes = [...new Set(classConductModeValue)];
            classConductModeValue = uniqueClassModes;

            var uniqueSubjects = [...new Set(selectedSubject)];
            selectedSubject = uniqueSubjects;


            const minInputFees = classFeesInputMin.value;
            const maxInputFees = classFeesInputMax.value;


            classFeesInputField = [];
            classFeesInputField.push(minInputFees);
            classFeesInputField.push(maxInputFees);

            // const minSliderFees = classFeesSliderMin.value;
            const maxSliderFees = classFeesSliderMax.value;

            classFeesSliderField = [];
            // classFeesSliderField.push(minSliderFees);
            classFeesSliderField.push(maxSliderFees);


            const xhttp = new XMLHttpRequest();
            xhttp.open('GET', `filter?classConductModeValue=${classConductModeValue}&classFeesInputField=${classFeesInputField}&classFeesSliderField=${classFeesSliderField}&selectedSubject=${selectedSubject}&selectedRating=${selectedRating}`, true);

            xhttp.onload = function () {
                if (this.status === 200) {
                    allClasses.innerHTML = this.responseText;
                }
            }
            xhttp.send();
        });

    }

    xhr.send();
}





// *========================================== SUBJECT PAGE ===========================================================


subject.addEventListener("click", () => {
    nav_link.forEach((link) => {
        link.classList.remove('active');
    })

    subject.classList.add('active');

    loadSubject();
})



function loadSubject () {

    const home = document.getElementById("home");

    const xhr = new XMLHttpRequest();

    xhr.open("GET", "subjectModule", true);

    xhr.onload = function () {
        if (this.status === 200) {
            home.innerHTML = this.responseText;
        }
        const addSubject = document.getElementById("addSubject");
        const typeSubject = document.getElementById("typeSubject");

        const addModule = document.querySelectorAll(".addModule");
        const typeModule = document.querySelectorAll(".typeModule");
        const subjectId = document.querySelectorAll(".subjectId");

        addSubject.addEventListener("click", function () {
            addSubjectFun(typeSubject.value);
        })

        for (let i = 0; i < addModule.length; i++) {
            addModule[i].addEventListener("click", function () {
                addModuleFun(typeModule[i].value, subjectId[i].value);
            })
        }

        // ====================== UPDATE MODULE ==================================

        const module_input_filed = document.querySelectorAll(".module_input_filed");
        const edit_icon_js = document.querySelectorAll(".edit_icon_js");
        const module_ID_filed = document.querySelectorAll(".module_ID_filed");
        const subject = document.querySelectorAll(".subject");
        const subject_module_box = document.querySelectorAll(".subject_module_box");
        const save = document.querySelectorAll(".save");

        // const hideModule = document.querySelectorAll(".hideModule");
        const showHideBtn = document.querySelectorAll(".showHideBtn");
        const is_hidden_filed = document.querySelectorAll(".is_hidden_filed");


        // for (let i = 0; i < is_hidden_filed.length; i++) {
        //     if (is_hidden_filed[i].value == 1) {
        //         showHideBtn[i].innerHTML = "Show";
        //         showHideBtn[i].style.backgroundColor = "#19ca05e0"; // green
        //         showHideBtn[i].style.color = "#000";
        //     }
        //     if (is_hidden_filed[i].value == 0) {
        //         showHideBtn[i].innerHTML = "Hide";
        //         showHideBtn[i].style.backgroundColor = "#ff0000e0"; // red
        //         showHideBtn[i].style.color = "#fff";
        //     }
        // }

        // use ajax
        for (let i = 0; i < showHideBtn.length; i++) {
            showHideBtn[i].addEventListener("click", function () {
                if (is_hidden_filed[i].value == 1) {
                    updateModuleHideShowFun(0, module_ID_filed[i].value);
                    console.log("hide");
                }
                if (is_hidden_filed[i].value == 0) {
                    updateModuleHideShowFun(1, module_ID_filed[i].value);
                    console.log("show");
                }
            })
        }



        for (let i = 0; i < edit_icon_js.length; i++) {
            edit_icon_js[i].addEventListener("click", function () {
                module_input_filed[i].disabled = false;
                module_input_filed[i].style.borderRadius = "5px";
                module_input_filed[i].style.border = "2px dotted #000";
                module_input_filed[i].style.transition = "all 0.5s ease";
                module_input_filed[i].style.backgroundColor = "#fff";
                module_input_filed[i].style.color = "#000";
                module_input_filed[i].style.padding = "3px";
                module_input_filed[i].style.width = "100%";
                module_input_filed[i].style.height = "30px";



                save[i].innerHTML = "Save";
                save[i].style.backgroundColor = "blue";
                save[i].style.color = "#fff";
                // save[i].style.width = "100px";   
                save[i].style.height = "30px";

                edit_icon_js[i].style.display = "none";
            });
        }


        for (let i = 0; i < save.length; i++) {
            save[i].addEventListener("click", function (e) {

                save[i].innerHTML = "Hide";
                save[i].style.backgroundColor = "red";
                // edit_icon_js[i].style.display = "flex";
                const module_name = module_input_filed[i].value;
                const module_id = module_ID_filed[i].value;

                module_input_filed[i].value = module_name;

                updateModuleFun(module_name, module_id);
            });
        }


    }
    xhr.send();
}



function addSubjectFun (subject) {

    const xhr = new XMLHttpRequest();

    xhr.open("GET", "addSubject?subjectName=" + subject, true);

    xhr.onload = function () {
        if (this.status === 200) {
            home.innerHTML = this.responseText;
            // console.log(this.responseText);
        }

        const addSubject = document.getElementById("addSubject");
        const typeSubject = document.getElementById("typeSubject");

        const addModule = document.querySelectorAll(".addModule");
        const typeModule = document.querySelectorAll(".typeModule");
        const subjectId = document.querySelectorAll(".subjectId");

        addSubject.addEventListener("click", function () {
            addSubjectFun(typeSubject.value);
        })

        for (let i = 0; i < addModule.length; i++) {
            addModule[i].addEventListener("click", function () {
                addModuleFun(typeModule[i].value, subjectId[i].value);
            })
        }

        // ====================== UPDATE MODULE ==================================

        const module_input_filed = document.querySelectorAll(".module_input_filed");
        const edit_icon_js = document.querySelectorAll(".edit_icon_js");
        const module_ID_filed = document.querySelectorAll(".module_ID_filed");
        const subject = document.querySelectorAll(".subject");
        const subject_module_box = document.querySelectorAll(".subject_module_box");
        const save = document.querySelectorAll(".save");

        // const hideModule = document.querySelectorAll(".hideModule");
        const showHideBtn = document.querySelectorAll(".showHideBtn");
        const is_hidden_filed = document.querySelectorAll(".is_hidden_filed");


        // for (let i = 0; i < is_hidden_filed.length; i++) {
        //     if (is_hidden_filed[i].value == 1) {
        //         showHideBtn[i].innerHTML = "Show";
        //         showHideBtn[i].style.backgroundColor = "#19ca05e0"; // green
        //         showHideBtn[i].style.color = "#000";
        //     }
        //     if (is_hidden_filed[i].value == 0) {
        //         showHideBtn[i].innerHTML = "Hide";
        //         showHideBtn[i].style.backgroundColor = "#ff0000e0"; // red
        //         showHideBtn[i].style.color = "#fff";
        //     }
        // }

        // use ajax
        for (let i = 0; i < showHideBtn.length; i++) {
            showHideBtn[i].addEventListener("click", function () {
                if (is_hidden_filed[i].value == 1) {
                    updateModuleHideShowFun(0, module_ID_filed[i].value);
                    console.log("hide");
                }
                if (is_hidden_filed[i].value == 0) {
                    updateModuleHideShowFun(1, module_ID_filed[i].value);
                    console.log("show");
                }
            })
        }



        for (let i = 0; i < edit_icon_js.length; i++) {
            edit_icon_js[i].addEventListener("click", function () {
                module_input_filed[i].disabled = false;
                module_input_filed[i].style.borderRadius = "5px";
                module_input_filed[i].style.border = "2px dotted #000";
                module_input_filed[i].style.transition = "all 0.5s ease";
                module_input_filed[i].style.backgroundColor = "#fff";
                module_input_filed[i].style.color = "#000";
                module_input_filed[i].style.padding = "3px";
                module_input_filed[i].style.width = "100%";
                module_input_filed[i].style.height = "30px";



                save[i].innerHTML = "Save";
                save[i].style.backgroundColor = "blue";
                save[i].style.color = "#fff";
                // save[i].style.width = "100px";   
                save[i].style.height = "30px";

                edit_icon_js[i].style.display = "none";
            });
        }


        for (let i = 0; i < save.length; i++) {
            save[i].addEventListener("click", function (e) {

                save[i].innerHTML = "Hide";
                save[i].style.backgroundColor = "red";
                // edit_icon_js[i].style.display = "flex";
                const module_name = module_input_filed[i].value;
                const module_id = module_ID_filed[i].value;

                module_input_filed[i].value = module_name;

                updateModuleFun(module_name, module_id);
            });
        }
    }

    xhr.send();
}



function addModuleFun (module, subjectId) {

    const xhr = new XMLHttpRequest();

    xhr.open("GET", "addModule?moduleName=" + module + "&subjectId=" + subjectId, true);

    xhr.onload = function () {
        if (this.status === 200) {
            home.innerHTML = this.responseText;
            // console.log(this.responseText);
        }

        const addSubject = document.getElementById("addSubject");
        const typeSubject = document.getElementById("typeSubject");

        const addModule = document.querySelectorAll(".addModule");
        const typeModule = document.querySelectorAll(".typeModule");
        const subjectId = document.querySelectorAll(".subjectId");

        addSubject.addEventListener("click", function () {
            addSubjectFun(typeSubject.value);
        })

        for (let i = 0; i < addModule.length; i++) {
            addModule[i].addEventListener("click", function () {
                addModuleFun(typeModule[i].value, subjectId[i].value);
            })
        }

        // ====================== UPDATE MODULE ==================================

        const module_input_filed = document.querySelectorAll(".module_input_filed");
        const edit_icon_js = document.querySelectorAll(".edit_icon_js");
        const module_ID_filed = document.querySelectorAll(".module_ID_filed");
        const subject = document.querySelectorAll(".subject");
        const subject_module_box = document.querySelectorAll(".subject_module_box");
        const save = document.querySelectorAll(".save");

        // const hideModule = document.querySelectorAll(".hideModule");
        const showHideBtn = document.querySelectorAll(".showHideBtn");
        const is_hidden_filed = document.querySelectorAll(".is_hidden_filed");


        // for (let i = 0; i < is_hidden_filed.length; i++) {
        //     if (is_hidden_filed[i].value == 1) {
        //         showHideBtn[i].innerHTML = "Show";
        //         showHideBtn[i].style.backgroundColor = "#19ca05e0"; // green
        //         showHideBtn[i].style.color = "#000";
        //     }
        //     if (is_hidden_filed[i].value == 0) {
        //         showHideBtn[i].innerHTML = "Hide";
        //         showHideBtn[i].style.backgroundColor = "#ff0000e0"; // red
        //         showHideBtn[i].style.color = "#fff";
        //     }
        // }

        // use ajax
        for (let i = 0; i < showHideBtn.length; i++) {
            showHideBtn[i].addEventListener("click", function () {
                if (is_hidden_filed[i].value == 1) {
                    updateModuleHideShowFun(0, module_ID_filed[i].value);
                    console.log("hide");
                }
                if (is_hidden_filed[i].value == 0) {
                    updateModuleHideShowFun(1, module_ID_filed[i].value);
                    console.log("show");
                }
            })
        }



        for (let i = 0; i < edit_icon_js.length; i++) {
            edit_icon_js[i].addEventListener("click", function () {
                module_input_filed[i].disabled = false;
                module_input_filed[i].style.borderRadius = "5px";
                module_input_filed[i].style.border = "2px dotted #000";
                module_input_filed[i].style.transition = "all 0.5s ease";
                module_input_filed[i].style.backgroundColor = "#fff";
                module_input_filed[i].style.color = "#000";
                module_input_filed[i].style.padding = "3px";
                module_input_filed[i].style.width = "100%";
                module_input_filed[i].style.height = "30px";



                save[i].innerHTML = "Save";
                save[i].style.backgroundColor = "blue";
                save[i].style.color = "#fff";
                // save[i].style.width = "100px";   
                save[i].style.height = "30px";

                edit_icon_js[i].style.display = "none";
            });
        }


        for (let i = 0; i < save.length; i++) {
            save[i].addEventListener("click", function (e) {

                save[i].innerHTML = "Hide";
                save[i].style.backgroundColor = "red";
                // edit_icon_js[i].style.display = "flex";
                const module_name = module_input_filed[i].value;
                const module_id = module_ID_filed[i].value;

                module_input_filed[i].value = module_name;

                updateModuleFun(module_name, module_id);
            });
        }
    }

    xhr.send();
}



function updateModuleFun (module_name, module_id) {

    const xhr = new XMLHttpRequest();

    xhr.open("GET", "updateModule?moduleName=" + module_name + "&moduleId=" + module_id, true);

    xhr.onload = function () {
        if (this.status === 200) {
            home.innerHTML = this.responseText;
        }

        const addSubject = document.getElementById("addSubject");
        const typeSubject = document.getElementById("typeSubject");

        const addModule = document.querySelectorAll(".addModule");
        const typeModule = document.querySelectorAll(".typeModule");
        const subjectId = document.querySelectorAll(".subjectId");

        addSubject.addEventListener("click", function () {
            addSubjectFun(typeSubject.value);
        })

        for (let i = 0; i < addModule.length; i++) {
            addModule[i].addEventListener("click", function () {
                addModuleFun(typeModule[i].value, subjectId[i].value);
            })
        }

        // ====================== UPDATE MODULE ==================================

        const module_input_filed = document.querySelectorAll(".module_input_filed");
        const edit_icon_js = document.querySelectorAll(".edit_icon_js");
        const module_ID_filed = document.querySelectorAll(".module_ID_filed");
        const subject = document.querySelectorAll(".subject");
        const subject_module_box = document.querySelectorAll(".subject_module_box");
        const save = document.querySelectorAll(".save");

        // const hideModule = document.querySelectorAll(".hideModule");
        const showHideBtn = document.querySelectorAll(".showHideBtn");
        const is_hidden_filed = document.querySelectorAll(".is_hidden_filed");


        // for (let i = 0; i < is_hidden_filed.length; i++) {
        //     if (is_hidden_filed[i].value == 1) {
        //         showHideBtn[i].innerHTML = "Show";
        //         showHideBtn[i].style.backgroundColor = "#19ca05e0"; // green
        //         showHideBtn[i].style.color = "#000";
        //     }
        //     if (is_hidden_filed[i].value == 0) {
        //         showHideBtn[i].innerHTML = "Hide";
        //         showHideBtn[i].style.backgroundColor = "#ff0000e0"; // red
        //         showHideBtn[i].style.color = "#fff";
        //     }
        // }

        // use ajax
        for (let i = 0; i < showHideBtn.length; i++) {
            showHideBtn[i].addEventListener("click", function () {
                if (is_hidden_filed[i].value == 1) {
                    updateModuleHideShowFun(0, module_ID_filed[i].value);
                    console.log("hide");
                }
                if (is_hidden_filed[i].value == 0) {
                    updateModuleHideShowFun(1, module_ID_filed[i].value);
                    console.log("show");
                }
            })
        }



        for (let i = 0; i < edit_icon_js.length; i++) {
            edit_icon_js[i].addEventListener("click", function () {
                module_input_filed[i].disabled = false;
                module_input_filed[i].style.borderRadius = "5px";
                module_input_filed[i].style.border = "2px dotted #000";
                module_input_filed[i].style.transition = "all 0.5s ease";
                module_input_filed[i].style.backgroundColor = "#fff";
                module_input_filed[i].style.color = "#000";
                module_input_filed[i].style.padding = "3px";
                module_input_filed[i].style.width = "100%";
                module_input_filed[i].style.height = "30px";



                save[i].innerHTML = "Save";
                save[i].style.backgroundColor = "blue";
                save[i].style.color = "#fff";
                // save[i].style.width = "100px";   
                save[i].style.height = "30px";

                edit_icon_js[i].style.display = "none";
            });
        }


        for (let i = 0; i < save.length; i++) {
            save[i].addEventListener("click", function (e) {

                save[i].innerHTML = "Hide";
                save[i].style.backgroundColor = "red";
                // edit_icon_js[i].style.display = "flex";
                const module_name = module_input_filed[i].value;
                const module_id = module_ID_filed[i].value;

                module_input_filed[i].value = module_name;

                updateModuleFun(module_name, module_id);
            });
        }


    }
    xhr.send();
}



function updateModuleHideShowFun (is_hidden, module_id) {

    const xhr = new XMLHttpRequest();

    xhr.open("GET", "updateModuleHideShow?is_hidden=" + is_hidden + "&moduleId=" + module_id, true);

    xhr.onload = function () {
        if (this.status === 200) {
            home.innerHTML = this.responseText;
        }

        const addSubject = document.getElementById("addSubject");
        const typeSubject = document.getElementById("typeSubject");

        const addModule = document.querySelectorAll(".addModule");
        const typeModule = document.querySelectorAll(".typeModule");
        const subjectId = document.querySelectorAll(".subjectId");

        addSubject.addEventListener("click", function () {
            addSubjectFun(typeSubject.value);
        })

        for (let i = 0; i < addModule.length; i++) {
            addModule[i].addEventListener("click", function () {
                addModuleFun(typeModule[i].value, subjectId[i].value);
            })
        }

        // ====================== UPDATE MODULE ==================================

        const module_input_filed = document.querySelectorAll(".module_input_filed");
        const edit_icon_js = document.querySelectorAll(".edit_icon_js");
        const module_ID_filed = document.querySelectorAll(".module_ID_filed");
        const subject = document.querySelectorAll(".subject");
        const subject_module_box = document.querySelectorAll(".subject_module_box");
        const save = document.querySelectorAll(".save");

        // const hideModule = document.querySelectorAll(".hideModule");
        const showHideBtn = document.querySelectorAll(".showHideBtn");
        const is_hidden_filed = document.querySelectorAll(".is_hidden_filed");


        // for (let i = 0; i < is_hidden_filed.length; i++) {
        //     if (is_hidden_filed[i].value == 1) {
        //         showHideBtn[i].innerHTML = "Show";
        //         showHideBtn[i].style.backgroundColor = "#19ca05e0"; // green
        //         showHideBtn[i].style.color = "#000";
        //     }
        //     if (is_hidden_filed[i].value == 0) {
        //         showHideBtn[i].innerHTML = "Hide";
        //         showHideBtn[i].style.backgroundColor = "#ff0000e0"; // red
        //         showHideBtn[i].style.color = "#fff";
        //     }
        // }

        // use ajax
        for (let i = 0; i < showHideBtn.length; i++) {
            showHideBtn[i].addEventListener("click", function () {
                if (is_hidden_filed[i].value == 1) {
                    updateModuleHideShowFun(0, module_ID_filed[i].value);
                    console.log("hide");
                }
                if (is_hidden_filed[i].value == 0) {
                    updateModuleHideShowFun(1, module_ID_filed[i].value);
                    console.log("show");
                }
            })
        }



        for (let i = 0; i < edit_icon_js.length; i++) {
            edit_icon_js[i].addEventListener("click", function () {
                module_input_filed[i].disabled = false;
                module_input_filed[i].style.borderRadius = "5px";
                module_input_filed[i].style.border = "2px dotted #000";
                module_input_filed[i].style.transition = "all 0.5s ease";
                module_input_filed[i].style.backgroundColor = "#fff";
                module_input_filed[i].style.color = "#000";
                module_input_filed[i].style.padding = "3px";
                module_input_filed[i].style.width = "100%";
                module_input_filed[i].style.height = "30px";



                save[i].innerHTML = "Save";
                save[i].style.backgroundColor = "blue";
                save[i].style.color = "#fff";
                // save[i].style.width = "100px";   
                save[i].style.height = "30px";

                edit_icon_js[i].style.display = "none";
            });
        }


        for (let i = 0; i < save.length; i++) {
            save[i].addEventListener("click", function (e) {

                save[i].innerHTML = "Hide";
                save[i].style.backgroundColor = "red";
                // edit_icon_js[i].style.display = "flex";
                const module_name = module_input_filed[i].value;
                const module_id = module_ID_filed[i].value;

                module_input_filed[i].value = module_name;

                updateModuleFun(module_name, module_id);
            });
        }

    }
    xhr.send();
}





// *========================================== PAYMENT PAGE ===========================================================


payment.addEventListener("click", () => {
    nav_link.forEach((link) => {
        link.classList.remove('active');
    })

    payment.classList.add('active');
    loadPayment();
})




function loadPayment () {

    console.log("load payment");

    const home = document.getElementById("home");

    const xhr = new XMLHttpRequest();
    xhr.open("GET", "payment", true);
    xhr.onload = function () {
        if (this.status === 200) {
            home.innerHTML = this.responseText;
        }

        /*  ================================ SHOW SELECTED TUTOR IN RIGHT SIDE DISPLAY  ================================*/

        const tutors = document.querySelectorAll('.tutor')
        const selectedTutor = document.getElementById('selected-tutor')
        const emptyPart = document.getElementById('empty-part')
        const tutorId = document.querySelectorAll('.tutorId')

        tutors.forEach((tutor) => {
            tutor.addEventListener('click', (e) => {

                selectedTutor.style.display = 'block'
                emptyPart.style.display = 'none'


                e.target.classList.add('selected')

                tutors.forEach((tutor) => {
                    if (tutor.classList.contains('selected') && tutor != e.target) {
                        tutor.classList.remove('selected')
                    }
                })

                const tutorId = e.target.querySelector('.tutorId').value


                const xhr = new XMLHttpRequest()
                xhr.open('GET', `selectedTutorDetails?selectedTutorId=${tutorId}`, true)

                xhr.onload = function () {
                    if (this.status === 200) {
                        var tutorDetails = JSON.stringify(this.responseText)
                        var tutorDetailsString = JSON.parse(tutorDetails)
                        var tutorDetailsObj = JSON.parse(tutorDetailsString)
                        console.log(typeof tutorDetailsObj);


                        selectedTutor.innerHTML = `
                                <div class="total-payoff">
                                    <div class="amount">
                                        <h2>Total Payoffs</h2>
                                        <h3>Rs. fgh</h3>
                                    </div>
                                    <div class="pay-button">
                                        <button>Pay For Tutor</button>
                                    </div>
                                </div>

                                <div class="paymentSlip-bankDetails">
                                    <div class="upload-payment-slip">
                                        <div class="bank-slip-uploader">
                                            <div class="header-section">
                                                <h1>Upload Bank Payment Slip</h1>
                                                <p>This this is payment slip will help to the when tutor</p>
                                                <p>PDF & Images are allowed</p>
                                            </div>
                                            <div class="drop-section">
                                                <div class="col-1" id="col-1">
                                                    <img src="upload.png" alt="upload"><br><br>
                                                    <span>Drag & Drop your files here</span><br><br>
                                                    <span>OR</span><br><br>
                                                    <label class="file-selector" for="browseFiles">Browse Files</label><br><br>
                                                    <input type="file" name="browseFiles" class="file-selector-input" id="browseFiles"
                                                        multiple hidden>
                                                </div>
                                                <div class="col-2" id="col-2">
                                                    <div class="drop-here">Drop Here</div>
                                                </div>
                                            </div>
                                            <div class="list-section" id="list-section">
                                                <div class="list">
                                                    <!-- <li class="in-prog" id="in-prog">
                                                        <div class='file-box'>
                                                            <div class='col'><img src='./pdf.png' alt=''></div>
                                                            <div class='details'>
                                                                <div class='file-name'>
                                                                    <div class='name'>file.name</div>
                                                                    <span>50%</span>
                                                                </div>
                                                                <div class='file-progress'><span></span></div>
                                                                <div class='file-size'>file.size</div>
                                                            </div>
                                                            <div class='icon'>
                                                                <i class="fa fa-trash"></i>
                                                                <i class='fa fa-circle-xmark'></i>
                                                            </div>
                                                        </div>
                                                    </li> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="bank-details">
                                        <div class="bank-details-title">
                                            <h3>Bank Details</h3>
                                        </div>
                                        <div class="bank-details-content">
                                            <div class="account-name">
                                                <div class="bank-details-content-title">
                                                    <h3>Account Name</h3>
                                                </div>
                                                <div class="bank-details-content-text">
                                                    <h3>ABC</h3>
                                                </div>
                                            </div>

                                            <div class="account-number">
                                                <div class="bank-details-content-title">
                                                    <h3>Account Number</h3>
                                                </div>
                                                <div class="bank-details-content-text">
                                                    <h3>123456789</h3>
                                                </div>
                                            </div>

                                            <div class="bank-name">
                                                <div class="bank-details-content-title">
                                                    <h3>Bank Name</h3>
                                                </div>
                                                <div class="bank-details-content-text">
                                                    <h3>Bank of Ceylon</h3>
                                                </div>
                                            </div>

                                            <div class="branch-name">
                                                <div class="bank-details-content-title">
                                                    <h3>Branch Name</h3>
                                                </div>
                                                <div class="bank-details-content-text">
                                                    <h3>${tutorDetailsObj.bank_branch}</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <div class="class-details-table">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th id="subject-thead">Student</th>
                                                <th>Subject</th>
                                                <th>Lesson</th>
                                                <th>Day</th>
                                                <th>Method</th>
                                                <th id="classFees-thead">Class Fess</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr>
                                                <td>Viraj Sandakelum</td>
                                                <td>Maths</td>
                                                <td>1</td>
                                                <td>Monday</td>
                                                <td>Online</td>
                                                <td>Rs. 1350.00</td>
                                            </tr>

                                            <tr>
                                                <td>Viraj Sandakelum</td>
                                                <td>Maths</td>
                                                <td>1</td>
                                                <td>Monday</td>
                                                <td>Online</td>
                                                <td>Rs. 1350.00</td>
                                            </tr>

                                            <tr>
                                                <td>Viraj Sandakelum</td>
                                                <td>Maths</td>
                                                <td>1</td>
                                                <td>Monday</td>
                                                <td>Online</td>
                                                <td>Rs. 1350.00</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>`

                    }
                }

                xhr.send()




            })
        })
    }

    xhr.send();
}




// *========================================== TUTOR PAGE ===========================================================


tutor.addEventListener("click", () => {
    nav_link.forEach((link) => {
        link.classList.remove('active');
    })

    tutor.classList.add('active');

    loadTutor();
})




function loadTutor () {
    const home = document.getElementById("home");

    const xhr = new XMLHttpRequest();
    xhr.open("GET", "tutor", true);

    xhr.onload = function () {
        if (this.status === 200) {
            home.innerHTML = this.responseText;
        }

        // load the tutor js file
        const menu_1 = document.getElementsByClassName('menu-1');
        const menu_2 = document.getElementsByClassName('menu-2');
        const menu_3 = document.getElementsByClassName('menu-3');

        const info_1 = document.getElementsByClassName('info-1');
        const info_2 = document.getElementsByClassName('info-2');
        const info_3 = document.getElementsByClassName('info-3');


        for (let i = 0; i < menu_1.length; i++) {
            info_1[i].style.display = 'block';
            info_2[i].style.display = 'none';
            info_3[i].style.display = 'none';
        }

        for (let i = 0; i < menu_1.length; i++) {
            menu_1[i].style.backgroundColor = 'white';
        }


        for (let i = 0; i < menu_1.length; i++) {
            menu_1[i].addEventListener('click', function () {
                info_1[i].style.display = 'block';
                info_2[i].style.display = 'none';
                info_3[i].style.display = 'none';
                menu_1[i].style.backgroundColor = 'white';
                menu_2[i].style.backgroundColor = '#fc941d93';
                menu_3[i].style.backgroundColor = '#fc941d93';

            });
        }


        for (let i = 0; i < menu_1.length; i++) {
            menu_2[i].addEventListener('click', function () {
                info_1[i].style.display = 'none';
                info_2[i].style.display = 'block';
                info_3[i].style.display = 'none';
                menu_1[i].style.backgroundColor = '#fc941d93';
                menu_2[i].style.backgroundColor = 'white';
                menu_3[i].style.backgroundColor = '#fc941d93';
            });
        }


        for (let i = 0; i < menu_1.length; i++) {
            menu_3[i].addEventListener('click', function () {
                info_1[i].style.display = 'none';
                info_2[i].style.display = 'none';
                info_3[i].style.display = 'block';
                menu_1[i].style.backgroundColor = '#fc941d93';
                menu_2[i].style.backgroundColor = '#fc941d93';
                menu_3[i].style.backgroundColor = 'white';
            });
        }


        // -------------------------HIDE SHOW BUTTON---------------------------------------

        const btn = document.querySelectorAll('.btn');
        const hide = document.querySelectorAll('.hide');
        const show = document.querySelectorAll('.show');

        for (let i = 0; i < hide.length; i++) {
            hide[i].addEventListener('click', function () {
                btn[i].style.left = '42px';
                btn[i].style.backgroundColor = 'red';
                btn[i].style.borderTopRightRadius = '30px';
                btn[i].style.borderBottomRightRadius = '30px';
                btn[i].style.borderTopLeftRadius = '0px';
                btn[i].style.borderBottomLeftRadius = '0px';
                hide[i].style.color = 'white';
            });
        }

        for (let i = 0; i < show.length; i++) {
            show[i].addEventListener('click', function () {
                btn[i].style.left = '0px';
                btn[i].style.backgroundColor = '#6ab04c';
                btn[i].style.borderTopRightRadius = '0px';
                btn[i].style.borderBottomRightRadius = '0px';
                btn[i].style.borderTopLeftRadius = '30px';
                btn[i].style.borderBottomLeftRadius = '30px';
                hide[i].style.color = 'black';
            });
        }

        // -------------------------CARD SHOW PROFILE BUTTON---------------------------------------

        const profilePicture = document.querySelectorAll('.profile-picture');
        const cardBlurEffect = document.querySelectorAll('.card-blur-effect');
        const card = document.querySelectorAll('.card');
        const viewProfileBtn = document.querySelectorAll('.view-profile-btn');



        for (let i = 0; i < card.length; i++) {
            card[i].addEventListener('mouseenter', function () {
                cardBlurEffect[i].style.height = '59.5%';
                viewProfileBtn[i].style.zIndex = '10';
            });
        }

        for (let i = 0; i < card.length; i++) {
            card[i].addEventListener('mouseleave', function () {
                cardBlurEffect[i].style.height = '0%';
                viewProfileBtn[i].style.zIndex = '-1';
            });
        }

        // ------------------------- TUTOR VIEW PROFILE BUTTON  ---------------------------------------

        const view_profile_btn = document.querySelectorAll('.view-profile-btn');

        view_profile_btn.forEach((viewProfile) => {
            viewProfile.addEventListener('click', function () {
                console.log('clicked');
                const xhr = new XMLHttpRequest();
                xhr.open("GET", "viewTutorProfile", true);

                xhr.onload = function () {
                    if (this.status === 200) {
                        home.innerHTML = this.responseText;
                    }


                    // --------------------MENU SELECTION----------------------------------------

                    const finished_classes = document.querySelectorAll('.finished-classes');
                    const active_classes = document.querySelectorAll('.active-classes');
                    const tutor_info = document.querySelectorAll('.tutor-info');


                    const info_btn = document.querySelectorAll('.info-btn');
                    const active_class_btn = document.querySelectorAll('.active-class-btn');
                    const finished_class_btn = document.querySelectorAll('.finished-class-btn');


                    tutor_info[0].style.display = 'flex';

                    info_btn[0].addEventListener('click', function () {
                        tutor_info[0].style.display = 'flex';
                        active_classes[0].style.display = 'none';
                        finished_classes[0].style.display = 'none';
                    });

                    active_class_btn[0].addEventListener('click', function () {
                        tutor_info[0].style.display = 'none';
                        active_classes[0].style.display = 'grid';
                        finished_classes[0].style.display = 'none';
                    });

                    finished_class_btn[0].addEventListener('click', function () {
                        tutor_info[0].style.display = 'none';
                        active_classes[0].style.display = 'none';
                        finished_classes[0].style.display = 'grid';
                    });
                }

                xhr.send();
            })
        })


    }
    xhr.send();
}



// *========================================== STUDENT PAGE ===========================================================


student.addEventListener("click", () => {
    nav_link.forEach((link) => {
        link.classList.remove('active');
    })

    student.classList.add('active');
    loadStudent();
})


function loadStudent () {

    const home = document.getElementById("home");

    const xhr = new XMLHttpRequest();

    xhr.open("GET", "student", true);

    xhr.onload = function () {
        if (this.status === 200) {
            home.innerHTML = this.responseText;
        }


        // ------------------------- TUTOR VIEW PROFILE BUTTON  ---------------------------------------

        const view_student_profile_btn = document.querySelectorAll('.view-student-profile-btn');

        view_student_profile_btn.forEach((viewStudentProfile) => {
            viewStudentProfile.addEventListener('click', function () {
                const xhr = new XMLHttpRequest();
                xhr.open("GET", "viewStudentProfile", true);

                xhr.onload = function () {
                    if (this.status === 200) {
                        home.innerHTML = this.responseText;
                    }

                    // --------------------MENU SELECTION----------------------------------------

                    const finished_classes = document.querySelectorAll('.finished-classes');
                    const active_classes = document.querySelectorAll('.active-classes');
                    const student_info = document.querySelectorAll('.student-info');


                    const info_btn = document.querySelectorAll('.info-btn');
                    const active_class_btn = document.querySelectorAll('.active-class-btn');
                    const finished_class_btn = document.querySelectorAll('.finished-class-btn');


                    student_info[0].style.display = 'flex';

                    info_btn[0].addEventListener('click', function () {
                        student_info[0].style.display = 'flex';
                        active_classes[0].style.display = 'none';
                        finished_classes[0].style.display = 'none';
                    });

                    active_class_btn[0].addEventListener('click', function () {
                        student_info[0].style.display = 'none';
                        active_classes[0].style.display = 'grid';
                        finished_classes[0].style.display = 'none';
                    });

                    finished_class_btn[0].addEventListener('click', function () {
                        student_info[0].style.display = 'none';
                        active_classes[0].style.display = 'none';
                        finished_classes[0].style.display = 'grid';
                    });
                }

                xhr.send();
            })
        })

    }

    xhr.send();
}




// *========================================== NOTIFICATION PAGE ===========================================================


notification.addEventListener("click", () => {
    nav_link.forEach((link) => {
        link.classList.remove('active');
    })

    notification.classList.add('active');

    loadNotification();
})



function loadNotification () {

    const home = document.getElementById("home");

    const xhr = new XMLHttpRequest();

    xhr.open("GET", "notification", true);

    xhr.onload = function () {
        if (this.status === 200) {
            home.innerHTML = this.responseText;
        }

        // load the tutor js file
        const script = document.createElement('script');
        script.src = "../notification/notification.js";
        document.head.prepend(script);
    }

    xhr.send();
}
