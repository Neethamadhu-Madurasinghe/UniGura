
// *========================================== NOTIFICATION PAGE ===========================================================


const body = document.querySelector('body'),
    sidebar = body.querySelector('nav'),
    toggle = body.querySelector(".toggle"),
    searchBtn = body.querySelector(".search-box"),
    modeSwitch = body.querySelector(".toggle-switch"),
    modeText = body.querySelector(".mode-text");




const notification = document.getElementById('notification');
const nav_link = document.querySelectorAll(".nav-link");


nav_link.forEach((link) => {
    link.classList.remove('active');
})

notification.classList.add('active');




const notification_close_btn = document.querySelectorAll('.notification-close-btn');


notification_close_btn.forEach((closeBtn) => {
    closeBtn.addEventListener('click', function (event) {

        let notificationID = event.target.getAttribute('notificationID');

        console.log(notificationID);

        const xhr = new XMLHttpRequest();
        xhr.open("GET", "notification/clearNotification?notificationID=" + notificationID, true);

        xhr.onload = function () {
            if (this.status === 200) {
                body.innerHTML = this.responseText;
            }


            const notification = document.getElementById('notification');
            const nav_link = document.querySelectorAll(".nav-link");

            nav_link.forEach((link) => {
                link.classList.remove('active');
            })

            notification.classList.add('active');


        }

        xhr.send();

    })
})

