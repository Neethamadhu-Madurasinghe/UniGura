const filterValues = {
  subject: '',
  module: '',
  day: '',
  time: '',
  class_type: '',
  medium: '',
  gender: '',
  price: '',
  mode: '',
  location: '',
  latitude: '',
  longitude: '',
  isDefault: '',
  sort_by: ''
};

let LastSearch = {};

// Getting all the UI elements
const subjectUI = document.getElementById('subject');
let moduleUI = document.getElementById('module');
const dayUI = document.getElementById('day');
const timeUI = document.getElementById('time');
const mediumUI = document.getElementById('medium');
const classTypeUI = document.getElementById('class-type');
const genderUI = document.getElementById('gender');
const priceUI = document.getElementById('price-range');
const priceLabelUI = document.getElementById('class-price-label');
const modeUI = document.getElementById('mode');
const locationUI = document.getElementById('location');
const distanceUI = document.getElementById('distance');
const longitudeUI = document.getElementById('longitude');
const latitudeUI = document.getElementById('latitude');
const isDefaultUI = document.getElementById('is-default');
const sortByUI = document.getElementById('tutor-search-sort-by');
const filterFormUI = document.getElementById('filter-form');
const tutoringClassContainerUI = document.querySelector('.tutor-search-result-container');
const bottomContainerUI = document.querySelector('.bottom-container');
const searchResultAreaUI = document.querySelector('.search-result-title-container');
const searchResultTitleUI = document.getElementById('search-result-title');
const searchResultFilterUI = document.getElementById('search-result-filter');
const paginationUI = document.getElementById("pagination");

// Get initial values from UI elements

filterValues.subject = subjectUI.value;
filterValues.module = moduleUI.value;
filterValues.day = dayUI.value;
filterValues.time = timeUI.value;
filterValues.class_type = classTypeUI.value;
filterValues.medium = mediumUI.value;
filterValues.gender = genderUI.value,
filterValues.price = priceUI.value;
filterValues.mode = modeUI.value;
filterValues.location = locationUI.value;
filterValues.distance = distanceUI.value;
filterValues.latitude = latitudeUI.value;
filterValues.longitude = longitudeUI.value;
filterValues.sort_by = sortByUI.value;

let data;
const itemsPerPage = 9;
let currentPage = 1;




// Event listeners to required fields

// When subject is changed, fetch the Modules under it and show them in Modules select element
subjectUI.addEventListener('change', async (e) => {
  filterValues.subject = subjectUI.value

  const respond = await fetch(`http://localhost/unigura/api/modules?subject_id=${filterValues.subject}`)
  if (respond.status == 200) {
    const result = await respond.json();
    if (result.modules) {
      const optionsUI = moduleUI.getElementsByTagName("option");
      while (optionsUI.length > 0) { 
        moduleUI.removeChild(optionsUI[0]);
      }
      result.modules.forEach(module => {
        const optionUI = document.createElement("option");
        optionUI.value = module.id;  // set the value of the option
        optionUI.text = module.name;
        moduleUI.add(optionUI);
      });
      filterValues.module = moduleUI.value;
    }
  }
 
});


moduleUI.addEventListener('change', e => {
  filterValues.module = moduleUI.value;
});

dayUI.addEventListener('change', e => {
  filterValues.day = dayUI.value;
});


timeUI.addEventListener('change', e => {
  filterValues.time = timeUI.value;
});

classTypeUI.addEventListener('change', e => {
  filterValues.class_type = classTypeUI.value;
});

mediumUI.addEventListener('change', e => {
  filterValues.medium = mediumUI.value;
});

genderUI.addEventListener('change', e => {
  filterValues.gender = genderUI.value;
});

priceUI.addEventListener('change', e => {
  filterValues.price = priceUI.value;
  priceLabelUI.innerText = 'Below ' + priceUI.value + ' LKR';
});

