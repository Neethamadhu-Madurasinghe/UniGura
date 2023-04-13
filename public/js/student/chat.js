const messageBoxUI = document.querySelector(".message-box-container");
const contactListUI = document.querySelector(".contact-list-container");
const chatTitleUI = document.getElementById("chat-title");
const chatImageUI = document.getElementById("main-chat-image");
const userStateUI = document.getElementById("user-state");
const msgInputUI = document.getElementById("msg-box");
const sendBtnUI = document.querySelector(".btn-send");

let chatThreads = [];
let currentChatThread = null;
let conn = null;

fetchChatThreads()

// Fetch all the messages for a chatThread when a threadId is given
async function fetchMessages(threadId) {
    messageBoxUI.innerHTML = "";
    // find other participant's name and profile picture from chatThread array
    currentChatThread = chatThreads.filter(chatThread => chatThread.id === Number(threadId))[0];
    chatTitleUI.textContent = currentChatThread.name;
    chatImageUI.src = 'http://localhost/unigura/' + currentChatThread.profile_picture;

    console.log(currentChatThread.profile_picture)


    const response = await fetch(`http://localhost/unigura/api/student/get-chat?chatThreadId=${threadId}`);
    const data = await response.json()

    if (response.status === 200) {
        data.messages.forEach(message => {
            if(message.receiver !== data.userId) {
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
                          <img src="${'http://localhost/unigura/' + currentChatThread.profile_picture}" alt="" class="profile-picture-img">
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

// Fetch all the chatThreads for this user
async function fetchChatThreads() {
    const response = await fetch(`http://localhost/unigura/api/student/get-all-chat-threads`);

    if (response.status === 200) {
        chatThreads = await response.json();
        console.log(chatThreads)
        chatThreads = sortByCreatedAtDesc(chatThreads);
        chatThreads.forEach((chatThread, index) => {
            const element = `
            <div class="contact-card ${ index === 0 ? "contact-card-selected" : "" }" data-threadid="${chatThread.id}">
                <div class="contact-card-image-container">
                  <img src="${'http://localhost/unigura/' + chatThread.profile_picture}" alt="" class="profile-picture-img">
                </div>
                <div class="details-container">
                  <h3>${chatThread.name}</h3>
                  <p>${chatThread.last_message}</p>
                </div>
             </div>
            `;

            contactListUI.innerHTML += element;

            if (index === 0) fetchMessages(chatThread.id);
        })
    }else if(response.status === 400) {
        //    TODO:
    }else if(response.status === 401) {

    }else if(response.status === 404) {

    }else if(response.status === 406) {

    }
}

// Event listener to select chats
document.getElementsByTagName("body")[0].addEventListener("click", function handleContactCardClick(event) {
    // Traverse up the DOM tree from the clicked element
    let currentElement = event.target;
    while (currentElement) {
        // Check if the current element has the class name "contact-card"
        if (currentElement.classList.contains('contact-card')) {
            // Remove selected class from any other class
            const otherContactCards = document.querySelectorAll(".contact-card");
            otherContactCards.forEach(contractCard => {
                contractCard.classList.remove("contact-card-selected");
            });

            // Add selected class to the current card
            currentElement.classList.add("contact-card-selected");
            fetchMessages(currentElement.dataset.threadid);
            return;
        }
        // If not, move up to the next parent element
        currentElement = currentElement.parentElement;
    }

})

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

// Helper function to sort the array of message threads
function sortByCreatedAtDesc(arr) {
    arr.sort(function(a, b) {
        // Convert timestamp strings to Date objects
        const dateA = new Date(a.last_message_created_at);
        const dateB = new Date(b.last_message_created_at);

        // Sort in descending order based on the date values
        return dateB - dateA;
    });
    return arr;
}

// Connect to the websocket server
function connectToWebSocketServer() {
    conn = new WebSocket('ws://localhost:8080');
    conn.onopen = function (e) {
        console.log('Connection established!');
        conn.send(JSON.stringify({
            'newRoute': 'Personalchat-<?= $roomid ?>'
        }));

    };

    conn.onmessage = function (e) {
        let data = JSON.parse(e.data);
        console.log(data);
        if (typeof data.msg !== 'undefined') {
            chatTitleUI.innerHTML += `
                <div class="message-box">
                    <div>
                       <p class="message">${data.msg}</p>
                       <span>${data.date}</span>
                    </div>
                </div>
            `;
        }
        else if (typeof data.typing !== 'undefined') {
            userStateUI.textContent = "Typing";
            let timeoutHandle = window.setTimeout(function () {
                userStateUI.textContent = "";
                window.clearTimeout(timeoutHandle);
            }, 2000);
        }
    };
}

function sendTyping(){
    if (conn) {
        conn.send(JSON.stringify({
            'typing': 'y',
            'name': '<?= $user ?>'
        }));
    }
}

msgInputUI.addEventListener("keypress", function (event) {
    if (event.key === "Enter") {
        event.preventDefault();
        sendBtnUI.click();
    }
});