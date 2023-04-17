const messageBoxUI = document.querySelector(".message-box-container");
const contactListUI = document.querySelector(".contact-list-container");
const chatTitleUI = document.getElementById("chat-title");
const chatImageUI = document.getElementById("main-chat-image");
const userStateUI = document.getElementById("user-state");
const msgInputUI = document.getElementById("msg-box");
const sendBtnUI = document.querySelector(".btn-send");

let chatThreads = [];
let currentChatThread = null;
let connections = new Map();
let onlineUserList = Array();
let userId;

window.setTimeout(fetchChatThreads, 50);


// Periodically update the times on current chat and online status of users
window.setInterval(() => {
    updateOnlineStatus();
    Array.from(document.querySelectorAll(".msg-age")).forEach(msgElement => {
        msgElement.textContent = getTimePassed(msgElement.dataset.time)
    })

}, 5*1000)

// Fetch all the messages for a chatThread when a threadId is given
async function fetchMessages(threadId) {

    messageBoxUI.innerHTML = "";
    // find other participant's name and profile picture from chatThread array
    currentChatThread = chatThreads.filter(chatThread => chatThread.id === Number(threadId))[0];
    chatTitleUI.textContent = currentChatThread.name;
    chatImageUI.src = 'http://localhost/unigura/' + currentChatThread.profile_picture;

    // Enable UI access to the connection
    connections.forEach((value) => value.deactivate())
    connections.get(currentChatThread.id).activate();

    console.log(currentChatThread)


    const response = await fetch(`http://localhost/unigura/api/chat/get-chat?chatThreadId=${threadId}`);
    const data = await response.json()

    if (response.status === 200) {
        data.messages.forEach(message => {
            if(message.receiver !== data.userId) {
                const element = `
                    <div class="message-box">
                        <div>
                            <p class="message">${message.message}</p>
                            <span class="msg-age" data-time="${message.created_at}">${getTimePassed(message.created_at)}</span>
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
                          <span class="msg-age" data-time="${message.created_at}">${getTimePassed(message.created_at)}</span>
                        </div>
                    </div>
                `;
                messageBoxUI.innerHTML += element;
            }
        });

        messageBoxUI.scrollTop = messageBoxUI.scrollHeight;

    }else if(response.status === 400) {
        showErrorMessage("Invalid message format");
    }else if(response.status === 401) {
        
    }else if(response.status === 404) {
        showErrorMessage("Route not found. Something went wrong");
    }else if(response.status !== 200) {
        showErrorMessage("Internal server error");
    }
}

// Fetch all the chatThreads for this user
async function fetchChatThreads() {
    const response = await fetch('http://localhost/unigura/api/chat/get-all-chat-threads');
    if (response.status === 200) {
        let data = await response.json();
        console.log(data);
        chatThreads = sortByCreatedAtDesc(data.threads);
        userId = data.id;
        chatThreads.forEach((chatThread, index) => {

            let partnetId = 0;
            if(chatThread.user_id_1 === userId) partnetId = chatThread.user_id_2;
            else partnetId = chatThread.user_id_1;

            const element = `
            <div class="contact-card ${ index === 0 ? "contact-card-selected" : "" }" data-threadid="${chatThread.id}">
                <div class="contact-card-image-container">
                  <img src="${'http://localhost/unigura/' + chatThread.profile_picture}" alt="" class="profile-picture-img">
                </div>
                <div class="details-container">
                  <div>
                    <h3>${chatThread.name}</h3>
                    <span class="msg-count ${chatThread.unseen_messages === 0 || index === 0 ? "hide-msg-count" : "" } ">${chatThread.unseen_messages}</span>
                  </div>
                  <p data-userid="${partnetId}" class="contact-status"></p>
                </div>
             </div>
            `;

            contactListUI.innerHTML += element;
            // Create a connection for each of the chats
            let conn = new WebSocketConnection(chatThread.id, {messageBoxUI, contactListUI, userStateUI})
            connections.set(chatThread.id, conn);

            if (index === 0) fetchMessages(chatThread.id);
        });
        updateOnlineStatus();

    }else if(response.status === 400) {
        showErrorMessage("Invalid message format");
    }else if(response.status === 401) {
        showErrorMessage("Please login to send message", () => {
            document.location.href = '../logout';
        });
    }else if(response.status === 404) {
        showErrorMessage("Route not found. Something went wrong");
    }else if(response.status !== 200) {
        showErrorMessage("Internal server error");
    }
}

