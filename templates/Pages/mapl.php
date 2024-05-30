<?php
?>
<head>
    <title>Mapview</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
          integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin=""/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/tomik23/autocomplete@1.8.4/dist/css/autocomplete.min.css"/>
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
            integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>
    <script src="https://cdn.jsdelivr.net/gh/tomik23/autocomplete@1.8.4/dist/js/autocomplete.min.js"></script>
</head>

<?php echo $this->Html->css('MarkerCluster') ?>
<?php echo $this->Html->css('MarkerCluster.Default') ?>
<?php echo $this->Html->script('leaflet.markercluster') ?>
<div class="row" style="margin-left: .1rem; margin-right: .1rem">
    <a href="#" id="cheapestInRange">Show Cheap stations table</a>
    <table class="table table-responsive" id="cheapFuelTable" style="display: none">
        <tr id="priceRow"></tr>
        <tr id="stationRow"></tr>
    </table>
</div>
<div class="container-fluid">
    <div class="row" id="maptext">
        <!--        <button class="col-1 btn btn-info" id="cheaptable">Display</button>-->
    </div>
    <div id="map" class="map-container"></div>
<!--    <div id="maprow">-->
<!--        -->
<!--        <footer>-->
<!--            <p id="ftline1" style="font-size: 0.65rem">Loading Station data</p>-->
<!--            <p id="ftline2"style="font-size: 0.65rem">Loading Address info</p>-->
<!--            <p style="font-size: 0.4rem">Data updated on: --><?php //= date_format($latestinfo[0]['lastfetchtime'],'d-M-Y H:i')?><!--</p>-->
            <p id="maprange" style="display: none"></p>
<!--        </footer>-->
<!--    </div>-->
</div>


<style>
    #map {
        width: 100%;
        height: calc(var(--vh, 1vh) * 85);
        min-height: -webkit-fill-available;
        top:0
        flex-grow: 1;
    }

    #maprow{
        top: 0;
        display: flex;
        flex-flow: column;
        min-height: calc(100vh - 125px);
        min-height: -webkit-fill-available;
    }

    footer p{
        bottom: 0;
        margin-bottom: env(safe-area-inset-bottom);
    }

    .container-fluid {
        display: flex;
        width: 100%;
        height: 100%;
    }

    .map-container {
        height: 400px; /* 临时设置一个初始高度 */
        width: 100%;
        flex-grow: 1;  /* 这将使地图填充剩余空间 */
    }
</style>

