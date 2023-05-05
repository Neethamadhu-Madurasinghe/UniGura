const dataElement = document.getElementById('template-data');
const layoutBackGroundUI = document.querySelector('.layout-background');
const feedbackFormUI = document.querySelector('.popup-feedback-form');
const feedbackBtnUI = document.getElementById('feedback');

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
