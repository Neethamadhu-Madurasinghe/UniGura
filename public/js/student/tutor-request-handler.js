const tutorRequestSendBtnUI = document.getElementById('tutor-request-send');
const selectModeUI = document.querySelector('.popup-select-mode');
const selectModeCancelUI = document.getElementById('mode-cancel');
const selectModeOkUI = document.getElementById('mode-ok');
const reportModeRadioButtonsUI = document.getElementsByName('mode');

tutorRequestSendBtnUI.addEventListener('click', async (e) => {
  // Check if a mode (Online/physical) is given as a default value - If not ask user for those values
  if(request.mode === 'none') {
    showLayoutBackground();
    selectModeUI.classList.remove('invisible');

  }else {
    await sendTutorRequest();
  }

});

// Checks whether user has selected time slots and if yes, sends the tutor requests
async function sendTutorRequest(hasNoDefaultValue = false) {
  // Check weather the user has selected timeslots
  if(selectedSlots.size !== 0) {
    // Add the set of selected slots into the request object
    request.time_slots = Array.from(selectedSlots);
    console.log(request);

    const response = await fetch('http://localhost/unigura/api/request', {
      method: 'POST',
      credentials: "include",
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(request)
    });

    handleTutorRequestResponse(response.status);

    const result = await response.text();
    console.log(result);

  }else {
    showErrorMessage('Please select at least one time slot');
  }

  // reset the request mode (online or physical) if this page is accessed using tutor other classes menu
  if(hasNoDefaultValue) {
    request.mode = 'none';
  }
}

// Event listener for Ok button of class mode selection window
selectModeOkUI.addEventListener('click', async (e) => {
  for (let i = 0; i < reportModeRadioButtonsUI.length; i++) {
    if (reportModeRadioButtonsUI[i].checked) {
      request.mode = reportModeRadioButtonsUI[i].value;
    }
  }

  selectModeUI.classList.add('invisible');
  hideLayoutBackground();
  // Send argument 'true' to indicate there was no default value specified as class mode
  await sendTutorRequest(true);
});

//
selectModeCancelUI.addEventListener('click', e => {
  request.mode = 'none';
  selectModeUI.classList.add('invisible');
  hideLayoutBackground();
});


// Helper function to show messages according to server response code
function handleTutorRequestResponse(status) {
  switch (status) {
    case 401:
      showErrorMessage('You have no permission to send this request.', () => {
        document.location.href = '../logout';
      });
      break;

    case 400:
      showErrorMessage('Request is not in correct format. Please try again');
      break;

    case 403:
      showErrorMessage('You have already sent a request to this class');
      break;

    case 500:
      showErrorMessage('Internal server error. Please try again');
      break;

    case 200:
      showSuccessMessage('Tutor request has been sent successfully', () => {
        hideTimeTable()
        unsortedTimeSlots = [];
        sortedTimeSlots = [];
        request.duration = 0;
        selectedSlots.clear();
      })
      break;

    default:
      showErrorMessage('An error occurred. Please try again')
  }
}