modeUI.addEventListener('change', e => {
  filterValues.mode = modeUI.value;
});

locationUI.addEventListener('change', e => {
  filterValues.location = locationUI.value;
});

distanceUI.addEventListener('change', e => {
  filterValues.distance = distanceUI.value;
});


sortByUI.addEventListener('change', e => {
  filterValues.sort_by = sortByUI.value;
});


// Send search request when user clicks the search button
filterFormUI.addEventListener('submit', async (e) => {
  e.preventDefault();
  sendSearchClassRequest();
  
});

sortByUI.addEventListener('change', e => {
  sendSearchClassRequest();
})

async function sendSearchClassRequest() {
  // Get longitude and latitude values - Cannot take them input elements
  filterValues.longitude = longitudeUI.value;
  filterValues.latitude = latitudeUI.value;
 
  // Sanity check
  // If user has not specified a default location and and the default location is (0, 0) then show an error
  if (filterValues.mode !== 'online' && isDefaultUI.value === 'false' && filterValues.location === 'default') {
    showErrorMessage('You have not specified a default location. Please select a custom location');
    return;
  }


  const respond = await fetch('http://localhost/unigura/api/find-tutoring-class?' + new URLSearchParams(filterValues))
  if(respond.status !== 200) {
    const result  = await respond.json();
    if (result.error) {
      showErrorMessage(result.error);
    } else {
      showErrorMessage('Something went wrong. Please try again');
    }

    console.log(respond);
    return;
  }
  LastSearch = JSON.parse(JSON.stringify(filterValues));

  data = await respond.json()
  console.log(data);

  searchResultAreaUI.classList.remove('invisible');
  bottomContainerUI.classList.remove('invisible');
  // Clear UI elements
  tutoringClassContainerUI.innerHTML = '';
  paginationUI.innerHTML = '';
  showTutorLocationsOnMap([]);
  
  if(data.length > 0) {
    searchResultTitleUI.textContent = 'Search Results';
    searchResultFilterUI.classList.remove('invisible');


    // Display the first dataset
    const upperLimit = data.length >= itemsPerPage ? itemsPerPage : data.length;
    displayData(data, 0, upperLimit);
    // Use pagination to show the rest of the records
    displayPagination(data, itemsPerPage);


  } else {
    searchResultTitleUI.textContent = 'No Search Results';
    searchResultFilterUI.classList.add('invisible')
  }
}


