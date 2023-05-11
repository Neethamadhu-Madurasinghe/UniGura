function validateName(name) {
    if (!name || !/^[a-zA-Z]*$/.test(name)) {
        return 'Please enter a valid name';
    } else if (name.length > 255) {
        return 'Name should have less than 255 characters';
    } else {
        return false;
    }
}

function validateAccountName(name) {
    if (!name || !/^[a-zA-Z]*$/.test(name)) {
        return 'Please enter a valid name';
    } else if (name.length > 50 && name.length > 0) {
        return 'Account Name should have less than 50 characters and more than 2 characters';
    } else {
        return false;
    }
}

function validateAccountNumber(number) {
    if (!number || !/^[0-9]*$/.test(number)) {
        return 'Please enter a valid Account Number';
    } else if (!(number.length > 6) || !(number.length < 14)) {
        return 'Please enter a valid account number';
    } else {
        return false;
    }
}

function validateAddressLines(addressLine) {
    if (!addressLine) {
        return 'Please enter a valid Address Line';
    } else if (addressLine.length > 255) {
        return 'Address Line should have less than 255 characters';
    } else {
        return false;
    }
}

function validateCity(city) {
    if (!city || !/^[a-zA-Z0-9\s]+$/.test(city)) {
        return 'Please enter a valid city';
    } else if (city.length > 255) {
        return 'City should have less than 255 characters';
    } else {
        return false;
    }
}

function validateDistrict(district) {
    if (!district || !/^[a-zA-Z0-9\s]+$/.test(district)) {
        return 'Please enter a valid District';
    } else if (district.length > 255) {
        return 'District should have less than 255 characters';
    } else {
        return false;
    }
}

function validateYearOfExam(year) {
    const yearNumber = parseInt(year);

    if (!year || yearNumber === 0) {
        return 'Please enter an exam year';
    } else if (yearNumber < new Date().getFullYear()) {
        return 'Exam year should be after ' + new Date().getFullYear();
    } else if (yearNumber > 2030) {
        return 'Exam year should be before 2030';
    } else {
        return false;
    }
}

function validateTelephoneNumber(telephone) {
    if (!telephone || !/^[0-9]*$/.test(telephone)) {
        return 'Please enter a valid telephone no.';
    } else if (telephone.length !== 10) {
        return 'Telephone no. should have 10 characters';
    } else {
        return false;
    }
}

function validateDescription(description) {
    if (description.length >= 1000) {
        return 'Bio should have less than 1000 characters';
    } else {
        return false;
    }
}

function validateUniversity(university) {
    if (!university || !/^[a-zA-Z\s]*$/.test(university)) {
        return 'Please enter a valid University';
    } else if (university.length > 255) {
        return 'University should have less than 255 characters ';
    } else {
        return false;
    }
}