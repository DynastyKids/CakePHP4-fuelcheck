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

<div class="container-fluid">
    <div class="row" id="maptext">
        <table class="table table-responsive" id="cheapFuelTable" style="display: none">
            <tr id="rankRow"></tr>
            <tr id="priceRow"></tr>
            <tr id="stationRow"></tr>
        </table>
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
        flex-direction: column;
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
        if (currentStation.brand.includes("Eleven") ){ iconurl = window.location.origin+'/img/fuel/711.png'}
        else if (currentStation.brand.includes("AM/PM") ){ iconurl = window.location.origin+'/img/fuel/ampm.png'}
        else if (currentStation.brand.includes("Ampol") ){ iconurl = window.location.origin+'/img/fuel/ampol.png'}
        else if (currentStation.brand.includes("BOC") ){ iconurl = window.location.origin+'/img/fuel/boc.png'}
        else if (currentStation.brand.includes("BP") ){ iconurl = window.location.origin+'/img/fuel/bp.png'}
        else if (currentStation.brand.includes("Budget") ){ iconurl = window.location.origin+'/img/fuel/budget.png'}
        else if (currentStation.brand.includes("Woolworths") ){ iconurl = window.location.origin+'/img/fuel/caltexwws.png'}
        else if (currentStation.brand.includes("Caltex") ){ iconurl = window.location.origin+'/img/fuel/caltex.png'}
        else if (currentStation.brand.includes("Chargefox") ){ iconurl = window.location.origin+'/img/fuel/chargefox.png'}
        else if (currentStation.brand.includes("ChargePoint") ){ iconurl = window.location.origin+'/img/fuel/chargepoint.png'}
        else if (currentStation.brand.includes("Coles") ){ iconurl = window.location.origin+'/img/fuel/colesexp.png'}
        else if (currentStation.brand.includes("Costco") ){ iconurl = window.location.origin+'/img/fuel/costco.png'}
        else if (currentStation.brand.includes("Enhance") ){ iconurl = window.location.origin+'/img/fuel/enhance.png'}
        else if (currentStation.brand.includes("Everty") ){ iconurl = window.location.origin+'/img/fuel/everty.png'}
        else if (currentStation.brand.includes("Evie") ){ iconurl = window.location.origin+'/img/fuel/evie.png'}
        else if (currentStation.brand.includes("EVUp") ){ iconurl = window.location.origin+'/img/fuel/evup.png'}
        else if (currentStation.brand.includes("Inland") ){ iconurl = window.location.origin+'/img/fuel/inland.png'}
        else if (currentStation.brand.includes("Liberty") ){ iconurl = window.location.origin+'/img/fuel/liberty.png'}
        else if (currentStation.brand.includes("Lowes") ){ iconurl = window.location.origin+'/img/fuel/lowes.png'}
        else if (currentStation.brand.includes("Matilda") ){ iconurl = window.location.origin+'/img/fuel/matilda.png'}
        else if (currentStation.brand.includes("Metro") || currentStation.brand.includes("metro")){ iconurl = window.location.origin+'/img/fuel/metro.png'}
        else if (currentStation.brand.includes("Mobil") ){ iconurl = window.location.origin+'/img/fuel/mobil.png'}
        else if (currentStation.brand.includes("Mogas") ){ iconurl = window.location.origin+'/img/fuel/mogas.png'}
        else if (currentStation.brand.includes("NRMA") ){ iconurl = window.location.origin+'/img/fuel/nrma.png'}
        else if (currentStation.brand.includes("Puma") ){ iconurl = window.location.origin+'/img/fuel/puma.png'}
        else if (currentStation.brand.includes("Shell") ){ iconurl = window.location.origin+'/img/fuel/shell.png'}
        else if (currentStation.brand.includes("Speedway") ){ iconurl = window.location.origin+'/img/fuel/speedway.png'}
        else if (currentStation.brand.includes("Tesla") ){ iconurl = window.location.origin+'/img/fuel/tesla.png'}
        else if (currentStation.brand.includes("United") ){ iconurl = window.location.origin+'/img/fuel/united.png'}
        else if (currentStation.brand.includes("Vibe") ){ iconurl = window.location.origin+'/img/fuel/vibe.png'}
        else if (currentStation.brand.includes("Westside") ){ iconurl = window.location.origin+'/img/fuel/westside.png'}
        else if (currentStation.brand.includes("X Convenience") ){ iconurl = window.location.origin+'/img/fuel/x.png'}

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
        map.fitBounds(bounds)
        console.log(getCheapStation(bounds._northEast, bounds._southWest))
    }

    document.addEventListener("DOMContentLoaded",function(){
        let cheapTableBtn = document.createElement("button")
        cheapTableBtn.textContent = "Show Cheapest Fuel in range"
        cheapTableBtn.className = "btn btn-info"
        cheapTableBtn.id = "cheaptableBtn"
        cheapTableBtn.setAttribute("data-status","closed")
        if (intype > 0){
            document.querySelector("#navbarEnd").append(cheapTableBtn)
        }
        map.invalidateSize(true);

        cheapTableBtn.addEventListener("click",(ev)=>{
            ev.preventDefault()
            if (cheapTableBtn.getAttribute("data-status") === "closed"){
                cheapTableBtn.className = "btn btn-info"
                cheapTableBtn.textContent = "Show Cheapest in range"
                cheapTableBtn.setAttribute("data-status","open")
                document.querySelector("#cheapFuelTable").style = "display:none"
                document.querySelector("#map").style.height = "calc(var(--vh, 1vh) * 85)"
            } else {
                cheapTableBtn.className = "btn btn-secondary"
                cheapTableBtn.textContent = "Hide table"
                cheapTableBtn.setAttribute("data-status","closed")
                document.querySelector("#cheapFuelTable").style = ""
                document.querySelector("#map").style.height = "calc(var(--vh, 1vh) * 65)"
            }
            map.invalidateSize(true);
        })

        console.log(priceinfo)
        const bounds = map.getBounds()
        updateCoordInfo(bounds._northEast, bounds._southWest);
        let cheapStationInfo = getCheapStation(bounds._northEast, bounds._southWest);
        if (cheapStationInfo.length <=0){
            document.querySelector("#rankRow").style = "display:none"
            document.querySelector("#priceRow").innerHTML = "<td colspan='5'>No station data available in range.</td>"
            document.querySelector("#stationRow").innerHTML = ""
        }
        if (intype === 0){
            document.querySelector("#rankRow").style = "display:none"
            document.querySelector("#priceRow").innerHTML = "<td colspan='5'>Select a fuel type to show cheapest station info.</td>"
            document.querySelector("#stationRow").innerHTML = ""
        }

        console.log(bounds._northEast, bounds._southWest)
        console.log(cheapStationInfo)
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

        console.log(intype)
        if (priceRank.length>0 && intype>0){
            document.querySelector("#rankRow").innerHTML = ""
            document.querySelector("#priceRow").innerHTML = ""
            document.querySelector("#stationRow").innerHTML = ""
            for (let i = 0; i < priceRank.length && i<6; i++) {
                document.querySelector("#rankRow").innerHTML += `<td>#${i+1}</td>`
                document.querySelector("#priceRow").innerHTML += `<td>${priceRank[i][fueltype]}</td>`
                var stationName = document.createElement("td")
                var stationLink = document.createElement("a")
                stationLink.style = "font-size: x-small"
                stationLink.textContent = priceRank[i]["name"]
                stationLink.href="#"
                stationLink.addEventListener("click", function(){
                    map.setView([priceRank[i]["loc_lat"],priceRank[i]["loc_lng"]],15)
                })
                stationName.append(stationLink)
                document.querySelector("#stationRow").append(stationName)
            }
        } else if (intype <= 0){
            document.querySelector("#rankRow").style = "display:none"
            document.querySelector("#priceRow").innerHTML = "<td colspan='5'>Select a fuel type to show cheapest station info.</td>"
            document.querySelector("#stationRow").innerHTML = ""
        } else if (priceRank.length<=0){
            document.querySelector("#rankRow").style = "display:none"
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
