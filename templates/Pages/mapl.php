<?php
?>
<head>
    <title>Mapview</title>
</head>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
      integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
        integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/tomik23/autocomplete@1.8.4/dist/css/autocomplete.min.css"/>
<script src="https://cdn.jsdelivr.net/gh/tomik23/autocomplete@1.8.4/dist/js/autocomplete.min.js"></script>

<?php echo $this->Html->css('MarkerCluster') ?>
<?php echo $this->Html->css('MarkerCluster.Default') ?>
<?php echo $this->Html->script('leaflet.markercluster') ?>


<div id="maprow" style="display: flex;flex-direction: column;height: 100%;">
    <div id="map"></div>
    <footer>
        <p id="ftline1" style="font-size: 0.65rem">Loading Station data</p>
        <p id="ftline2"style="font-size: 0.65rem">Loading Address info</p>
        <p style="font-size: 0.4rem">Data updated on: <?= date_format($latestinfo[0]['lastfetchtime'],'d-M-Y H:i')?></p>
        <p id="maprange" style="display: none"></p>
    </footer>
</div>


<style>
    #map {
        /*height: 100vh; !* Set height to 100% of viewport height *!*/
        width: 100vw; /* Set width to 100% of viewport width */
        height: calc(100vh - 100px);
    }
    .row {
        flex: 0;
    }

    #maprow{
        top: 0;
        width: 99vw;
        min-width: 100%;
        display: flex;
        flex-flow: column;
        min-height: calc(100vh - 110px);
        min-height: -webkit-fill-available;
    }

    footer p{
        bottom: 0;
        margin-bottom: env(safe-area-inset-bottom);
    }
</style>

