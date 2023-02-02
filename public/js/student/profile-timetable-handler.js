
const dataElement = document.getElementById('template-data');
const timeTableUI = document.getElementById('time-table');
let unsortedTimeSlots = [];
let sortedTimeSlots
let request = {
  duration: 0,
  template_id: 0,
  tutor_id: 0,
  mode: '',
  time_slots: []
}

// This set contains the slot id of slots selected by user
let selectedSlots = new Set();

requestTimeTable();

async function requestTimeTable() {
  request.tutor_id = dataElement.dataset.tutor;
  request.template_id = dataElement.dataset.template;
  request.duration = dataElement.dataset.duration;
  request.mode = dataElement.dataset.mode;

  const respond = await fetch('http://localhost/unigura/api/time-table?' + new URLSearchParams({ tutor_id: request.tutor_id}));
  unsortedTimeSlots = await respond.json();
  sortedTimeSlots = sortTimeSlot(unsortedTimeSlots, request.duration/2);
  // Remove unusable time slots eg- if class requires 2 slots, then remove all isolated single timeslots
  removeUnusableSlots(unsortedTimeSlots, request.duration/2);

  renderTimeTable(sortedTimeSlots);
}

// Event listners to time slots
bodyUI.addEventListener('click', e => {
  const selectedSlotIndex = e.target.dataset.index;

  // If the time slot is already selected - then unselect the clicked timeslot and the consecutive slots
  // Here, unsortedTimeSlots is a gloabal array that contains the all timeslot objects came from server as they are
  if (e.target.classList.contains('slot-selected')) {

    for(let i = 0; i < request.duration/2; i++) {
      unsortedTimeSlots.forEach(timeslot => {
        // To unselect both before and after time slots
        if (timeslot.index == parseInt(selectedSlotIndex) + 10*i || timeslot.index == parseInt(selectedSlotIndex) - 10*i) {
          timeslot['isSelected'] = 0;
          selectedSlots.delete(timeslot.id);
        }
      });
    }

  renderTimeTable(sortedTimeSlots);
    
  // If the time slot is not selected, then check whether timeslot set starting from here can contain the class 
  }else if (e.target.classList.contains('slot-free')) {
    // Check whether user has already selected other timeslots
    if (selectedSlots.size == request.duration/2) {
      showErrorMessage(`You cannot select more than ${request.duration/2} time slots for a ${request.duration} hour class`);
      return;
    }

    // Check whether the selected slot is capable of having this class
    for(let i = 0; i < request.duration/2; i++) {
      if(getStateByIndex(unsortedTimeSlots, parseInt(selectedSlotIndex) + 10*i) != 1) {
        showErrorMessage('This timeslot cannot be selected');
        return;
      }
    }

    for(let i = 0; i < request.duration/2; i++) {
      unsortedTimeSlots.forEach(timeslot => {
        if (timeslot.index == parseInt(selectedSlotIndex) + 10*i) {
          timeslot['isSelected'] = 1;
          selectedSlots.add(timeslot.id);
        }
      });
    }
    
  renderTimeTable(sortedTimeSlots);
  }

});


// Helper function to remove unconsecutive time slots - This function requires timeslots to ordered in Day, Time
function removeUnusableSlots(timeslots, slotSize = 1) {
  let tempSortedTimeSlots = [];

  const chunkSize = 8;
  for (let i = 0; i < timeslots.length; i += chunkSize) {
    const chunk = timeslots.slice(i, i + chunkSize);
    tempSortedTimeSlots.push(chunk);
  }


  // Remove timeslots that cannot be used because the class duration is too big
  tempSortedTimeSlots.forEach(dayTimeSlots => {
    stateArray = [];
    tempArray = Array(8).fill(0);

    dayTimeSlots.forEach(dayTimeSlot => {
      stateArray.push(dayTimeSlot.state)
    });

    for (let i = 0; i < stateArray.length - slotSize + 1; i++) {
      let flag = true;
      for (let j = 0; j < slotSize; j++) {
        if (stateArray[i + j] != 1) {
            flag = false;
        }
      }

      if (flag) {
        for (let j = i; j < i + slotSize; j++) {
          tempArray[j] = 1;
         }
      }
    }
    console.log(stateArray);
    console.log(tempArray);

    dayTimeSlots.forEach((dayTimeSlot, idx) => {
      dayTimeSlot.state = tempArray[idx];
    });
  })
  

  return tempSortedTimeSlots;
}

