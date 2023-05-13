//Initializing Variables

    //geting backed data as a json string and converting JSON string to JavaScript object

   
    let data = JSON.parse(data_string);
    let days = data.days;
    let activities = data.activities;



    //seperate the data and asign to html values


    let module_text = document.getElementById('module');
    let subject_text = document.getElementById('subject');
    let mode_text = document.getElementById('mode');
    let create_day_btn = document.querySelector('.button1');
    let publish_btn = document.getElementById('publish');

    let day_container = document.getElementById('sortable');

    //popup elements
    let pop_up_message = document.getElementById("message");
    let popupOverlay = document.getElementById('popup');
    let pop_upclose_btn = document.getElementById("close-btn");

    pop_upclose_btn.addEventListener('click', () => {
        popupOverlay.style.display = 'none';
    })

    module_text.innerText = data.module;
    subject_text.innerText = data.subject;
    mode_text.innerText = data.mode;




    // Main Button Setup 

    //1. Close Button - Redirect Back to the dashboard

    let close_btn = document.querySelector('#close-course');
    close_btn.addEventListener('click', () => {
        window.location = `${root}/tutor/dashboard`;
    })

    //2. Create a Day_Template

    create_day_btn.addEventListener('click', function() {
        window.location = `${root}/tutor/createday?class_template_id=${data.id}&subject=${data.subject}&module=${data.module}`
    })

    //3. Publish/Unpublish Button Setup
    let publish_state;

    if (data.is_hidden == 1) {
        publish_btn.innerText = 'Hide'
        publish_state = 0;

    } else {
        publish_btn.innerText = 'Publish'
        publish_state = 1;
    }

    //4. Publish a Class_template

    publish_btn.addEventListener('click', () => {
        fetch(`${root}/tutor/change-classtemplate-status`, {
                method: 'POST',
                body: JSON.stringify({
                    course_id: data.id,
                    tutor_id: data.tutor_id,
                    is_hidden: publish_state
                })
            })
            .then(function(response) {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.text();
            })
            .then(function(responseText) {
                popupOverlay.style.display = 'block';
                if (publish_state == 0) {
                    pop_up_message.innerText = `Your ${data.module} Course Hidded Succesfully!`;
                    publish_btn.innerText = 'Publish'
                    publish_state = 1;
                } else {
                    pop_up_message.innerText = `Your ${data.module} Course Published Succesfully!`;
                    publish_btn.innerText = 'Hide'
                    publish_state = 0;
                }

            })
            .catch(function(error) {
                console.error('Error retrieving data:', error);

            });
    })

    //Adding Days Dynamicaly into the course container

    days.forEach(day => {
        let activity_item = '';

        activities.forEach(activity => {
            console.log(activity_item)
            if (activity.day_template_id == day.id) {
                if (activity.type == 0) {
                    activity_item += `<div class="activity-container">
                                         <i class="fas fa-file"></i>
                                         <a class="activity-anchor" href="${root}/tutor/viewactivitydoc?file=${activity.link}">${activity.description}</a>
                                         <div class="delete-btn" data-activityid = ${activity.id}><i class="fas fa-trash-alt"></i></div>
                                    </div>
                                        `

                } else if(activity.type == 1){
                    activity_item += `<div class="activity-container">
                                        <i class="fas fa-paper-plane"></i>
                                         <a class="activity-anchor">${activity.description}</a>
                                         <div class="delete-btn"  data-activityid = ${activity.id}><i class="fas fa-trash-alt"></i></div>
                                    </div>`
                }else if(activity.type == 2){
                    activity_item += `<div class="activity-container">
                                        <i class="fas fa-comment"></i>
                                         <a class="activity-anchor">${activity.description}</a>
                                         <div class="delete-btn"  data-activityid = ${activity.id}><i class="fas fa-trash-alt"></i></div>
                                    </div>`
                }
            }
        })

        day_container.innerHTML +=
            `<div class='day' draggable='true' id = ${day.id}>
            <div class='day_box' style='margin-top: 0px;'>
                <div class='day-heading'>
                     <h4>${day.title}</h4>
                </div>
                <div class='textbox_one' data-id = ${day.id}>
                        ${activity_item}
                </div>
            </div>
            <div class='button_box'>
                <button class='left add-activity' data-dayid=${day.id} ><i class='fa-solid fa-plus'></i></button>
                <button class='middle update-day' data-dayid = ${day.id}><i class='fa-solid fa-pen'></i></button>
                <button class='right delete-day' data-dayid = ${day.id}><i class='fa-solid fa-trash'></i></button>
            </div>
        </div>
        `
    });

    //5.Add Activity btns setup




    let addactivitybtns = document.querySelectorAll(".add-activity");

    addactivitybtns.forEach(btn => {
        btn.addEventListener('click', function() {
            window.location = `${root}/tutor/addactivity?id=${this.dataset.dayid}&subject=${data.subject}&module=${data.module}&course_id=${data.id}`;
        })
    })

    //6. Update Activity btns Setpu


    let updatedaybtns = document.querySelectorAll(".update-day");

    updatedaybtns.forEach(btn => {
        btn.addEventListener('click', function() {
            window.location = `${root}/tutor/updateday?id=${this.dataset.dayid}&subject=${data.subject}&module=${data.module}&course_id=${data.id}`;
        })
    })

    //7. Delete day Btn

    let deletedaybtns = document.querySelectorAll(".delete-day");

    deletedaybtns.forEach(btn => {
        btn.addEventListener('click', function() {
            window.location = `${root}/tutor/deleteday?id=${this.dataset.dayid}&subject=${data.subject}&module=${data.module}&course_id=${data.id}`;
        })
    })
    //Show all the activities for a particullar day

    let document_containers = document.querySelectorAll(".textbox_one");

    //Changing the position of the day elements dynamicaly

    var draggableItems = document.querySelectorAll("#sortable .day");
    var draggingItem = null;
    var originalIndex = null;

    // Define a data object to store the position of the elements
    var positionData = {};

    // Initialize the data object with the initial position of the elements
    for (var i = 0; i < draggableItems.length; i++) {
        positionData[draggableItems[i].id] = i + 1;
    }

    for (var i = 0; i < draggableItems.length; i++) {
        draggableItems[i].addEventListener("dragstart", function(e) {
            draggingItem = this;
            originalIndex = Array.prototype.indexOf.call(this.parentNode.children, this);
        });

        draggableItems[i].addEventListener("dragover", function(e) {
            e.preventDefault();
            this.style.backgroundColor = "lightgray";
        });

        draggableItems[i].addEventListener("dragleave", function(e) {
            this.style.backgroundColor = "";
        });

        draggableItems[i].addEventListener("drop", function(e) {
            if (draggingItem !== this) {
                var newIndex = Array.prototype.indexOf.call(this.parentNode.children, this);
                var temp = this.id;
                this.id = draggingItem.id;
                draggingItem.id = temp;

                var temphtml = this.innerHTML;
                this.innerHTML = draggingItem.innerHTML;
                draggingItem.innerHTML = temphtml;

                draggableItems[originalIndex].style.backgroundColor = "";
                originalIndex = newIndex;
                console.log(originalIndex);

                // Update the position data object with the new position of the elements
                var tempPositionData = {};

                for (var i = 0; i < draggableItems.length; i++) {
                    tempPositionData[draggableItems[i].id] = i + 1;
                }
                positionData = tempPositionData;
                console.log(positionData);
                sendPositon(positionData);
            }
            this.style.backgroundColor = "";
        });
    }

    //Fetch Requests... 

    //1. Sending positions dynamicaly to the database.


    function sendPositon(position_list) {
        fetch(`${root}/tutor/sendposition`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    data: position_list
                })
            })
            .then(response => response.json())
            .then(data => {
                console.log('Success:');
            })
            .catch((error) => {
                console.error('Have Error');
            });
    }

    //2. Deleting Activities

    let deleteactivitybtns = document.querySelectorAll(".delete-btn");

    deleteactivitybtns.forEach(btn => {
        btn.addEventListener('click', function() {
            fetch(`${root}/tutor/delete-activity-in-class-template`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    activity_id : parseInt(this.dataset.activityid),
                    tutor_id : data.tutor_id
                })
            })
            .then(function(response) {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.text();
            })
            .then(data => {
                popupOverlay.style.display = 'block';
                pop_up_message.innerText = `Activity Successfully Deleted`;
                this.parentElement.style.display = 'none'
            })
            .catch((error) => {
                console.error('Have Error', error);
            });

        })
    })