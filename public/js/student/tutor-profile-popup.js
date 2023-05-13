const tutorDetailPopupBtnUI = document.getElementById('tutor-detail-btn');
const tutorDetailPopupCancelUI = document.getElementById('tutor-detail-close-btn');
const tutorDetailPopupContainer = document.querySelector('.popup-tutor-details');

tutorDetailPopupBtnUI.addEventListener('click', () => {
    showLayoutBackground();
    tutorDetailPopupContainer.classList.remove('invisible');
});

tutorDetailPopupCancelUI.addEventListener('click', () => {
    tutorDetailPopupContainer.classList.add('invisible');
    hideLayoutBackground();
});
