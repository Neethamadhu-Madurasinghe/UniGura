class WebSocketConnection {
    UIElements = {};
    conn = null;
    threadId = 0;
    online_list = Array();
    isActive = false;

    constructor(chatThreadId, UIElements) {
        this.UIElements = UIElements;
        this.threadId = chatThreadId;
        this.conn = new WebSocket('ws://localhost:8080');

        this.conn.onopen = (e) => {
            console.log('Connection established!');
            this.conn.send(JSON.stringify({
                'newRoute': `Personalchat-${chatThreadId}?>`,
                'id': userId
            }));

        };

        this.conn.onmessage =  (e) => {
            let data = JSON.parse(e.data);
            console.log(data);

            // If other person sends he's online, show it to the user
            if (typeof data.online_users !== 'undefined') {
                this.online_list = data.online_users;
            }

            if(!this.isActive) return;

            if (typeof data.msg !== 'undefined') {
                this.UIElements.messageBoxUI.innerHTML += `
                <div class="message-i-box">
                    <div class="message-box-image-container">
                         <img src="${'http://localhost/unigura/' + currentChatThread.profile_picture}" alt="" class="profile-picture-img">
                    </div>
                    <div class="message-content">
                         <p class="message">${data.msg}.</p>
                         <span class="msg-age" data-time="${data.date}">${getTimePassed(data.date)}</span>
                    </div>
                </div>
            `;
                this.UIElements.messageBoxUI.scrollTop = this.UIElements.messageBoxUI.scrollHeight;

            } else if (typeof data.typing !== 'undefined') {
                userStateUI.textContent = "Typing";
                let timeoutHandle = window.setTimeout(function () {
                    userStateUI.textContent = "";
                    window.clearTimeout(timeoutHandle);
                    userStateUI.textContent = "Online";
                }, 2000);
                console.log('type')

            }


        };
    }

    send(messageText) {
        let currentDate = new Date();
        currentDate = currentDate.getFullYear() + "-" + (currentDate.getMonth()+1) + "-" + currentDate.getDate() +
            " " + currentDate.getHours() + ":" +  currentDate.getMinutes() + ":" + currentDate.getSeconds();

        try {
            this.conn.send(JSON.stringify({
                'msg': messageText,
                'date':currentDate,
            }));

            // sendMessage(msgInputUI.value, currentChatThread.id);
            const messageElement = `
                    <div class="message-box">
                        <div>
                            <p class="message">${messageText}</p>
                            <span class="msg-age" data-time="${currentDate}" >${getTimePassed(currentDate)}</span>
                        </div>
                    </div>
                `;

            this.UIElements.messageBoxUI.innerHTML += messageElement
            this.UIElements.messageBoxUI.scrollTop = this.UIElements.messageBoxUI.scrollHeight;

            return true;
        } catch(e) {
            console.log("Could not send the message successfully")
            return false;
        }

    }

    sendTyping(){
        if (this.conn) {
            this.conn.send(JSON.stringify({
                'typing': 'y',
                'online': 'y',
            }));
        }
    }

    getOnlineList() {
        return Object.values(this.online_list);
    }

    activate() {
        this.isActive = true;
    }

    deactivate() {
        this.isActive = false;
    }
}