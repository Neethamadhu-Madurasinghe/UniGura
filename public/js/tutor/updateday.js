let data = JSON.parse(data_string);
    let input_cid =  document.getElementById('cid');
    let input_dayid = document.getElementById('id');
    let input_title =  document.getElementById('title');
    let closebtn = document.querySelector(".close");

    input_dayid.setAttribute('value',data.id);
    input_cid.setAttribute('value',data.course_id);
    input_title.setAttribute('value',data.title);
    

    closebtn.addEventListener('click',()=>{
        window.location = `${root}/tutor/viewcourse?id=${data.course_id}`
    });