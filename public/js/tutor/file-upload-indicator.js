const _alResultFileUploadUI = document.getElementById('actual-al-result-btn');
const _identityCardUploadUI = document.getElementById('actual-identity-card-btn');
const _universityEntranceUploadUI = document.getElementById('actual-university-entrance-letter');

const alResultShowerUI = document.getElementById('al-result-upload-btn');
const identityCardShowerUI = document.getElementById('al-identity-card-btn');
const universityShowerUI = document.getElementById('university-entrance-letter');

_alResultFileUploadUI.addEventListener('change', function () {
    alResultShowerUI.innerText = "File uploaded";
});

_identityCardUploadUI.addEventListener('change', function () {
    identityCardShowerUI.innerText = "File uploaded";
});

_universityEntranceUploadUI.addEventListener('change', function () {
    universityShowerUI.innerText = "File uploaded";
});