<script>
    const intype = <?= $intype;?>;
    let iconurl = window.location.origin+'/img/fuel/'
    let priceinfo = <?= json_encode($priceinfo);?>;
    let fueltype = window.location.pathname.replace("/mapview/","");
    let config = {
        minZoom: 5.5,
        maxZoom: 16
    }
    const map = L.map('map',config).setView([-28, 133], 6);
    map.attributionControl.setPrefix("Leaflet")
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 16,
        minZoom: 5.5,
        attribution: '0xJoy © OpenStreetMap'
    }).addTo(map);
    map.locate({setView: true, maxZoom: 16});

    let markers = L.markerClusterGroup();
    const fueltypearr = ['B20','DL','E10','E85','EV','LAF','LPG','P95','P98','PDL','U91']
    priceinfo.forEach(function (currentStation, seq, arr){
        let customPopup = `<div style="width:300px"><h6>${currentStation.name}</h6><hr>
            <p>Address: <a target="_blank" href="https://www.google.com/maps/dir/?api=1&destination=${currentStation.loc_lat}%2C${currentStation.loc_lng}">${currentStation.address} `+
            (currentStation.suburb !== null ? currentStation.suburb : "")+
            `${currentStation.state} `+(currentStation.postcode !== null ? currentStation.postcode : "") +
            `</a></p><br>`;
        if (intype === 1){
            customPopup += `<p>${fueltype}: ${currentStation[fueltype]}</p>`
        } else {
            fueltypearr.forEach(function(thistype, seq, arr){
                if (currentStation[thistype] !== null){
                    customPopup += `<p>${thistype.replace("LPG", "Gas").replace("P", "Premium ").replace("DL", "Diesel").replace("U", "Unleaded ").replace("B", "Bio-diesel").replace("Gas","LPG")}: ${currentStation[thistype]}</p>`
                }
            })
        }
        customPopup += '</div>'

        const customOptions = {maxWidth: "auto", className: "customPopup",};

        let iconurl = window.location.origin+'/img/fuel/gas.png'
        if (currentStation.brand !== null) {
            if (currentStation.brand.toLowerCase().includes("7-eleven")) {
                iconurl = window.location.origin + '/img/fuel/711.png'
            } else if (currentStation.brand.toLowerCase().includes("am/pm")) {
                iconurl = window.location.origin + '/img/fuel/ampm.png'
            } else if (currentStation.brand.toLowerCase().includes("ampol")) {
                iconurl = window.location.origin + '/img/fuel/ampol.png'
            } else if (currentStation.brand.toLowerCase().includes("boc")) {
                iconurl = window.location.origin + '/img/fuel/boc.png'
            } else if (currentStation.brand.toLowerCase().includes("bp")) {
                iconurl = window.location.origin + '/img/fuel/bp.png'
            } else if (currentStation.brand.toLowerCase().includes("budget")) {
                iconurl = window.location.origin + '/img/fuel/budget.png'
            } else if (currentStation.brand.toLowerCase().includes("woolworths")) {
                iconurl = window.location.origin + '/img/fuel/caltexwws.png'
            } else if (currentStation.brand.toLowerCase().includes("caltex")) {
                iconurl = window.location.origin + '/img/fuel/caltex.png'
            } else if (currentStation.brand.toLowerCase().includes("chargefox")) {
                iconurl = window.location.origin + '/img/fuel/chargefox.png'
            } else if (currentStation.brand.toLowerCase().includes("chargepoint")) {
                iconurl = window.location.origin + '/img/fuel/chargepoint.png'
            } else if (currentStation.brand.toLowerCase().includes("coles")) {
                iconurl = window.location.origin + '/img/fuel/colesexp.png'
            } else if (currentStation.brand.toLowerCase().includes("costco")) {
                iconurl = window.location.origin + '/img/fuel/costco.png'
            } else if (currentStation.brand.toLowerCase().includes("enhance")) {
                iconurl = window.location.origin + '/img/fuel/enhance.png'
            } else if (currentStation.brand.toLowerCase().includes("everty")) {
                iconurl = window.location.origin + '/img/fuel/everty.png'
            } else if (currentStation.brand.toLowerCase().includes("evie")) {
                iconurl = window.location.origin + '/img/fuel/evie.png'
            } else if (currentStation.brand.toLowerCase().includes("evup")) {
                iconurl = window.location.origin + '/img/fuel/evup.png'
            } else if (currentStation.brand.toLowerCase().includes("inland")) {
                iconurl = window.location.origin + '/img/fuel/inland.png'
            } else if (currentStation.brand.toLowerCase().includes("liberty")) {
                iconurl = window.location.origin + '/img/fuel/liberty.png'
            } else if (currentStation.brand.toLowerCase().includes("lowes")) {
                iconurl = window.location.origin + '/img/fuel/lowes.png'
            } else if (currentStation.brand.toLowerCase().includes("matilda")) {
                iconurl = window.location.origin + '/img/fuel/matilda.png'
            } else if (currentStation.brand.toLowerCase().includes("metro")) {
                iconurl = window.location.origin + '/img/fuel/metro.png'
            } else if (currentStation.brand.toLowerCase().includes("mobil")) {
                iconurl = window.location.origin + '/img/fuel/mobil.png'
            } else if (currentStation.brand.toLowerCase().includes("mogas")) {
                iconurl = window.location.origin + '/img/fuel/mogas.png'
            } else if (currentStation.brand.toLowerCase().includes("nrma")) {
                iconurl = window.location.origin + '/img/fuel/nrma.png'
            } else if (currentStation.brand.toLowerCase().includes("puma")) {
                iconurl = window.location.origin + '/img/fuel/puma.png'
            } else if (currentStation.brand.toLowerCase().includes("shell")) {
                iconurl = window.location.origin + '/img/fuel/shell.png'
            } else if (currentStation.brand.toLowerCase().includes("speedway")) {
                iconurl = window.location.origin + '/img/fuel/speedway.png'
            } else if (currentStation.brand.toLowerCase().includes("tesla")) {
                iconurl = window.location.origin + '/img/fuel/tesla.png'
            } else if (currentStation.brand.toLowerCase().includes("united")) {
                iconurl = window.location.origin + '/img/fuel/united.png'
            } else if (currentStation.brand.toLowerCase().includes("vibe")) {
                iconurl = window.location.origin + '/img/fuel/vibe.png'
            } else if (currentStation.brand.toLowerCase().includes("westside")) {
                iconurl = window.location.origin + '/img/fuel/westside.png'
            } else if (currentStation.brand.toLowerCase().includes("x convenience")) {
                iconurl = window.location.origin + '/img/fuel/x.png'
            }
        }

        const customicon = L.icon({iconUrl : iconurl, iconSize: [25, 25]})
        let marker = new L.marker([currentStation.loc_lat, currentStation.loc_lng], {
            icon: customicon,
        }).bindPopup(customPopup, customOptions)
        if (intype === 1) {
            marker.bindTooltip(`${currentStation[fueltype]}`, {
                direction: 'top',
                permanent: true,
                offset: L.point({x: 0, y: -15})
            }).openTooltip();
        }
        markers.addLayer(marker);
    })

    map.addLayer(markers);

    function onLocationFound(e) {
        var radius = e.accuracy;

        L.marker(e.latlng).addTo(map).bindPopup("You are here").openPopup();
        L.circle(e.latlng, radius).addTo(map);
    }
    map.on('locationfound', onLocationFound);

    const markerPlace = document.getElementById("maprange");

    map.on("dragend", setNewArea);
    map.on("dragstart", updateCoordInfo);
    map.on("zoomend", setNewArea);

    function updateCoordInfo(north, south){
        markerPlace.innerText = south === undefined ? "Map Moving" : `NE:${north},SW:${south}`;
    }

    function setNewArea(){
        const bounds = map.getBounds()
        updateCoordInfo(bounds._northEast, bounds._southWest)
        map.fitBounds(bounds)
        getCheapestStation(bounds._northEast, bounds._southWest)
    }

    document.addEventListener("DOMContentLoaded", function (){
        const bounds = map.getBounds()
        updateCoordInfo(bounds._northEast, bounds._southWest);
        getCheapestStation(bounds._northEast, bounds._southWest);
    })

    function getCheapestStation(ne,sw){
        let cheapeststation = null
        if (intype === 0){
            document.getElementById('ftline1').innerText = 'Select a fuel type to show cheapest station info.';
            document.getElementById('ftline2').style.display = 'none';
            return ;
        }
        document.getElementById('ftline1').innerText = `No station data available in range.`
        document.getElementById('ftline2').innerText = `......`
        priceinfo.forEach(function (currentStation, seq, arr) {
            if (currentStation['loc_lat'] < ne.lat && currentStation['loc_lat'] > sw.lat &&
                currentStation['loc_lng'] < ne.lng && currentStation['loc_lng'] > sw.lng)
                if (cheapeststation === null) {
                    cheapeststation = currentStation
                    document.getElementById('ftline1').innerHTML = `Cheapest ${fueltype}: ${currentStation[fueltype]} @ <a target="_blank" href="https://www.google.com/maps/dir/?api=1&destination=${currentStation['loc_lat']}%2C${currentStation['loc_lng']}&travelmode=driving">${currentStation['name']}</a>`
                    document.getElementById('ftline2').innerText = `Addr: ${currentStation['address']}, ${currentStation['suburb']}, ${currentStation['state']} ${currentStation['postcode']}`
                } else if (cheapeststation[fueltype] > currentStation[fueltype]) {
                    cheapeststation = currentStation
                    document.getElementById('ftline1').innerHTML = `Cheapest ${fueltype}: ${currentStation[fueltype]} @ <a target="_blank" href="https://www.google.com/maps/dir/?api=1&destination=${currentStation['loc_lat']}%2C${currentStation['loc_lng']}&travelmode=driving">${currentStation['name']}</a>`
                    document.getElementById('ftline2').innerText = `Addr: ${currentStation['address']}, ${currentStation['suburb']}, ${currentStation['state']} ${currentStation['postcode']}`
                }
        });
    }
</script>
<script>
    let vh = window.innerHeight * 0.01;
    document.documentElement.style.setProperty('--vh', `${vh}px`);
</script>
<script data-name="BMC-Widget" data-cfasync="false" src="https://cdnjs.buymeacoffee.com/1.0.0/widget.prod.min.js"
        data-id="DynastyKids" data-description="Support me on Buy me a coffee!"
        data-message="If you are happy with it, you can support the server running cost."
        data-color="#FFDD00" data-position="Right" data-x_margin="18" data-y_margin="36"></script>
