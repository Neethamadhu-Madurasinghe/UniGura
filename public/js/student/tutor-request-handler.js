const tutorRequestSendBtnUI = document.getElementById('tutor-request-send');

tutorRequestSendBtnUI.addEventListener('click', async (e) => {
  // Check weather the user has selected timeslots
  if(selectedSlots.size !== 0) {
    // Add the set of selected slots into the request object
    request.time_slots = Array.from(selectedSlots);
    console.log(request);
    console.log(JSON.stringify(request));

    const response = await fetch('http://localhost/unigura/api/request', {
      method: 'POST',
      credentials: "include",
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(request)
    });

    // const response = await fetch('http://localhost/unigura/api/request?' + new URLSearchParams(request));

    const result = await response.text();
    console.log(result);

  }else {
    showErrorMessage('Please select at least one time slot');
  }
});