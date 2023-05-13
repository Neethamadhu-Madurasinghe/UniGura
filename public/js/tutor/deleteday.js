let data = JSON.parse(data_string);

    let input_dayid = document.getElementById('id');
    input_dayid.setAttribute('value',data.id);
    
    let input_cid =  document.getElementById('cid');
    input_cid.setAttribute('value',data.course_id);
    

    let closebtn = document.querySelector(".close");

    closebtn.addEventListener('click',()=>{
        window.location = `${root}/tutor/viewcourse?id=${data.course_id}`
    });
