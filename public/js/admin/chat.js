// *========================================== CHAT PAGE ===========================================================



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




const chat = document.getElementById('chat');
const nav_link = document.querySelectorAll(".nav-link");



nav_link.forEach((link) => {
    link.classList.remove('active');
})

chat.classList.add('active');




