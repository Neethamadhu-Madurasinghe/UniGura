const dataElement = document.getElementById('template-data');
const layoutBackGroundUI = document.querySelector('.layout-background');
const timeTableUI = document.querySelector('.pop-time-table');
const feedbackFormUI = document.querySelector('.popup-feedback-form');

const rescheduleBtnUI = document.getElementById('reshedule');
const feedbackBtnUI = document.getElementById('feeback');

const rescheduleCancelBtnUI = document.getElementById('timetable-cancel');


rescheduleBtnUI.addEventListener('click', e => {
    showLayoutBackground();
    timeTableUI.classList.remove('hidden');
});

feedbackBtnUI.addEventListener('click', e => {
    showLayoutBackground();
    feedbackFormUI.classList.remove('hidden');
});

rescheduleCancelBtnUI.addEventListener('click', e => {
    hideLayoutBackground();
    timeTableUI.classList.add('hidden');
});

function showLayoutBackground() {
    bodyUI.classList.add('layout-mode');
    layoutBackGroundUI.classList.remove('hidden');
}

function hideLayoutBackground() {
    bodyUI.classList.remove('layout-mode');
    layoutBackGroundUI.classList.add('hidden');
}
