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


nav_link.forEach((link) => {
    link.classList.remove('active');
})

request_complaint.classList.add('active');
