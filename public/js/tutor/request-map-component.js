if(request_obj.mode == 'physical'){
    // request_container.querySelector('#location').innerHTML = `<div></div>`;

    let map = new ol.Map({
        target: 'map-container',
        layers: [
            new ol.layer.Tile({
                source: new ol.source.OSM()
            }),
        ],
        view: new ol.View({
            center: ol.proj.fromLonLat([request_obj.latitude, request_obj.longitude]),
            zoom: 15
        })
    });

    // Setting up the dot layer on the map
    const dotLayer = new ol.layer.Vector({
        source: new ol.source.Vector(),
        style: new ol.style.Style({
            image: new ol.style.RegularShape({
                fill: new ol.style.Fill({ color: 'red' }),
                stroke: new ol.style.Stroke({ color: 'black', width: 1 }),
                points: 100,
                radius: 5,
                angle: Math.PI / 4,
            }),
        }),
    });

    map.addLayer(dotLayer);
    let dot = new ol.Feature({
        geometry: new ol.geom.Point(ol.proj.fromLonLat([request_obj.latitude, request_obj.longitude])),
    });
    dotLayer.getSource().addFeature(dot)

//     Hide the map component
} else {
    document.getElementById('map-container').style.display = 'none';
}