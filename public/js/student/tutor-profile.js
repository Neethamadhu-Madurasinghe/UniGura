const bodyUI = document.getElementsByTagName('body')[0];
const layoutBackgroundUI = document.querySelector('.layout-background');
const errorLayoutBackground = document.querySelector('.error-layout-background');
const errorPopupUI = document.querySelector('.popup-error-message');
const errorMessageUI = document.getElementById('error-message');
const successPopupUI = document.querySelector('.popup-success-message');
const successMessageUI = document.getElementById('success-message');


// Error Message showing function
function showErrorMessage(message, callback = null) {
    bodyUI.classList.add('error-layout-mode');
    errorLayoutBackground.classList.remove('invisible');
    errorMessageUI.textContent = message;
    errorPopupUI.classList.remove('invisible');

    errorOkButtonUI = document.getElementById('error-ok');

    const event = errorOkButtonUI.addEventListener('click', e => {
        errorPopupUI.classList.add('invisible');
        bodyUI.classList.remove('error-layout-mode');
        errorLayoutBackground.classList.add('invisible');
        errorOkButtonUI.removeEventListener('click', event);
        if(callback) callback();
    })
}

// Success Message showing function
function showSuccessMessage(message, callback = null) {
    bodyUI.classList.add('error-layout-mode');
    errorLayoutBackground.classList.remove('invisible');
    successMessageUI.textContent = message;
    successPopupUI.classList.remove('invisible');

    successOkButtonUI = document.getElementById('success-ok');

    const event = successOkButtonUI.addEventListener('click', e => {
        successPopupUI.classList.add('invisible');
        bodyUI.classList.remove('error-layout-mode');
        errorLayoutBackground.classList.add('invisible');
        successOkButtonUI.removeEventListener('click', event);
        if(callback) callback();
    });
}

// Show layout background
function showLayoutBackground() {
    bodyUI.classList.add('layout-mode');
    layoutBackgroundUI.classList.remove('invisible');
}


// Hide layout background
function hideLayoutBackground() {
    bodyUI.classList.remove('layout-mode');
    layoutBackgroundUI.classList.add('invisible');
}