const firstNameInputUI = document.getElementById('first-name-input');
const firstNameErrorUI = document.getElementById('first-name-error');
const lastNameInputUI = document.getElementById('last-name-input');
const lastNameErrorUI = document.getElementById('last-name-error');
const addressLineOneInputUI = document.getElementById('address-one-input');
const addressLineOneErrorUI = document.getElementById('address-line-one-error');
const addressLineTwoInputUI = document.getElementById('address-two-input');
const addressLineTwoErrorUI = document.getElementById('address-line-two-error');
const cityInputUI = document.getElementById('city-input');
const cityErrorUI = document.getElementById('city-error');
const telephoneInputUI = document.getElementById('telephone-input');
const telephoneErrorUI = document.getElementById('telephone-error');
const examYearInputUI = document.getElementById('exam-year-input');
const examYearErrorUI = document.getElementById('exam-year-error');
const universityInputUI = document.getElementById('university-input');
const universityErrorUI = document.getElementById('university-error')
const bioInputUI = document.getElementById('bio-input');
const bioErrorUI = document.getElementById('bio-error')

const profileCompleteForm = document.getElementById('complete-profile-form');

profileCompleteForm?.addEventListener('submit', (e) => {
    let isValid = true;

//    Validate first name
    if (validateName(firstNameInputUI.value)) {
        isValid = false;
        firstNameErrorUI.innerText = validateName(firstNameInputUI.value);
    }else {
        firstNameErrorUI.innerText = "";
    }

    //    Check last name
    if (validateName(lastNameInputUI.value)) {
        isValid = false;
        lastNameErrorUI.innerText = validateName(lastNameInputUI.value);
    }else {
        lastNameErrorUI.innerText = "";
    }

//    Check AddressLine 1
    if (validateAddressLines(addressLineOneInputUI.value)) {
        isValid = false;
        addressLineOneErrorUI.innerText = validateAddressLines(addressLineOneInputUI.value);
    }else {
        console.log('sdf');
        addressLineOneErrorUI.innerText = "";
    }

    //    Check AddressLine 2
    if (addressLineTwoInputUI.value !== '') {
        if (validateAddressLines(addressLineOneInputUI.value)) {
            isValid = false;
            addressLineTwoErrorUI.innerText = validateAddressLines(addressLineOneInputUI.value);
        }else {
            addressLineTwoErrorUI.innerText = "";
        }
    }

//     Validate city
    if (validateCity(cityInputUI.value)) {
        isValid = false;
        cityErrorUI.innerText = validateCity(cityInputUI.value);
    }else {
        cityErrorUI.innerText = "";
    }

    //     Validate telephone number
    if (validateTelephoneNumber(telephoneInputUI.value)) {
        isValid = false;
        telephoneErrorUI.innerText = validateTelephoneNumber(telephoneInputUI.value);
    }else {
        telephoneErrorUI.innerText = "";
    }

//    If year of exam is available, check it
    if (examYearInputUI) {
        if (validateYearOfExam(examYearInputUI.value)) {
            isValid = false;
            examYearErrorUI.innerText = validateYearOfExam(examYearInputUI.value);
        }else {
            examYearErrorUI.innerText = "";
        }
    }

    //If university is available, check it
    if (universityInputUI) {
        if (validateUniversity(universityInputUI.value)) {
            isValid = false;
            universityErrorUI.innerText = validateUniversity(universityInputUI.value);
        }else {
            universityErrorUI.innerText = "";
        }
    }

    //If bio(tutor description) is available, check it
    if (bioInputUI) {
        if (validateDescription(bioInputUI.value)) {
            isValid = false;
            bioErrorUI.innerText = validateDescription(bioInputUI.value);
        }else {
            bioErrorUI.innerText = "";
        }
    }

    if(!isValid) {
        e.preventDefault();
    }
})