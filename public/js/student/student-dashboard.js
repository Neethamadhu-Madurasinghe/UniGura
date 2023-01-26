const classCardContainerUI = document.querySelector('.class-card-container');
const subjectFilterUI = document.getElementById('sort-subject');
const completionFilterUI = document.getElementById('sort-completion');
const paymentFilterUI = document.getElementById('sort-payment');

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

    const tutoringClasses = (await response.json()).tutoring_classes;
    classCardContainerUI.innerHTML = '';

    tutoringClasses.forEach(tutoringClass => {
        tutoringClass.class_type = tutoringClass.class_type.charAt(0).toUpperCase() + tutoringClass.class_type.slice(1);
        if (!tutoringClass.tutor.profile_picture) {
            tutoringClass['tutor']['profile_picture'] = '/public/img/common/profile.png';
        }

        if (tutoringClass.day_count > 0) {
            tutoringClass['completion'] = Math.round(tutoringClass.incomplete_day_count * 100 / tutoringClass.day_count);
        }else {
            tutoringClass['completion'] = 0;
        }

        classCardContainerUI.innerHTML += `
            <div class="class-card">
                <div class="class-card-top-section">
                    <h2>${tutoringClass.module.name} ${tutoringClass.class_type}</h2>
                    <h4>${tutoringClass.subject.name}</h4>
                 </div>
                 
                 <div class="class-card-bottom-section">
                    <div class="name-row">
                        <div class="class-card-profile-picture-container">
                            <img src="${'http://localhost/unigura/' + tutoringClass.tutor.profile_picture}" alt="" srcset="">
                        </div>
                        
                        <p>${tutoringClass.tutor.first_name} ${tutoringClass.tutor.last_name}</p>
                        <div class="class-card-payment-due-container">
                            <img
                                src="${'http://localhost/unigura//public/img/common/money 1.png'}"
                                class="${tutoringClass.payment_due_day_count > 0 ?
                                "payment-due-image" :
                                "payment-due-image-hidden"}">
                        </div>
                    </div>

                    <div class="progress-bar-row">
                        <p>${tutoringClass['completion']}%</p>
                        <div class="progress-bar-outer">
                            <div class="progress-bar-inner" style="width: ${tutoringClass['completion']}%"></div>
                        </div>
                    </div>
                    
                    <button class="btn btn-enter-class">Enter</button>
                </div>
            </div>'`;
    });
}

window.onload = function() {
    sendClassListRequest();
};

subjectFilterUI.addEventListener('change', sendClassListRequest);
completionFilterUI.addEventListener('change', sendClassListRequest);
paymentFilterUI.addEventListener('change', sendClassListRequest);