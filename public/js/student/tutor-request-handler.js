const tutorRequestSendBtnUI = document.getElementById('tutor-request-send');

tutorRequestSendBtnUI.addEventListener('click', async (e) => {
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