<script>
    const intype = <?= $intype;?>;
    let iconurl = window.location.origin+'/img/fuel/'
    let priceinfo = <?= json_encode($priceinfo);?>;
    let fueltype = window.location.pathname.replace("/mapview/","");
    const map = L.map('map',{ minZoom: 5.5, maxZoom: 16 }).setView([-28, 133], 6);
    map.attributionControl.setPrefix("Leaflet")
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 16,
        minZoom: 5.5,
        attribution: 'DynastyFuel © OpenStreetMap'
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
        let brandObject= [
            // Fuel Stations
            {brand: "7-eleven", keyword:"eleven", img: "/img/fuel/711.png"},
            {brand: "AM/PM", keyword:"am/pm", img: "/img/fuel/ampm.png"},
            {brand: "Ampol", keyword:"ampol", img: "/img/fuel/ampol.png"},
            {brand: "BOC", keyword:"boc", img: "/img/fuel/boc.png"},
            {brand: "BP", keyword:"bp", img: "/img/fuel/bp.png"},
            {brand: "Budget", keyword:"budget", img: "/img/fuel/budget.png"},
            {brand: "Woolworths", keyword:"woolworths", img: "/img/fuel/caltexwws.png"},
            {brand: "Caltex", keyword:"caltex", img: "/img/fuel/caltex.png"},
            {brand: "Coles", keyword:"coles", img: "/img/fuel/colesexp.png"},
            {brand: "Costco", keyword:"costco", img: "/img/fuel/costco.png"},
            {brand: "Enhance", keyword:"enhance", img: "/img/fuel/enhance.png"},
            {brand: "Inland", keyword:"inland", img: "/img/fuel/inland.png"},
            {brand: "Liberty", keyword:"liberty", img: "/img/fuel/liberty.png"},
            {brand: "Lowes", keyword:"lowes", img: "/img/fuel/lowes.png"},
            {brand: "Matilda", keyword:"matilda", img: "/img/fuel/matilda.png"},
            {brand: "Metro", keyword:"metro", img: "/img/fuel/metro.png"},
            {brand: "Mobil", keyword:"mobil", img: "/img/fuel/mobil.png"},
            {brand: "Mogas", keyword:"mogas", img: "/img/fuel/mogas.png"},
            {brand: "Puma", keyword:"puma", img: "/img/fuel/puma.png"},
            {brand: "Shell", keyword:"shell", img: "/img/fuel/shell.png"},
            {brand: "Speedway", keyword:"speedway", img: "/img/fuel/speedway.png"},
            {brand: "United", keyword:"united", img: "/img/fuel/united.png"},
            {brand: "Vibe", keyword:"vibe", img: "/img/fuel/vibe.png"},
            {brand: "Westside", keyword:"mogas", img: "/img/fuel/westside.png"},
            {brand: "X Convenience", keyword:"mogas", img: "/img/fuel/x.png"},

            // EV Series
            {brand: "Chargefox", keyword:"chargefox", img: "/img/fuel/chargefox.png"},
            {brand: "ChargePoint", keyword:"chargepoint", img: "/img/fuel/chargepoint.png"},
            {brand: "Everty", keyword:"everty", img: "/img/fuel/everty.png"},
            {brand: "Evie", keyword:"evie", img: "/img/fuel/evie.png"},
            {brand: "EVUp", keyword:"evup", img: "/img/fuel/evup.png"},
            {brand: "NRMA", keyword:"nrma", img: "/img/fuel/nrma.png"},
            {brand: "Tesla", keyword:"tesla", img: "/img/fuel/tesla.png"},
        ]

        for (let i = 0; i < brandObject.length; i++) {
            if (currentStation.brand.toLowerCase().includes(brandObject[i]['keyword'])){
                iconurl = window.location.origin+brandObject[i]['img']
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

    function setNewArea(){
        const bounds = map.getBounds()
        updateCoordInfo(bounds._northEast, bounds._southWest)
        getCheapStation(bounds._northEast, bounds._southWest)
        map.fitBounds(bounds)
    }

    document.querySelector("#cheapestInRange").addEventListener("click",function(){
        map.invalidateSize(true);
        if (document.querySelector("#cheapestInRange").innerText.includes("Show")){
            document.querySelector("#cheapestInRange").innerText = "Hide Cheap stations table"
            document.querySelector("#cheapFuelTable").style.display = null
        } else {
            document.querySelector("#cheapestInRange").innerText = "Show Cheap stations table"
            document.querySelector("#cheapFuelTable").style.display = "none"
        }
        map.invalidateSize(true);
    })

    document.addEventListener("DOMContentLoaded",function(){
        const bounds = map.getBounds()
        updateCoordInfo(bounds._northEast, bounds._southWest);
        let cheapStationInfo = getCheapStation(bounds._northEast, bounds._southWest);
        if (cheapStationInfo.length <=0){
            document.querySelector("#priceRow").innerHTML = "<td colspan='5'>No station data available in range.</td>"
            document.querySelector("#stationRow").innerHTML = ""
        }
        if (intype === 0){
            document.querySelector("#priceRow").innerHTML = "<td colspan='5'>Select a fuel type to show cheapest station info.</td>"
            document.querySelector("#stationRow").innerHTML = ""
        }
    })

    function getCheapStation(ne,sw){
        var priceRank=[]
        priceinfo.forEach(function (currentStation, seq, arr) {
            if (currentStation['loc_lat'] < ne.lat && currentStation['loc_lat'] > sw.lat && currentStation['loc_lng'] < ne.lng && currentStation['loc_lng'] > sw.lng){
                //     当站点在范围内时候
                if (currentStation[fueltype]){
                    priceRank.push(currentStation)
                }
            }
        });

        priceRank.sort(function(a,b){
            return a[fueltype]-b[fueltype]
        })

        if (priceRank.length>0 && intype>0){
            document.querySelector("#priceRow").innerHTML = ""
            document.querySelector("#stationRow").innerHTML = ""
            for (let i = 0; i < priceRank.length && i<5; i++) {
                document.querySelector("#priceRow").innerHTML += `<td>${priceRank[i][fueltype]}</td>`
                var stationName = document.createElement("td")
                var stationLink = document.createElement("a")
                stationLink.style = "font-size: xx-small"
                stationLink.textContent = priceRank[i]["name"].length <= 20 ? priceRank[i]["name"] : priceRank[i]["name"].substring(0,20) + "..."
                stationLink.href="#"
                stationLink.addEventListener("click", function(){
                    map.setView([priceRank[i]["loc_lat"],priceRank[i]["loc_lng"]],18)
                })
                stationName.append(stationLink)
                document.querySelector("#stationRow").append(stationName)
            }
        } else if (intype <= 0){
            document.querySelector("#priceRow").innerHTML = "<td colspan='5'>Select a fuel type to show cheapest station info.</td>"
            document.querySelector("#stationRow").innerHTML = ""
        } else if (priceRank.length<=0){
            document.querySelector("#priceRow").innerHTML = "<td colspan='5'>No station data available in range.</td>"
            document.querySelector("#stationRow").innerHTML = ""
        }

        return priceRank
    }

    function updateCoordInfo(north, south){
        markerPlace.innerText = (south === undefined ? "Map Moving" : `NE:${north},SW:${south}`);
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
