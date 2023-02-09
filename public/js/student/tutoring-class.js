const layoutBackGroundUI = document.querySelector('.layout-background');
const bodyUI = document.getElementsByTagName('body')[0];
const timeTableUI = document.querySelector('.pop-time-table');
const feedbackFormUI = document.querySelector('.popup-feedback-form');
const reportUI = document.querySelector('.popup-report');
const uploadUI = document.querySelector('.popup-upload-file');

console.log(timeTableUI, feedbackFormUI, reportUI, uploadUI);


const rescheduleBtnUI = document.getElementById('reshedule');
const feedbackBtnUI = document.getElementById('feeback');
const reportBtnUI = document.getElementById('report');

const rescheduleCancelBtnUI = document.getElementById('timetable-cancel');
const feedbackCancelBtnUI = document.getElementById('feedback-cancel');
const reportCancelBtnUI = document.getElementById('report-cancel');


rescheduleBtnUI.addEventListener('click', e => {
    showBackgroundOverlay();
    timeTableUI.classList.remove('hidden');
});

feedbackBtnUI.addEventListener('click', e => {
    showBackgroundOverlay();
    feedbackFormUI.classList.remove('hidden');
});

reportBtnUI.addEventListener('click', e => {
    showBackgroundOverlay();
    reportUI.classList.remove('hidden');
});


rescheduleCancelBtnUI.addEventListener('click', e => {
    hideBackgroundOverlay();
    timeTableUI.classList.add('hidden');
});

feedbackCancelBtnUI.addEventListener('click', e => {
    hideBackgroundOverlay();
    feedbackFormUI.classList.add('hidden');
});

reportCancelBtnUI.addEventListener('click', e => {
    hideBackgroundOverlay();
    reportUI.classList.add('hidden');
});

function showBackgroundOverlay() {
    bodyUI.classList.add('layout-mode');
    layoutBackGroundUI.classList.remove('hidden');

}

function hideBackgroundOverlay() {
    bodyUI.classList.remove('layout-mode');
    layoutBackGroundUI.classList.add('hidden');

}
