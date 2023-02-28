const bodyUI = document.getElementsByTagName('body')[0];

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

