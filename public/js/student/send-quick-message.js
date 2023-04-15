const messageSendPopupUI = document.querySelector(".popup-send-message");
const messageSendBtn = document.getElementById("msg-send");
const messageCancelBtn = document.getElementById("msg-cancel");
const messageInputField = document.getElementById("msg-input");
let chosenTutorId;


// Send
messageSendBtn.addEventListener("click", async (e) => {
    const message = messageInputField.value.trim();

    if(message.length <= 0) {
        showErrorMessage("Please enter a valid message");
    }else {
        const result = await fetch('http://localhost/unigura/api/student/send-single-message', {
            method: "POST",
            headers: {
                "Content-Type": "application/json"

            },
            body: JSON.stringify({
                message,
                receiver: chosenTutorId
            })
        });

        const status = result.status;


        if(status === 200) {
            showSuccessMessage("Message sent successfully", () => {

            });
        } else if(status === 401) {
            const data = await result.text();
            console.log(data);
            showErrorMessage("Please login to send message", () => {
                document.location.href = '../logout';
            });
        } else {
            showErrorMessage("Something went wrong, please try again")
            const data = await result.text();
            console.log(data);
        }
    }
});

// Cancel
messageCancelBtn.addEventListener("click", (e) => {
    hideLayoutBackground();
    messageInputField.value = "";
    messageSendPopupUI.classList.add('invisible');
});

bodyUI.addEventListener("click", e => {
    if(e.target.classList.contains("quick-message-btn")) {
        showLayoutBackground();
        messageSendPopupUI.classList.remove('invisible');
        chosenTutorId = +e.target.dataset.tutor;
    }
})