let data = JSON.parse(data_string);
let input_cid = document.getElementById('cid');
let input_dayid = document.getElementById('id');
let input_subject = document.getElementById('subject');
let input_module = document.getElementById('module');
let closebtn = document.querySelector('.close')


input_dayid.setAttribute('value', data.id);
input_cid.setAttribute('value', data.c_id);
input_subject.setAttribute('value', data.subject);
input_module.setAttribute('value', data.module);


closebtn.addEventListener('click', function() {
     window.location = `http://localhost/unigura/tutor/viewcourse?id=${data.c_id}&subject=${data.subject}&module=${data.module}`;
})

const select = document.getElementById('type');
const upload_btn = document.querySelector('.upload_label');
const title = document.getElementById('title');

select.addEventListener('change', () => {
     // Get the selected value
     const selectedValue = select.value;
     // Show/hide the divs based on the selected value
     if (selectedValue === '0') {
          upload_btn.style.display = 'block';
     } else if (selectedValue === '1') {
          upload_btn.style.display = 'none';
     } else if (selectedValue === '2') {
          upload_btn.style.display = 'none';

     } else {

     }
});

let file_upload = document.getElementById('activity-doc');
file_upload.addEventListener('change',()=>{
    document.querySelector('.upload_label').innerHTML = `<i class="fas fa-check-circle"></i>`
})