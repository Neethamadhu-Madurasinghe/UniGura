const bodyUI = document.getElementsByTagName('body')[0];
const layoutBackgroundUI = document.querySelector('.layout-background');
const errorLayoutBackground = document.querySelector('.error-layout-background');
const errorPopupUI = document.querySelector('.popup-error-message');
const errorMessageUI = document.getElementById('error-message');
const successPopupUI = document.querySelector('.popup-success-message');
const successMessageUI = document.getElementById('success-message');

const mapComponentUI = document.getElementById('map-container');
const _longitudeUI = document.getElementById('longitude');
const _latitudeUI = document.getElementById('latitude');
const _locationUI = document.getElementById('location');
const _distanceUI = document.getElementById('distance');
const _modeUI = document.getElementById('mode');

// In server, Latitude comes first and then Longitude
// But open layers follows Longitude first and Latitude
const defaultPosition = [_longitudeUI.value, _latitudeUI.value];

// Script for include map element into form
generateMapComponent();

// Hide or show location filters at the beginning
if (_modeUI.value == 'online') {
  _distanceUI.style.display = 'none';
   _locationUI.style.display = 'none';
}


// Make Location type and distance filters visible iff mode is not online
_modeUI.addEventListener('change', function(e) {
  if(e.target.value !== 'online') {
    if(_locationUI.value == 'custom') {
      mapComponentUI.style.display = 'block';
    }
    _distanceUI.style.display = 'inline';
    _locationUI.style.display = 'inline';
  }else {
    _distanceUI.style.display = 'none';
    _locationUI.style.display = 'none';
    mapComponentUI.style.display = 'none';
  }
})


// Make map component only visisble when preferd class Mode is Both and Physical
_locationUI.addEventListener('change', function(e) {
  if(e.target.value !== 'default') {
    mapComponentUI.style.display = 'block';
    _longitudeUI.style.display = 'inline';
    _latitudeUI.style.display = 'inline';
  }else {
    mapComponentUI.style.display = 'none';
  }
})


function generateMapComponent() {
  let map = new ol.Map({
    target: 'map',
    layers: [
      new ol.layer.Tile({
        source: new ol.source.OSM()
      })
    ],
    view: new ol.View({
      center: ol.proj.fromLonLat(defaultPosition),
      zoom: 15
    })
  });
  
  let marker_el = document.getElementById('marker');
  
  // Making a marker overlay
  let marker = new ol.Overlay({
    position: ol.proj.fromLonLat(defaultPosition),
    positioning: 'center-center',
    element: marker_el,
    stopEvent: false,
    dragging: false
  });
  
  map.addOverlay(marker);
  
  
  _longitudeUI.value = defaultPosition[0];
  _latitudeUI.value = defaultPosition[1];
  
  
  // onclick get the position and display it
  map.on('click', function(e) {
    const point = convertCoodinates(e.coordinate);
    _longitudeUI.value = point[0];
    _latitudeUI.value = point[1];
    marker.setPosition(e.coordinate);
  });  

  // Hide the map by defualt
  mapComponentUI.style.display = 'none';
  _longitudeUI.style.display = 'none';
  _latitudeUI.style.display = 'none';
}



// Helper function to convert coodinates from EPSG:3857 to EPSG:4326
function convertCoodinates(pos) {
  let x = pos[0];
  let y = pos[1];
  x = (x * 180) / 20037508.34;
  y = (y * 180) / 20037508.34;
  y = (Math.atan(Math.pow(Math.E, y * (Math.PI / 180))) * 360) / Math.PI - 90;
  return [Math.round((x + Number.EPSILON) * 1000000)/1000000, Math.round((y + Number.EPSILON) * 1000000)/1000000];
}



// Error Message showing function
function showErrorMessage(message, callback = null) {
  bodyUI.classList.add('error-layout-mode');
  errorLayoutBackground.classList.remove('invisible');
  errorMessageUI.textContent = message;
  errorPopupUI.classList.remove('invisible');

  errorOkButtonUI = document.getElementById('error-ok');

  const event = errorOkButtonUI.addEventListener('click', e => {
    errorPopupUI.classList.add('invisible');
    bodyUI.classList.remove('error-layout-mode');
    errorLayoutBackground.classList.add('invisible');
    errorOkButtonUI.removeEventListener('click', event);
    if(callback) callback();
  });
}

// Success Message showing function
function showSuccessMessage(message, callback = null) {
  bodyUI.classList.add('error-layout-mode');
  errorLayoutBackground.classList.remove('invisible');
  successMessageUI.textContent = message;
  successPopupUI.classList.remove('invisible');

  successOkButtonUI = document.getElementById('success-ok');

  const event = successOkButtonUI.addEventListener('click', e => {
    successPopupUI.classList.add('invisible');
    bodyUI.classList.remove('error-layout-mode');
    errorLayoutBackground.classList.add('invisible');
    successOkButtonUI.removeEventListener('click', event);
    if(callback) callback();
  });
}

// Show layout background
function showLayoutBackground() {
  bodyUI.classList.add('layout-mode');
  layoutBackgroundUI.classList.remove('invisible');
}


// Hide layout background
function hideLayoutBackground() {
  bodyUI.classList.remove('layout-mode');
  layoutBackgroundUI.classList.add('invisible');
}