function displayData(data, startIndex, endIndex) {
  const container = document.getElementById("data-container");

  // Array for hold locations of currently showing page's tutors
  let locationArray = [];

  tutoringClassContainerUI.innerHTML = "";
  for (let i = startIndex; i < endIndex; i++) {
    const tutoringClass = data[i];

    // Add locations of the locationArray if the mode is not online
    if (tutoringClass.mode !== 'online') {
      locationArray.push([tutoringClass.latitude, tutoringClass.longitude])
    }

    // Format values
    tutoringClass.first_name = tutoringClass.first_name.charAt(0).toUpperCase() + tutoringClass.first_name.slice(1);
    tutoringClass.last_name = tutoringClass.last_name.charAt(0).toUpperCase() + tutoringClass.last_name.slice(1);
    tutoringClass.class_type = tutoringClass.class_type.charAt(0).toUpperCase() + tutoringClass.class_type.slice(1);

    switch (tutoringClass.medium) {
      case 0:
        tutoringClass.medium = 'Sinhala';
        break;

      case 1:
        tutoringClass.medium = 'English';
        break;
    }

    switch (tutoringClass.education_qualification) {
      case 'advanced-level' :
        tutoringClass.education_qualification = 'Advanced Level';
        break;

      case 'bachelor-degree' :
        tutoringClass.education_qualification = 'Bachelor Degree';
        break;

      case 'masters-degree' :
        tutoringClass.education_qualification = 'Masters Degree';
    }



    const cardString = `
      <div class="tutor-search-card-top-section">
        <div class="tutor-search-card-image-container">
          <img src="${'http://localhost/unigura/' + tutoringClass.profile_picture}" alt="" srcset="">
        </div>
        <div class="tutor-search-card-name-section">
          <h2>${tutoringClass.first_name} ${tutoringClass.last_name}</h2>
          <h3>${tutoringClass.city}</h3>
          <h3>${tutoringClass.education_qualification}</h4>

          <div class="tutor-search-card-rating-container">
            <div class="tutor-search-card-rating">
              <img src="http://localhost/Unigura/public/img/student/star.png" alt="" srcset="">
              <p>${tutoringClass.current_rating}</p>
            </div>
            <p>${tutoringClass.uncompleted_class_count} Active students</p>
          </div>
          <button class="btn btn-sm seemore-btn" 
                  data-template=${tutoringClass.id} 
                  data-mode=${LastSearch.mode} 
                  >
                  See more
          </button>
        </div>
        <div class="tutor-search-card-price-section">
          <div class="price-box">
            <h2>LKR ${tutoringClass.session_rate}</h2>
            <h4>Per Session</h4>
          </div>
        </div>
      </div>
      <div class="tutor-search-card-bottom-section">
        <h2>${tutoringClass.first_name}'s ${tutoringClass.module_name} Class</h2>
        <div class="tutor-search-card-toast-container">
          <div>${tutoringClass.day_count} Days, ${tutoringClass.duration} hours per day, ${tutoringClass.day_count * tutoringClass.session_rate} LKR</div>
          <div>Completed ${tutoringClass.completed_class_count} classes</div>
          <div>${tutoringClass.medium}</div>
          <div>${tutoringClass.class_type}</div>
        </div>

        <p class="tutor-search-card-description">
          ${tutoringClass.description}
        </p>

        <div class="tutor-search-card-button-container">
        <button class="btn btn-sm quick-message-btn" id="message-btn" data-tutor=${tutoringClass.tutor_id}>Message Tutor</button>
        <button class="btn btn-sm send-request-btn"
                data-tutor=${tutoringClass.tutor_id}
                data-template=${tutoringClass.id} 
                data-mode=${LastSearch.mode} 
                data-duration=${tutoringClass.duration}
                >
                Send Tutor Request
        </button>
      </div>
      </div>
      `;

    const tutoringClassCardUI = document.createElement('div');
    tutoringClassCardUI.classList.add('tutor-search-card');
    tutoringClassCardUI.innerHTML = cardString;
    tutoringClassContainerUI.appendChild(tutoringClassCardUI);
    scrollToBottomSection()
  }

//  Send the locationArray to map component update function
  showTutorLocationsOnMap(locationArray);
}

function displayPagination(data, itemsPerPage) {
  const numPages = Math.ceil(data.length / itemsPerPage);

  paginationUI.innerHTML = "";
  for (let i = 1; i <= numPages; i++) {
    const button = document.createElement("button");
    button.textContent = i;
    button.classList.add("pagination-button");
    if (i === currentPage) {
      button.classList.add("active");
    }
    button.addEventListener("click", () => {
      currentPage = i;
      let upperBound = i * itemsPerPage > data.length ? data.length : i * itemsPerPage;
      displayData(data, (i - 1) * itemsPerPage, upperBound);
      displayPagination(data, itemsPerPage);
    });
    paginationUI.appendChild(button);
  }
}

// Scroll down to the result section
function scrollToBottomSection() {
  const topOfBottomContainer = bottomContainerUI.offsetTop;
  const scrollSpeed = 10; // Change this value to adjust the scrolling speed

  function animateScroll() {
    const currentPosition = window.pageYOffset;
    if (currentPosition < topOfBottomContainer) {
      window.scrollTo(0, currentPosition + scrollSpeed);
      window.requestAnimationFrame(animateScroll);
    }
  }

  animateScroll();
}





