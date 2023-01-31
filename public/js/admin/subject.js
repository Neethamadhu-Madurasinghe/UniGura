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




// *========================================== SUBJECT PAGE ===========================================================

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





function addSubjectFun (subject) {

    const xhr = new XMLHttpRequest();

    xhr.open("GET", "addSubject?subjectName=" + subject, true);

    xhr.onload = function () {
        if (this.status === 200) {
            body.innerHTML = this.responseText;
            // console.log(this.responseText);
        }

        const subjectPage = document.getElementById('subject');
        const nav_link = document.querySelectorAll(".nav-link");

        nav_link.forEach((link) => {
            link.classList.remove('active');
        })

        subjectPage.classList.add('active');


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

        const showHideBtn = document.querySelectorAll(".showHideBtn");
        const is_hidden_filed = document.querySelectorAll(".is_hidden_filed");



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
            body.innerHTML = this.responseText;
            // console.log(this.responseText);
        }


        const subjectPage = document.getElementById('subject');
        const nav_link = document.querySelectorAll(".nav-link");



        nav_link.forEach((link) => {
            link.classList.remove('active');
        })

        subjectPage.classList.add('active');




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
            body.innerHTML = this.responseText;
        }



        const subjectPage = document.getElementById('subject');
        const nav_link = document.querySelectorAll(".nav-link");



        nav_link.forEach((link) => {
            link.classList.remove('active');
        })

        subjectPage.classList.add('active');



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
            body.innerHTML = this.responseText;
        }


        const subjectPage = document.getElementById('subject');
        const nav_link = document.querySelectorAll(".nav-link");



        nav_link.forEach((link) => {
            link.classList.remove('active');
        })

        subjectPage.classList.add('active');



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
