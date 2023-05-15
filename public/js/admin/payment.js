// *========================================== PAYMENT PAGE ===========================================================



const body = document.querySelector('body'),
    sidebar = body.querySelector('nav'),
    toggle = body.querySelector(".toggle"),
    searchBtn = body.querySelector(".search-box"),
    modeSwitch = body.querySelector(".toggle-switch"),
    modeText = body.querySelector(".mode-text");





const payment = document.getElementById('payment');
const nav_link = document.querySelectorAll(".nav-link");

nav_link.forEach((link) => {
    link.classList.remove('active');
})

payment.classList.add('active');




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
                selectedTutor.innerHTML = this.responseText
            }
            loadFileUploader();
        }

        xhr.send()

    })
})



/* --------------------------- Empty bank slip POPUP ERROR MESSAGE -------------------------------- */


const popup = document.getElementById('popup');
const closePopupBtn = document.getElementById('closePopup');
const container = document.getElementById('container');

closePopupBtn.addEventListener("click", function () {
    popup.style.display = "none";
    blur_filter.style.display = "none";

})



var blurElement = document.querySelector(".popup");

if (blurElement) {
    blur_filter.style.display = "block";
}