// Helper function to sort timeslot according to time and day and make sub arrays based on the day
function sortTimeSlot(timeslots) {
  timeslots = timeslots.map(time_slot => {
    switch (time_slot.time) {
      case '08:00:00':
        time_slot['index'] = 0;
        break;
      case '10:00:00':
        time_slot['index'] = 10;
        break;
      case '12:00:00':
        time_slot['index'] = 20;
        break;
      case '14:00:00':
        time_slot['index'] = 30;
        break;
      case '16:00:00':
        time_slot['index'] = 40;
        break;
      case '18:00:00':
        time_slot['index'] = 50;
        break;
      case '20:00:00':
        time_slot['index'] = 60;
        break;
      default:
        time_slot['index'] = 70;
        break;
    }

    return time_slot;
  });

  timeslots = timeslots.map(time_slot => {
    switch (time_slot.day) {
      case 'mon':
        time_slot['index'] = time_slot['index'] + 0;
        break;
      case 'tue':
        time_slot['index'] = time_slot['index'] + 1;
        break;
      case 'wed':
        time_slot['index'] = time_slot['index'] + 2;
        break;
      case 'thu':
        time_slot['index'] = time_slot['index'] + 3;
        break;
      case 'fri':
        time_slot['index'] = time_slot['index'] + 4;
        break;
      case 'sat':
        time_slot['index'] = time_slot['index'] + 5;
        break;
      default:
        time_slot['index'] = time_slot['index'] + 6;
        break;
    }

    return time_slot;
  });

  function compare( a, b ) {
    if ( a.index < b.index ){
      return -1;
    }
    if ( a.index > b.index ){
      return 1;
    }
    return 0;
  }

  timeslots =  timeslots.sort(compare);
  let tempSortedTimeSlots = [];

  // Make chunks from the sorted array
  const chunkSize = 7;
  for (let i = 0; i < timeslots.length; i += chunkSize) {
    const chunk = timeslots.slice(i, i + chunkSize);
    tempSortedTimeSlots.push(chunk);
  }

  return tempSortedTimeSlots;
}

// Helper function to find the state of the timeslot when the index is given (index that is assigned by frontend)
function getStateByIndex(timeslots, index) {
  let state = 0;
  timeslots.forEach(timeslot => {
    if (timeslot.index == index) {
      state = timeslot.state;
    }
  });

  return state;
}

// Function to render the time table given the timeslot array 
function renderTimeTable(timeslots) {
  const timeIntervals = [
    '<th>8.00-10.00</th>', '<th>10.00-12.00</th>', '<th>12.00-14.00</th>', '<th>14.00-16.00</th>',
    '<th>16.00-18.00</th>', '<th>18.00-20.00</th>', '<th>20.00-22.00</th>', '<th>22.00-00.00</th>'
  ]

  // Set the head row of the table
  timeTableUI.innerHTML = `
  <tr class="time-table-titles">
    <th>Time</th> <th>Monday</th> <th>Tuesday</th> <th>Wednesday</th> <th>Thursday</th> <th>Friday</th> <th>Satday</th> <th>Sunday</th>
  </tr>
  `
  
  // Use the sorted array of slots to contruct the rest of the time table
  timeslots.forEach((timeArray, idx) => {
    const timeTableRowUI = document.createElement('tr');
    timeTableRowUI.innerHTML = timeIntervals[idx]; 

    timeArray.forEach(timeSlot => {
      if (timeSlot.state == 0 || timeSlot.state == 2) {
        timeTableRowUI.innerHTML += `<td class="slot slot-used" data-id=${timeSlot.id} data-state=${timeSlot.state} data-index=${timeSlot.index}></td>`;
      } else if (timeSlot.isSelected) {
        timeTableRowUI.innerHTML += `<td class="slot slot-free slot-selected" data-id=${timeSlot.id} data-state=${timeSlot.state} data-index=${timeSlot.index}></td>`;
      }else {
        timeTableRowUI.innerHTML += `<td class="slot slot-free" data-id=${timeSlot.id} data-state=${timeSlot.state} data-index=${timeSlot.index}></td>`;
      }

    });

    timeTableUI.appendChild(timeTableRowUI);
  });
}
