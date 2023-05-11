const body = document.querySelector('body'),
    sidebar = body.querySelector('nav'),
    toggle = body.querySelector(".toggle"),
    searchBtn = body.querySelector(".search-box"),
    modeSwitch = body.querySelector(".toggle-switch"),
    modeText = body.querySelector(".mode-text"),
    container = body.querySelector(".container"),
    homebtn = body.querySelector(".home"),
    notifybtn = body.querySelector(".notify"),
    notification = body.querySelector(".notification"),
    classbtn = body.querySelector(".myclass"),
    classcontent = body.querySelector(".classes")


toggle.addEventListener("click", () => {
    sidebar.classList.toggle("close");
    container.classList.toggle("close");
    notification.classList.toggle("close");
    classcontent.classList.toggle("close");

})






modeSwitch.addEventListener("click", () => {
    body.classList.toggle("dark");

    if (body.classList.contains("dark")) {
        modeText.innerText = "Light mode";
    }else {
        modeText.innerText = "Dark mode";

    }
});


