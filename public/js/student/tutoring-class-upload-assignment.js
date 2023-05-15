const fileUploadButtonsUI = Array.from(document.querySelectorAll('.file-upload-input'));

// Submit form related to file uploads
fileUploadButtonsUI.forEach(fileUploadButtonUI => {
    fileUploadButtonUI.addEventListener('change', (e) => {
        e.target.parentElement.submit();
    });
});
