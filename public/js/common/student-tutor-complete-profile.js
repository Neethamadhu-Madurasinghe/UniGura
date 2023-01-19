const mapComponentUI = document.getElementById('map-container');
const longitudeUI = document.getElementById('longitude');
const latitudeUI = document.getElementById('latitude');
const preferredClassModeInputUI = document.getElementById('preferred-class-mode');
const defaultPosition = [longitudeUI.value, latitudeUI.value];

// Script for include map element into form
generateMapComponent();


// Make map component only visible when preferred class Mode is Both and Physical
preferredClassModeInputUI.addEventListener('change', function(e) {
    if(e.target.value !== 'online') {
        mapComponentUI.style.display = 'block';
        longitudeUI.style.display = 'inline';
        latitudeUI.style.display = 'inline';
    }else {
        mapComponentUI.style.display = 'none';
    }
})



// Script to customize file upload button and
// Show Uploaded images in profile picture component

const actualFileUploadBtnUI = document.getElementById('actual-btn');
const profilePictureUI = document.getElementById('profile-picture');

actualFileUploadBtnUI.addEventListener('change', function(){
    profilePictureUI.src = URL.createObjectURL(actualFileUploadBtnUI.files[0])
});

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



    // onclick get the position and display it
    map.on('click', function(e) {
        const point = convertCoordinates(e.coordinate);
        longitudeUI.value = point[0];
        latitudeUI.value = point[1];
        marker.setPosition(e.coordinate);
    });

    // Hide the map by default
    if (preferredClassModeInputUI.value === 'online') {
        mapComponentUI.style.display = 'none';
        longitudeUI.style.display = 'none';
        latitudeUI.style.display = 'none';
    }
}


// Helper function to convert coordinates from EPSG:3857 to EPSG:4326
function convertCoordinates(pos) {
    let x = pos[0];
    let y = pos[1];
    x = (x * 180) / 20037508.34;
    y = (y * 180) / 20037508.34;
    y = (Math.atan(Math.pow(Math.E, y * (Math.PI / 180))) * 360) / Math.PI - 90;
    return [Math.round((x + Number.EPSILON) * 1000000)/1000000, Math.round((y + Number.EPSILON) * 1000000)/1000000];
}


