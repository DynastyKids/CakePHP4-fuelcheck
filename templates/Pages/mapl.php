<?php

?>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ==" crossorigin="" />
<script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js" integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ==" crossorigin=""></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/tomik23/autocomplete@1.8.4/dist/css/autocomplete.min.css"/>
<script src="https://cdn.jsdelivr.net/gh/tomik23/autocomplete@1.8.4/dist/js/autocomplete.min.js"></script>

<?php echo $this->Html->css('MarkerCluster') ?>
<?php echo $this->Html->css('MarkerCluster.Default') ?>
<?php echo $this->Html->script('leaflet.markercluster') ?>

<div class="row" style="display: flex;top:0">
    <div id="map"></div>
</div>

<style>
    #map {
        width: 100%;
        height: 90vh;
        top:0
    }
</style>

<script>
    var priceinfo = <?php echo json_encode($priceinfo,JSON_HEX_TAG);?>;
    let fueltype = window.location.pathname.substr(9);
    var map = L.map('map').setView([-28, 133], 4.5);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 20,
        attribution: 'CakeFuel © OpenStreetMap'
    }).addTo(map);
    map.locate({setView: true, maxZoom: 20});

    var markers = L.markerClusterGroup();
    let states=["nsw","tas","wa","sa","nt","qld","vic","act"]

    states.forEach(function (state) {
        console.log(priceinfo)
        priceinfo[state].forEach(function (station) {

            const customPopup =
                '<div style="width:300px"><h6>'+station.name+'</h6><hr><p>Address: '+station.address+'</p><p>'+fueltype+': '+ station[fueltype]+'</p></div>';
            const customOptions = {maxWidth: "auto", className: "customPopup",};

            let marker = new L.marker([station.loc_lat, station.loc_lng]).bindPopup(customPopup,customOptions);
            // let marker = new L.marker([station.loc_lat, station.loc_lng],{icon: theicon}).bindPopup(customPopup,customOptions);
            markers.addLayer(marker);
        })
    })
    map.addLayer(markers);

    function onLocationFound(e) {
        var radius = e.accuracy;

        L.marker(e.latlng).addTo(map).bindPopup("You are here").openPopup();
        L.circle(e.latlng, radius).addTo(map);
    }
    map.on('locationfound', onLocationFound);

    // --------------------------------------------------------------
    // Search & zoom to location

    // add "random" button
    const buttonTemplate = `<div class="leaflet-search" style="max-width: 35px"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32"><path d="M31.008 27.231l-7.58-6.447c-0.784-0.705-1.622-1.029-2.299-0.998 1.789-2.096 2.87-4.815 2.87-7.787 0-6.627-5.373-12-12-12s-12 5.373-12 12 5.373 12 12 12c2.972 0 5.691-1.081 7.787-2.87-0.031 0.677 0.293 1.515 0.998 2.299l6.447 7.58c1.104 1.226 2.907 1.33 4.007 0.23s0.997-2.903-0.23-4.007zM12 20c-4.418 0-8-3.582-8-8s3.582-8 8-8 8 3.582 8 8-3.582 8-8 8z"></path></svg></div><div class="auto-search-wrapper max-height"><input type="text" id="marker" autocomplete="off"  aria-describedby="instruction" aria-label="Search ..." /><div id="instruction" class="hidden">When autocomplete results are available use up and down arrows to review and enter to select. Touch device users, explore by touch or with swipe gestures.</div></div>`;

    // create custom button
    const customControl = L.Control.extend({
        // button position
        options: {
            position: "topleft",
            className: "leaflet-autocomplete",
        },

        // method
        onAdd: function () {
            return this._initialLayout();
        },

        _initialLayout: function () {
            // create button
            const container = L.DomUtil.create(
                "div",
                "leaflet-bar " + this.options.className
            );
            L.DomEvent.disableClickPropagation(container);
            container.innerHTML = buttonTemplate;

            return container;
        },
    });

    map.addControl(new customControl()); // New button added
    // --------------------------------------------------------------
    // input element
    const root = document.getElementById("marker");

    function addClassToParent() {
        const searchBtn = document.querySelector(".leaflet-search");
        searchBtn.addEventListener("click", (e) => {
            e.target.closest(".leaflet-autocomplete").classList.toggle("active-autocomplete");

            root.placeholder = "Input a location";
            root.focus();
            clickOnClearButton();
        });
    }

    function clickOnClearButton() {
        document.querySelector(".auto-clear").click();
    }

    addClassToParent();
    map.on("click", () => {
        document
            .querySelector(".leaflet-autocomplete")
            .classList.remove("active-autocomplete");

        clickOnClearButton();
    });

    // autocomplete section, Credit / Reference: https://github.com/tomik23/autocomplete

    new Autocomplete("marker", {
        delay: 1000,
        selectFirst: true,
        howManyCharacters: 3,

        onSearch: function ({ currentValue }) {
            const api = `https://nominatim.openstreetmap.org/search?format=geojson&limit=5&q=${encodeURI(currentValue)}`;
            //Promise call
            return new Promise((resolve) => {
                fetch(api).then((response) => response.json())
                    .then((data) => {
                        resolve(data.features);
                    })
                    .catch((error) => {
                        console.error(error);
                    });
            });
        },

        onResults: ({ currentValue, matches, template }) => {
            const regex = new RegExp(currentValue, "i");
            // checking if we have results if we don't take data from the noResults method
            return matches === 0 ? template : matches.map((element) =>
            {
                return `<li role="option"><p>${element.properties.display_name.replace(regex, (str) => `<b>${str}</b>`)}</p></li> `;})
                .join("");
        },

        onSubmit: ({ object }) => {
            const { display_name } = object.properties;
            const cord = object.geometry.coordinates;

            map.eachLayer(function (layer) {
                if (layer.options && layer.options.pane === "markerPane") {
                    if (layer._icon.classList.contains("leaflet-marker-locate")) {
                        map.removeLayer(layer);
                    }
                }
            });

            const marker = L.marker([cord[1], cord[0]], {   // add marker
                title: display_name,
            });
            marker.addTo(map).bindPopup(display_name); // add marker to map

            map.setView([cord[1], cord[0]], 8); // set marker to coordinates

            L.DomUtil.addClass(marker._icon, "leaflet-marker-locate");  // add class to marker
        },

        // the method presents no results
        noResults: ({ currentValue, template }) =>
            template(`<li>No results found: "${currentValue}"</li>`),
    });
</script>
