const otherClassPopupUI = document.querySelector('.popup-tutor-other-class');
const otherClassButtonUI = document.getElementById('other-classes-button');
const otherClassCancelButtonUI = document.getElementById('other-class-cancel');

otherClassButtonUI.addEventListener('click', e => {
  showLayoutBackground();
  otherClassPopupUI.classList.remove('invisible');
});

otherClassCancelButtonUI.addEventListener('click', e => {
  hideLayoutBackground();
  otherClassPopupUI.classList.add('invisible');
})