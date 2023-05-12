const classCardContainerUI = document.querySelector('.class-card-container');
const subjectFilterUI = document.getElementById('sort-subject');
const completionFilterUI = document.getElementById('sort-completion');
const paymentFilterUI = document.getElementById('sort-payment');
const addNewClassButtonContainerUI = document.querySelector('.add-new-class-button-container');

// Sends a get request to fetch the classes of student
async function sendClassListRequest() {
    const body = {
        'sort-subject': subjectFilterUI.value,
        'sort-completion': completionFilterUI.value,
        'sort-payment': paymentFilterUI.value
    }

    const response = await fetch('http://localhost/unigura/api/get-class?' + new URLSearchParams(body), {
        credentials: "include",
        headers: {
            'Content-Type': 'application/json'
        }
    });

    let tutoringClasses = (await response.json()).tutoring_classes;
    console.log(tutoringClasses);

    // Disable filters and show no Classes message if there are no records
    if (subjectFilterUI.value === 'all' &&
        completionFilterUI.value === 'all' &&
        paymentFilterUI.value === 'all' &&
        tutoringClasses.length === 0) {
        subjectFilterUI.disabled = true;
        completionFilterUI.disabled = true;
        paymentFilterUI.disabled = true;

    } else {
        subjectFilterUI.disabled = false;
        completionFilterUI.disabled = false;
        completionFilterUI.disabled = false;

        classCardContainerUI.innerHTML = '';


        // Additional fields into class cards
        tutoringClasses = tutoringClasses.map(tutoringClass => {
            tutoringClass.class_type = tutoringClass.class_type.charAt(0).toUpperCase() + tutoringClass.class_type.slice(1);
            if (!tutoringClass.profile_picture) {
                tutoringClass['profile_picture'] = '/public/img/common/profile.png';
            }
            console.log(tutoringClass)
            if (tutoringClass.day_count > 0) {
                tutoringClass['completion'] = Math.round((tutoringClass.day_count - tutoringClass.incomplete_day_count) * 100 / tutoringClass.day_count);
            }else {
                tutoringClass['completion'] = 100;
            }

            return tutoringClass;
        })

        // Sort class carded according to completion percentage
        tutoringClasses.sort((tutoringClass1, tutoringClass2) => tutoringClass1.completion - tutoringClass2.completion);

        tutoringClasses.forEach(tutoringClass => {
            classCardContainerUI.innerHTML += `
            <div class="class-card">
                <div class="class-card-top-section">
                    <h2>${tutoringClass.module_name} ${tutoringClass.class_type}</h2>
                    <h4>${tutoringClass.subject_name}</h4>
                 </div>
                 
                 <div class="class-card-bottom-section">
                    <div class="name-row">
                        <div class="class-card-name-pic-container">
                            <div class="class-card-profile-picture-container">
                                <img src="${'http://localhost/unigura/' + tutoringClass.profile_picture}" alt="" srcset="">
                            </div>
                            
                            <p>${tutoringClass.first_name} ${tutoringClass.last_name}</p>
                        </div>
                        
                        <div class="class-card-payment-due-container">
                            <img
                                src="${'http://localhost/unigura//public/img/common/money 1.png'}"
                                class="${tutoringClass.payment_due_day_count > 0 ?
                                        "payment-due-image" :
                                        "payment-due-image-hidden"}"
                                title="Payment due"
                                >
                                
                        </div>
                    </div>

                    <div class="progress-bar-row">
                        <p>${tutoringClass['completion']}% Completed</p>
                        <div class="progress-bar-outer">
                            <div class="progress-bar-inner" style="width: ${tutoringClass['completion']}%"></div>
                        </div>
                    </div>
                    
                    <a class="btn btn-enter-class" href="http://localhost/UniGura/student/tutoring-class?id=${tutoringClass.id}">Enter</a>
                </div>
            </div>`;
        });

        // Add an extra card like element to add a new card
        classCardContainerUI.innerHTML += `
        <div class="class-card class-card-add-new">
            <h2>Add A New Class</h2>
            <a href="http://localhost/UniGura/student/find-tutor" class="add-new-class-button">
                <img src="http://localhost/UniGura/public/img/student/plus 1.png" alt="">
            </a>
        </div>
        `;

    //    Remove add a new class button - will be showen if there is no class to be shown at the beginning
        addNewClassButtonContainerUI.remove();
    }


}

window.onload = function() {
    sendClassListRequest();
};

subjectFilterUI.addEventListener('change', sendClassListRequest);
completionFilterUI.addEventListener('change', sendClassListRequest);
paymentFilterUI.addEventListener('change', sendClassListRequest);