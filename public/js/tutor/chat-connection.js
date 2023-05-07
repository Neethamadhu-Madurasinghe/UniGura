class WebSocketConnection {
    UIElements = {};
    conn = null;
    threadId = 0;
    online_list = Array();
    isActive = false;

    constructor(chatThreadId, UIElements) {
        this.UIElements = UIElements;
        this.threadId = chatThreadId;
        this.conn = new WebSocket('ws://40.115.0.66:8080');

        // What to do when the connection is started
        this.conn.onopen = (e) => {
            console.log('Connection established!');
            // Send the userId, and threadID to introduce to WS server
            this.conn.send(JSON.stringify({
                'newRoute': `Personalchat-${chatThreadId}?>`,
                'id': userId
            }));

        };

        // What to do in a message is received
        this.conn.onmessage =  (e) => {
            let data = JSON.parse(e.data);
            console.log(data);

            // If other person sends he's online, show it to the user
            if (typeof data.online_users !== 'undefined') {
                this.online_list = data.online_users;
            }

            // If the current connection does not belong to the active chat thread, do now show messages on screen
            if(!this.isActive) return;

            // Show the messages on screen
            if (typeof data.msg !== 'undefined') {
                this.UIElements.messageBoxUI.innerHTML += `
                <li class="clearfix">
                    <div class="message-data">
                        <img src="${'http://40.115.0.66/unigura/' + currentChatThread.profile_picture}" alt="avatar">
                        <span class="message-data-time" data-time="${data.date}">${getTimePassed(data.date)}</span>
                    </div>
                    <div class="message my-message">${data.msg}</div>                                    
                </li>`;

                // THis is for automatically scroll to the bottom
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

    // Send a given message into the WS server returns true on success, false on fail
    send(messageText) {
        let currentDate = new Date();
        currentDate = currentDate.getFullYear() + "-" + (currentDate.getMonth()+1) + "-" + currentDate.getDate() +
            " " + currentDate.getHours() + ":" +  currentDate.getMinutes() + ":" + currentDate.getSeconds();

        try {
            this.conn.send(JSON.stringify({
                'msg': messageText,
                'date':currentDate,
            }));

            const messageElement = `
                    <li class="clearfix">
                        <div class="message-data text-right">
                            <span class="message-data-time" data-time="${currentDate}">${getTimePassed(currentDate)}</span>
                        </div>
                        <div class="message other-messages float-right">${messageText}</div>
                    </li>`;


            this.UIElements.messageBoxUI.innerHTML += messageElement
            this.UIElements.messageBoxUI.scrollTop = this.UIElements.messageBoxUI.scrollHeight;

            return true;
        } catch(e) {
            console.log("Could not send the message successfully")
            return false;
        }

    }

    // Tell the ws server that user is typing
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