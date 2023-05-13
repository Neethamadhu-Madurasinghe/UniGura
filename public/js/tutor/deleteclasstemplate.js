let data = JSON.parse(data_string);

    let input_dayid = document.getElementById('id');
    input_dayid.setAttribute('value',data.id);

    let closebtn = document.querySelector(".close");

    closebtn.addEventListener('click',()=>{
        window.location = `${root}/tutor/dashboard`
    });
