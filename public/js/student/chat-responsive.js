const contactListContainerUI = document.querySelector(".contact-list-container");
const chatContainerUI = document.querySelector(".chat-container");
const chatCancelBtnUI = document.querySelector(".cancel-btn");

chatCancelBtnUI.addEventListener("click", e => {
    if(window.innerWidth < 768) {
        chatContainerUI.style.display = "none";
        contactListContainerUI.style.display = "block";
    }
    console.log("fzf")
});

document.getElementsByTagName("body")[0].addEventListener("click", function handleContactCardClick(event) {
    // Traverse up the DOM tree from the clicked element
    let currentElement = event.target;
    while (currentElement) {
        // Check if the current element has the class name "contact-card"
        if (currentElement.classList.contains('contact-card')) {
            if(window.innerWidth < 768) {
                chatContainerUI.style.display = "flex";
                contactListContainerUI.style.display = "none";
            }
        }
        // If not, move up to the next parent element
        currentElement = currentElement.parentElement;
    }

});

window.addEventListener('resize', adjustMobileDesktopView)

function adjustMobileDesktopView(e) {
    if(window.innerWidth > 768) {
        chatContainerUI.style.display = "flex";
        contactListContainerUI.style.display = "block";
    }else {
        chatContainerUI.style.display = "flex";
        contactListContainerUI.style.display = "none";
    }
}

adjustMobileDesktopView();

