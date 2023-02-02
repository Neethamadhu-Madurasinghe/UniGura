const reportTutorButtonUI = document.getElementById('report-tutor-button');
const tutorReportPopupUI = document.querySelector('.popup-report');
const reportReasonRadioButtonsUI = document.getElementsByName('reason');
const reportCommentUI = document.getElementsByName('report-comment')[0];
const reportCancelButtonUI = document.getElementById('popup-report-cancel');
const reportSubmitButtonUI = document.getElementById('popup-report-submit');

const report = {
  reason_id: 0,
  description: '',
  tutor_id: 0
}


// Show report tutor popup
reportTutorButtonUI.addEventListener('click', e => {
  tutorReportPopupUI.classList.remove('invisible');
  showLayoutBackground();
})

// Check for error and send the report data to server
reportSubmitButtonUI.addEventListener('click', async (e) => {
  let isChecked = false;
  for (let i = 0; i < reportReasonRadioButtonsUI.length; i++) {
    if (reportReasonRadioButtonsUI[i].checked) {
      isChecked = true;
      report.reason_id = reportReasonRadioButtonsUI[i].value;
      report.description = reportCommentUI.value;
      report.tutor_id = dataElement.dataset.tutor;
    }
  }

  if (!isChecked) {
    showErrorMessage('Please select a reason to report this tutor');
    return;
  }

  console.log(report)
  
  // Send the request
  const response = await fetch('http://localhost/unigura/api/report-tutor', {
      method: 'POST',
      credentials: "include",
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(report)
    });


  handleTutorReportResponse(response.status);

});

// Clear call form data and hide the popup when Canel is clicked
reportCancelButtonUI.addEventListener('click', e => {
  hideLayoutBackground();
  tutorReportPopupUI.classList.add('invisible');
  for (i = 0; i < reportReasonRadioButtonsUI.length; i++) {
    reportReasonRadioButtonsUI[i].checked = false
  }
  reportCommentUI.value = '';
  report.reason_id = 0;
  report.description = '';
  report.tutor_id = 0;
})


function handleTutorReportResponse(status) {
  switch (status) {
    case 401:
      showErrorMessage('You have no permission to report this tutor.', () => {
        document.location.href = '../logout';
      });
      break;

    case 400:
      showErrorMessage('Report is not in correct format. Please try again');
      break;

    case 403:
      showErrorMessage('You have already reported this tutor');
      break;

    case 500:
      showErrorMessage('Internal server error. Please try again');
      break;

    case 200:
      showSuccessMessage('Report Saved successfully', () => {
        // hideTimeTable()
        reportCommentUI.value = '';
        report.reason_id = 0;
        report.description = '';
        report.tutor_id = 0;
      })
      break;

    default:
      showErrorMessage('An error occurred. Please try again')
  }
}