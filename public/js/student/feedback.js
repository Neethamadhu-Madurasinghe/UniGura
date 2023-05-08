const feedbackBtnUI = document.getElementById('give-feedback');
const feedbackCancelBtnUI = document.getElementById('feedback-cancel');
const feedbackOkBtnUI = document.getElementById('feedback-ok');
const optionalCommentUI = document.getElementById('feedback-input');
const feedbackFormUI = document.querySelector('.popup-feedback-form');

const starsUI = Array.from(
    [document.getElementById('star-1'),
        document.getElementById('star-2'),
        document.getElementById('star-3'),
        document.getElementById('star-4'),
        document.getElementById('star-5')]
);

let currentRating = 1;

feedbackBtnUI.addEventListener('click', e => {
    showLayoutBackground();
    feedbackFormUI.classList.remove('hidden');
});

starsUI.forEach((starUI, index) => {
    starUI.addEventListener('mouseover', (e) => {
        for(let i = 0; i <= index; i++) {
            starsUI[i].src = "http://localhost/UniGura/public/img/student/big.png"
        }

        for(let i = index   +1; i < 4 + 1; i++) {
            starsUI[i].src = "http://localhost/UniGura/public/img/student/star_inactive.png"
        }
        currentRating = index + 1;
    });
});

feedbackOkBtnUI.addEventListener('click', async (e) => {
    const comment = optionalCommentUI.value;
    const rating = currentRating;

    const response = await fetch('http://localhost/unigura/api/user-feedback', {
        method: 'POST',
        credentials: "include",
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            description: comment,
            rating
        })
    });

    const status = response.status;
    const res = await response.text();
    console.log(res);

    if(status === 200) {
        showSuccessMessage("Feedback saved successfully", () => {
            hideLayoutBackground();
            feedbackFormUI.classList.add('hidden');
            optionalCommentUI.value = '';
        });
    } else if(status === 401) {
        showErrorMessage("Please login to send message", () => {
            document.location.href = '../logout';
        });

    } else if(status === 400) {
        showErrorMessage("Invalid request format", () => {
            hideLayoutBackground();
            feedbackFormUI.classList.add('hidden');
            optionalCommentUI.value = '';
        });

    } else {
        showErrorMessage("Something went wrong, please try again")
        const data = await response.text();
    }
});

feedbackCancelBtnUI.addEventListener('click', e => {
    hideLayoutBackground();
    feedbackFormUI.classList.add('hidden');
    optionalCommentUI.value = '';
});


