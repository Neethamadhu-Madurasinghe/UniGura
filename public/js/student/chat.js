const messageBoxUI = document.querySelector(".message-box-container");

async function fetchMessages(userId) {
    const response = await fetch(`http://localhost/unigura/api/student/get-chat?userid=${userId}`);

    const data = await response.json();
    if (response.status === 200) {
        data.messages.forEach(message => {
            if(message.receiver === userId) {
                const element = `
                    <div class="message-box">
                        <div>
                            <p class="message">${message.message}</p>
                            <span>${getTimePassed(message.created_at)}</span>
                        </div>
                    </div>
                `;

                messageBoxUI.innerHTML += element;
            }else {
                const element = `
                    <div class="message-i-box">
                        <div class="message-box-image-container">
                          <img src="assests/profile.png" alt="" class="profile-picture-img">
                        </div>
                        <div class="message-content">
                          <p class="message">${message.message}.</p>
                          <span>${getTimePassed(message.created_at)}</span>
                        </div>
                    </div>
                `;
                messageBoxUI.innerHTML += element;
            }
        })
    }else if(response.status === 400) {
    //    TODO:
    }else if(response.status === 401) {

    }else if(response.status === 404) {

    }else if(response.status === 406) {

    }
}

fetchChatThreads()

async function fetchChatThreads() {
    const response = await fetch(`http://localhost/unigura/api/student/get-all-chat-threads`);
    const output = await response.text();
    console.log(output);
}


// Helper function to format date message created time
function getTimePassed(datetime) {
    const now = new Date();
    const inputDatetime = new Date(datetime);

    const diff = Math.round((now - inputDatetime) / 1000 / 60);

    if (diff < 2) {
        return "Just now";
    } else if (diff < 60) {
        return `${diff} minute${diff > 1 ? "s" : ""} ago`;
    } else if (
        inputDatetime.getDate() === now.getDate() - 1 &&
        inputDatetime.getMonth() === now.getMonth()
    ) {
        return `Yesterday at ${inputDatetime.toLocaleTimeString([], {
            hour: "numeric",
            minute: "numeric",
        })}`;
    } else if (inputDatetime.getFullYear() === now.getFullYear()) {
        return inputDatetime.toLocaleTimeString([], {
            hour: "numeric",
            minute: "numeric",
        });
    } else {
        return inputDatetime.toLocaleString([], {
            year: "numeric",
            month: "numeric",
            day: "numeric",
            hour: "numeric",
            minute: "numeric",
        });
    }
}