// Update the online states of contacts
function updateOnlineStatus() {
    // Find the userId of currently Active chat thread - to show online status on the top
    let currentPartnerId = 0;
    if(currentChatThread.user_id_1 === userId) currentPartnerId = currentChatThread?.user_id_2;
    else currentPartnerId = currentChatThread?.user_id_1;

    // Get the first connection to fetch the list of all online users
    onlineUserList = connections.entries().next().value[1].getOnlineList();

    let isCurrentChatOnline = false;
    Array.from(document.querySelectorAll(".contact-status")).forEach(element => {
        if(onlineUserList.includes(Number(element.dataset.userid))) {
            element.textContent = "Online";
            element.classList.remove("red");
            element.classList.add("green");

            // If the user of currently active chat is online detect it !
            if(currentPartnerId === Number(element.dataset.userid)) {
                isCurrentChatOnline = true;
            }

        }else {
            element.textContent = "Offline";
            element.classList.remove("green");
            element.classList.add("red");
        }
    });

    if(isCurrentChatOnline) {
        userStateUI.textContent = "Online";
    }else {
        userStateUI.textContent = "Offline";
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

            const spanUI = currentElement.querySelector('.msg-count');
            spanUI.textContent = "";
            spanUI.classList.add('hide-msg-count');

            // Add selected class to the current card
            currentElement.classList.add("contact-card-selected");
            fetchMessages(currentElement.dataset.threadid);

            return;
        }
        // If not, move up to the next parent element
        currentElement = currentElement.parentElement;
    }

});

// Helper function to format date message created time
function getTimePassed(dateTimeString) {
    const dateTime = new Date(dateTimeString);
    const now = new Date();
    const diff = (now.getTime() - dateTime.getTime()) / 1000; // difference in seconds

    if (diff < 120) {
        // less than 2 minutes ago
        if (diff < 60) {
            return "Just now";
        } else {
            const minutesAgo = Math.floor(diff / 60);
            return `${minutesAgo} minute${minutesAgo > 1 ? 's' : ''} ago`;
        }
    } else if (diff < 86400) {
        // less than 1 day ago
        const timeString = dateTime.toLocaleTimeString([], { hour: 'numeric', minute: 'numeric' });
        return `Today ${timeString}`;

    } else if (diff < 172800) {
        // less than 1 day ago
        const timeString = dateTime.toLocaleTimeString([], { hour: 'numeric', minute: 'numeric' });
        return `Yesterday ${timeString}`;
    } else {
        // older than 1 day
        const dateString = dateTime.toISOString().slice(0, 16).replace('T', ' ');
        return dateString;
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

// Send the newest message to the database
async function sendMessage(message, threadId) {
    let data = {
        'message': message,
        'thread_id': threadId
    };
    const result = await fetch('http://localhost/unigura/api/chat/save-message', {
        method: "POST",
        headers: {
            "Content-Type": "application/json"

        },
        body: JSON.stringify(data)
    });

    const reply = await result.text();
    if(result.status === 200) {
    // Do nothing on 200 LOL
    } else if(result.status === 400) {
        showErrorMessage("Invalid message format");
        console.log(reply);
    } else if (result.status === 401) {
        showErrorMessage("Please login to send message", () => {
            document.location.href = '../logout';
        });
        console.log(reply);
    } else {
        showErrorMessage("Internal server error");
        console.log(reply);
    }
}

msgInputUI.addEventListener("keypress", function (e) {
    if (e.key === "Enter") {
        e.preventDefault();
        sendBtnUI.click();
    }
});

msgInputUI.addEventListener("keyup", () => {
    connections.get(currentChatThread.id).sendTyping()
});

sendBtnUI.addEventListener("click", function(e) {
    let message = msgInputUI.value;
    if (message) {
        message = (String(message)).trim()
        const currentChatConnection = connections.get(currentChatThread.id);
        if (currentChatConnection.send(message)) {
            sendMessage(message, currentChatThread.id)
            msgInputUI.value = "";
        }
    }
})