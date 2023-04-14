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
let userId;

fetchChatThreads()


// Educationally update the times on current chat
window.setInterval(() => {
    console.log("Updating")
    Array.from(document.querySelectorAll(".msg-age")).forEach(msgElement => {
        msgElement.textContent = getTimePassed(msgElement.dataset.time)
        // console.log(document.querySelector(".msg-age"));
    })

}, 60*1000)

// Fetch all the messages for a chatThread when a threadId is given
async function fetchMessages(threadId) {
    messageBoxUI.innerHTML = "";
    // find other participant's name and profile picture from chatThread array
    currentChatThread = chatThreads.filter(chatThread => chatThread.id === Number(threadId))[0];
    chatTitleUI.textContent = currentChatThread.name;
    chatImageUI.src = 'http://localhost/unigura/' + currentChatThread.profile_picture;

    console.log(currentChatThread)


    const response = await fetch(`http://localhost/unigura/api/student/get-chat?chatThreadId=${threadId}`);
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
        let data = await response.json();
        chatThreads = sortByCreatedAtDesc(data.threads);
        userId = data.id;
        console.log(data)
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
                  <h3>${chatThread.name}</h3>
                  <p data-userid="${partnetId}" class="contact-status">${chatThread.last_message}</p>
                </div>
             </div>
            `;

            contactListUI.innerHTML += element;
            // Create a connection for each of the chats
            let conn = new WebSocketConnection(chatThread.id, {messageBoxUI, contactListUI, userStateUI})
            connections.set(chatThread.id, conn);

            if (index === 0) fetchMessages(chatThread.id);
        })
    }else if(response.status === 400) {
        //    TODO:
    }else if(response.status === 401) {

    }else if(response.status === 404) {

    }else if(response.status === 406) {

    }
}

// Update the online states of contacts
function updateOnlineStatus() {
    const onlineState = connections.get(currentChatThread.id).getOnlineList();
    Array.from(document.querySelectorAll(".contact-status")).forEach(element => {
        if
    })
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
// TODO: Finish this
function sendMessage(comment, room) {
    let data = {
        'message': comment,
        'roomId': room
    };
    fetch('http://localhost/Ratchet-with-chatroom/Main/SendPrivate.php', {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(data)
    }).then(response => response.json())
        .then(json => {
            console.log(json);
        });
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
            msgInputUI.value = "";
        }
    }
})