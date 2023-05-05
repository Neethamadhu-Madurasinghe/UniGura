const dataElement = document.getElementById('template-data');
const layoutBackGroundUI = document.querySelector('.layout-background');
const feedbackFormUI = document.querySelector('.popup-feedback-form');
const feedbackBtnUI = document.getElementById('feedback');
const activityCheckBoxesUI = Array.from(document.querySelectorAll('.download-link'))

feedbackBtnUI.addEventListener('click', e => {
    showLayoutBackground();
    feedbackFormUI.classList.remove('hidden');
});


function showLayoutBackground() {
    bodyUI.classList.add('layout-mode');
    layoutBackGroundUI.classList.remove('hidden');
}

function hideLayoutBackground() {
    bodyUI.classList.remove('layout-mode');
    layoutBackGroundUI.classList.add('hidden');
}

activityCheckBoxesUI.forEach(activityCheckBoxUI => {
    activityCheckBoxUI.addEventListener('change', async e => {
        const response = await fetch('http://localhost/unigura/api/student/toggle-activity-completion', {
            method: 'POST',
            credentials: "include",
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                activity_id: +e.target.name,
                is_select: e.target.checked ? 1 : 0
            })
        });

        const res = await response.text()
        if(response.status !== 200) {
            showErrorMessage('An error has occurred');
        }

    })
});
