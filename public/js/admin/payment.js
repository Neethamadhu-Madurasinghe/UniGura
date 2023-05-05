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


const blur_filter = document.getElementById('blur-filter');
blur_filter.style.display = "none";


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









// function loadFileUploader () {

//     const file_selector_input = document.querySelectorAll('.file-selector-input')
//     const drop_section = document.querySelectorAll('.drop-section')
//     const col_1 = document.getElementById('col-1')
//     const col_2 = document.getElementById('col-2')
//     const list_section = document.getElementById('list-section')
//     const list = document.querySelector('.list')
//     // const in_prog = document.getElementById('in-prog')
//     // const fileIcon = document.querySelectorAll('.fileIcon')





//     file_selector_input.forEach((input) => {
//         input.addEventListener('change', (e) => {
//             const file = e.target.files

//             for (i = 0; file.length > i; i++) {
//                 const file_type = file[i].type

//                 if (typeValidation(file_type)) {
//                     uploadFile(file[i])
//                 } else {
//                     console.log('File type is not valid')
//                 }
//             }
//         })
//     })

//     function typeValidation (type) {
//         let splitType = type.split('/')[0];
//         if (type == 'application/pdf' || splitType == 'image' || splitType == 'video') {
//             return true;
//         } else {
//             return false;
//         }
//     }

//     drop_section.forEach((drop) => {
//         drop.addEventListener('dragover', (e) => {
//             e.preventDefault()
//             col_1.style.opacity = '0'
//             col_2.style.opacity = '1'
//             col_2.style.zIndex = '1'
//         }
//         )
//     })

//     drop_section.forEach((drop) => {
//         drop.addEventListener('dragleave', (e) => {
//             e.preventDefault()
//             col_1.style.opacity = '1'
//             col_2.style.opacity = '0'
//             col_2.style.zIndex = '-1'
//         }
//         )
//     })


//     drop_section.forEach((drop) => {
//         drop.addEventListener('drop', (e) => {
//             col_1.style.opacity = '1'
//             col_2.style.opacity = '0'
//             col_2.style.zIndex = '-1'


//             e.preventDefault();
//             const file = e.dataTransfer.files

//             for (i = 0; file.length > i; i++) {
//                 const file_type = file[i].type

//                 if (typeValidation(file_type)) {
//                     uploadFile(file[i])
//                 } else {
//                     console.log('File type is not valid')
//                 }
//             }

//         })
//     })



//     function uploadFile (file) {

//         list_section.style.display = 'block'
//         let li = document.createElement('li')
//         li.classList.add('in-prog')

//         li.innerHTML = ` 
//             <div class='file-box'>
//                 <div class='col'><img src='<?php echo URLROOT; ?>/public/img/admin/pdf-upload-image.png' alt='image'></div>
//                 <div class='details'>
//                     <div class='file-name'>
//                         <div class='name'>${file.name}</div>
//                         <span>50%</span>
//                     </div>
//                     <div class='file-progress'><span></span></div>
//                     <div class='file-size'>${(file.size / (1024 * 1024)).toFixed(2)} MB</div>
//                 </div>
//                 <div class='icon'>
//                 </div>
//             </div>`

//         list.appendChild(li)
//         const http = new XMLHttpRequest();
//         let data = new FormData();
//         data.append('file', file);

//         http.onload = function () {
//             if (this.status == 405) {
//                 document.querySelector('.icon').innerHTML = '<i class="fa-solid fa-circle-check"></i>  <i class="fa-solid fa-trash"></i>'
//             }
//         }

//         http.upload.addEventListener('progress', (event) => {
//             document.querySelector('.icon').innerHTML = '<i class="fa-solid fa-circle-xmark"></i>'

//             let percentComplete = (event.loaded / event.total) * 100;
//             li.querySelectorAll('span')[0].innerHTML = Math.round(percentComplete) + '%'
//             li.querySelectorAll('span')[1].style.width = Math.round(percentComplete) + '%'

//             document.querySelector('.icon').querySelector('.fa-circle-xmark').addEventListener('click', () => {
//                 http.abort()
//                 li.remove()
//             })
//         })


//         http.open('POST', 'uploads', true);
//         http.send(data);

//     }

// }
