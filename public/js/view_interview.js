// Initialize and add the map
function initMap() {
    // The location of Uluru
    var latitude = $('#latitude').val();
    var longitude = $('#longitude').val();
    var location = $('#location').val();
    const uluru = { lat: Number(latitude), lng: Number(longitude) };
    // The map, centered at Uluru
    const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 4,
        center: uluru,
    });
    // The marker, positioned at Uluru
    const marker = new google.maps.Marker({
        position: uluru,
        map: map,
    });

    marker();
}
/*function initMap() {
    var mapElement = document.getElementById('map');
    var url = `/api/map-marker`;


    async function markerscodes() {
        var latitude = $('#latitude').val();
        var longitude = $('#longitude').val();
        var location = $('#location').val();
        mapDisplay(latitude, longitude, location);
    }

    markerscodes();

    function mapDisplay(latitude, longitude, location) {
        //map options
        var options = {
            //center: { lat:6.9586, lng: 79.9662 }, //Heiyanthuduwa
            // center: { lat: 6.9333296, lng: 79.9833294 }, Biygama
            center: {lat: Number(latitude), lng: Number(longitude)},
            zoom: 10
        }
        // Create a map object and specify the DOM element for display.
        var map = new google.maps.Map(mapElement, options);

        var markers = new Array();

        for (let index = 0; index < 1; index++) {
            markers.push({
                coords: {lat: Number(latitude), lng: Number(longitude)},
                //iconImage:'https://maps.google.com/mapfiles/kml/shapes/',
                content: `<div><h5>${location}</h5><p><i class="icon address-icon"></i>${location}</p><p>${location}, ${location}</p><small>${location}</small></div>`
            })
        }

        //loop through marker
        for (var i = 0; i < markers.length; i++) {
            addMarker(markers[i]);
        }

        //addMarker();
        function addMarker(props) {
            var marker = new google.maps.Marker({
                position: props.coords,
                map: map
            });

            if (props.iconImage) {
                marker.setIcon(props.iconImage);
            }

            if (props.content) {

                var infowindow = new google.maps.InfoWindow({
                    content: props.content
                });

                marker.addListener('click', function () {
                    infowindow.open(map, marker);
                });

            }
        }


    };

}*/
