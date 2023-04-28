const bodyUI = document.getElementsByTagName('body')[0];
const resetPasswordBtnUI = document.getElementById('change-password');
const loaderUI = document.querySelector('.loader');

const errorLayoutBackground = document.querySelector('.error-layout-background');
const errorPopupUI = document.querySelector('.popup-error-message');
const errorMessageUI = document.getElementById('error-message');
const successPopupUI = document.querySelector('.popup-success-message');
const successMessageUI = document.getElementById('success-message');
const layoutBackgroundUI = document.querySelector('.layout-background');

const changePasswordOTPPopupUI = document.querySelector(".popup-send-message");
const changePasswordOTPCancelBtnUI = document.getElementById('reset-cancel');
const changePasswordOTPOkBtnUI = document.getElementById('reset-send');
const resendButtonUI = document.getElementById('popup-resend');
const otpInputFieldUI = document.getElementById('otp-input');

const changePasswordPopupUI = document.querySelector('.popup-change-password');
const changePasswordCancelBtnUI = document.getElementById('change-cancel');
const changePasswordOkBtnUI = document.getElementById('change-send');
const newPasswordInputFieldUI = document.getElementById('new-password-input')
const newPasswordConfirmInputFieldUI = document.getElementById('new-password-confirm-input')

let code = "";

// Cancel request handler
bodyUI.addEventListener('click', async (e) => {
    if (e.target.classList.contains('req-cancel-btn')) {
        const requestId = e.target.dataset.id;

        const response = await fetch('http://localhost/unigura/api/delete-request', {
            method: 'POST',
            credentials: "include",
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ id: requestId })
        });

        handleDeleteRequestResponse(response.status)
    }
});

function handleDeleteRequestResponse(status) {
    switch (status) {
        case 401:
            showErrorMessage('You have no permission to report this tutor.', () => {
                document.location.href = '../logout';
            });
            break;

        case 400:
            showErrorMessage('Request is not in correct format. Please try again');
            break;

        case 403:
            showErrorMessage('Invalid tutor request');
            break;

        case 500:
            showErrorMessage('Internal server error. Please try again');
            break;

        case 200:
            showSuccessMessage('Tutor request deleted successfully', () => {
                location.reload();
            })
            break;

        default:
            showErrorMessage('An error occurred. Please try again')
    }
}

// Show change password dialog box
resetPasswordBtnUI.addEventListener('click', initiatePasswordReset);


// Change confirm button
changePasswordOTPCancelBtnUI.addEventListener('click', () => {
    layoutBackgroundUI.classList.add('invisible');
    changePasswordOTPPopupUI.classList.add('invisible');
    bodyUI.classList.remove('layout-mode');
    otpInputFieldUI.value = "";
});

changePasswordOTPOkBtnUI.addEventListener('click', async () => {
    code = otpInputFieldUI.value.trim();
    if(code.length < 1) {
        showErrorMessage( "Invalid OTP code")
        return;
    }

    const respond = await fetch(`http://localhost/unigura/api/user/validate-otp?code=${code}`);
    const statusCode = respond.status;

    if(statusCode === 401) {
    //    TODO: LOGOUT
        showErrorMessage( "Please sign in before changing the password")
    }else if(statusCode === 400) {
        showErrorMessage( "Invalid request format");
    }else if(statusCode === 403) {
        showErrorMessage("Invalid OTP code");
    }else {

        changePasswordOTPPopupUI.classList.add('invisible');
        changePasswordPopupUI.classList.remove('invisible');
    }
    otpInputFieldUI.value = "";

})

resendButtonUI.addEventListener('click', initiatePasswordReset);

changePasswordCancelBtnUI.addEventListener('click', () => {
    layoutBackgroundUI.classList.add('invisible');
    changePasswordPopupUI.classList.add('invisible');
    bodyUI.classList.remove('layout-mode');
    newPasswordInputFieldUI.value = "";
    newPasswordConfirmInputFieldUI.value = "";
});

changePasswordOkBtnUI.addEventListener('click',  async () => {
    const newPassword = newPasswordInputFieldUI.value.trim();
    const newPasswordConfirm = newPasswordConfirmInputFieldUI.value.trim();
    newPasswordInputFieldUI.value = "";
    newPasswordConfirmInputFieldUI.value = "";

    if (!newPassword || !newPasswordConfirm) {
        showErrorMessage("Please enter a valid password");
        return;
    } else if (newPassword.length < 4) {
        showErrorMessage("Password should be minimum 4 characters long");
        return;
    } else if (newPassword !== newPasswordConfirm) {
        showErrorMessage("Please confirm the password");
        return;
    }

    const respond = await fetch('http://localhost/unigura/api/user/change-password', {
        method: "POST",
        credentials: "include",
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            code,
            password: newPassword,
            confirm_password: newPasswordConfirm
        })
    });
    const statusCode = respond.status;

    if(statusCode === 401) {
        //    TODO: LOGOUT
        showErrorMessage( "Please sign in before changing the password")
    }else if(statusCode === 400) {
        showErrorMessage("Please enter a valid password");
    }else if(statusCode === 403) {
        showErrorMessage("OTP code expired");
    }else {
        showSuccessMessage("Password changed successfully", () => {
            layoutBackgroundUI.classList.add('invisible');
            changePasswordPopupUI.classList.add('invisible');
            bodyUI.classList.remove('layout-mode');
        });
    }

});

async function initiatePasswordReset() {
    otpInputFieldUI.value = "";
    changePasswordOTPPopupUI.classList.add('invisible');
    // Send the request to make an OTP
    // Show loading screen
    layoutBackgroundUI.classList.remove('invisible');
    loaderUI.classList.remove('invisible');
    const respond = await fetch('http://localhost/unigura/api/user/initiate-reset-password');
    const statusCode = respond.status;
    layoutBackgroundUI.classList.add('invisible');
    loaderUI.classList.add('invisible');

    if(statusCode === 200) {
        layoutBackgroundUI.classList.remove('invisible');
        changePasswordOTPPopupUI.classList.remove('invisible');
        bodyUI.classList.add('layout-mode');
    }
}

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
    });
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
