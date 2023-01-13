const module_input_filed = document.querySelectorAll(".module_input_filed");
const edit_icon_js = document.querySelectorAll(".edit_icon_js");
const module_ID_filed = document.querySelectorAll(".module_ID_filed");
const subject = document.querySelectorAll(".subject");
const subject_module_box = document.querySelectorAll(".subject_module_box");
const save = document.querySelectorAll(".save");

// const hideModule = document.querySelectorAll(".hideModule");
const showModule = document.querySelectorAll(".showModule");
const is_hidden_filed = document.querySelectorAll(".is_hidden_filed");


for (let i = 0; i < is_hidden_filed.length; i++) {
    if (is_hidden_filed[i].value == 1) {
        showModule[i].innerHTML = "Show"; 
        showModule[i].style.backgroundColor = "#19ca05e0"; // green
        showModule[i].style.color = "#000";
    }
    if (is_hidden_filed[i].value == 0) {
        showModule[i].innerHTML = "Hide";
        showModule[i].style.backgroundColor = "#ff0000"; // red
        showModule[i].style.color = "#fff";
    }
}

// use ajax
for (let i = 0; i < showModule.length; i++) {
    showModule[i].addEventListener("click", function () {
        if (is_hidden_filed[i].value == 1) {
            window.location.href = "../includes/updateHideShow.inc.php?is_hidden=0&module_id=" + module_ID_filed[i].value;
        }
        if (is_hidden_filed[i].value == 0) {
            window.location.href = "../includes/updateHideShow.inc.php?is_hidden=1&module_id=" + module_ID_filed[i].value;
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

        window.location.href = "../includes/updateModule.inc.php?module_name=" + module_name + "&module_id=" + module_id;


        // e.preventDefault();

        // const xhhtp = new XMLHttpRequest();

        // xhhtp.open("GET", "../includes/updateModule.inc.php?module_name=" + module_name + "&module_id=" + module_id, true);

        // xhhtp.onload = function () {
        //     if (this.status === 200) {
        //         console.log(this.responseText);
        //     }
        // }

        // xhhtp.send();


    });
}


// -------------------------SIDE BAR -----------------------------------------------------

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

modeSwitch.addEventListener("click", () => {
    body.classList.toggle("dark");

    if (body.classList.contains("dark")) {
        modeText.innerText = "Light mode";
    } else {
        modeText.innerText = "Dark mode";

    }
});