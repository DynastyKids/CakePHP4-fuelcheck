<?php $this->disableAutoLayout(); ?>
<!--
=========================================================
* Material Kit 2 - v3.0.4
=========================================================
* Product Page:  https://www.creative-tim.com/product/material-kit
* Copyright 2023 Creative Tim (https://www.creative-tim.com)
* Coded by www.creative-tim.com
 =========================================================
* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software. -->
<!DOCTYPE html>
<html lang="en" itemscope>
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="/img/CTmaterial/apple-icon.png">
    <link rel="icon" type="image/png" href="/img/CTmaterial/favicon.png">

    <title>Mapview V2 - Dynasty Fuel</title>
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700"/>

    <!-- Nucleo Icons -->
    <link href="/css/CTmaterial/nucleo-icons.css" rel="stylesheet"/>
    <link href="/css/CTmaterial/nucleo-svg.css" rel="stylesheet"/>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<!--    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <link id="pagestyle" href="/css/CTmaterial/material-kit.css?v=3.0.4" rel="stylesheet"/>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/tomik23/autocomplete@1.8.4/dist/css/autocomplete.min.css"/>
    <script src="https://cdn.jsdelivr.net/gh/tomik23/autocomplete@1.8.4/dist/js/autocomplete.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/core.min.js"
            integrity="sha512-t8vdA86yKUE154D1VlNn78JbDkjv3HxdK/0MJDMBUXUjshuzRgET0ERp/0MAgYS+8YD9YmFwnz6+FWLz1gRZaw=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/hmac.min.js"
            integrity="sha512-tLNkZ/sTmmvq8RDIGCLU3ZzUYSixlGQxpL0X1LWFnTBdvw0SGurLkjAIh0CtG0oQ/1Yt6MaDiI8Gif05JZqEyQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/sha1.min.js"
            integrity="sha512-NHw1e1pc4RtmcynK88fHt8lpuetTUC0frnLBH6OrjmKGNnwY4nAnNBMjez4DRr9G1b+NtufOXLsF+apmkRCEIw=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/hmac-sha1.min.js"
            integrity="sha512-OahNHQh8EnqAptVvXgLLIT3LOv+irJSkED9oyUvGvh1MULTHriuXGIk8RHFfRffj5ejGREfE9IRWoBCPSZ5XGw=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
          integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
            integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>

    <?php echo $this->Html->css('MarkerCluster') ?>
    <?php echo $this->Html->css('MarkerCluster.Default') ?>
    <?php echo $this->Html->script('leaflet.markercluster') ?>
    <!-- Nepcha Analytics (nepcha.com) -->
    <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
<!--    <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>-->
</head>

<body class="index-page bg-gray-200">
<!-- Navbar -->
<div class="container position-sticky z-index-sticky top-0">
    <div class="row">
        <div class="col-12">
            <nav class="navbar navbar-expand-lg  blur border-radius-xl top-0 z-index-fixed shadow position-absolute my-3 py-2 start-0 end-0 mx-4">
                <div class="container-fluid px-0">
                    <a class="navbar-brand font-weight-bolder ms-sm-3" href="https://demos.creative-tim.com/material-kit/index" rel="tooltip"
                       title="Designed and Coded by Creative Tim" data-placement="bottom" target="_blank">Fuel Mapview</a>
                    <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation"
                            aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
                      <span class="navbar-toggler-icon mt-2">
                        <span class="navbar-toggler-bar bar1"></span>
                        <span class="navbar-toggler-bar bar2"></span>
                        <span class="navbar-toggler-bar bar3"></span>
                      </span>
                    </button>
                    <div class="collapse navbar-collapse pt-3 pb-2 py-lg-0 w-100" id="navigation">
                        <ul class="navbar-nav navbar-nav-hover ms-auto">
                            <li class="nav-item ms-lg-auto">
                                <a class="nav-link nav-link-icon me-2" href="/" target="_blank">
                                    <i class="fa fa-table me-1"></i>
                                    <p class="d-inline text-sm z-index-1" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                       title="List fuel price by state and category in table">Table View</p>
                                </a>
                            </li>
                            <li class="nav-item dropdown dropdown-hover mx-2">
                                <a class="nav-link ps-2 d-flex cursor-pointer align-items-center" id="dropdownMenuPages" data-bs-toggle="dropdown"
                                   aria-expanded="false">
                                    <i class="fa fa-gas-pump me-1"></i>Fuel Type
                                    <img src="/img/CTmaterial/down-arrow-dark.svg" alt="down-arrow" class="arrow ms-auto ms-md-2">
                                </a>
                                <div class="dropdown-menu dropdown-menu-animation ms-n3 dropdown-md p-3 border-radius-xl mt-0 mt-lg-3"
                                     aria-labelledby="dropdownMenuPages">
                                    <div class="d-none d-lg-block">
                                        <h6 class="dropdown-header text-dark font-weight-bolder d-flex align-items-center px-1">Default</h6>
                                        <a href="/mapv2" class="dropdown-item border-radius-md"><span>Show All</span></a>
                                        <h6 class="dropdown-header text-dark font-weight-bolder d-flex align-items-center px-1">Unleaded Petrol</h6>
                                        <a href="/mapv2?fuel=U91" class="dropdown-item border-radius-md"><span>Unleaded 91</span></a>
                                        <a href="/mapv2?fuel=LAF" class="dropdown-item border-radius-md">
                                            <span>Unleaded Opal 91 (NT, QLD Only)</span>
                                        </a>
                                        <a href="/mapv2?fuel=P95" class="dropdown-item border-radius-md"><span>Premium Unleaded 95</span></a>
                                        <a href="/mapv2?fuel=P98" class="dropdown-item border-radius-md"><span>Premium Unleaded 98</span></a>
                                        <h6 class="dropdown-header text-dark font-weight-bolder d-flex align-items-center px-1">
                                            Ethanol Blended Petrol
                                        </h6>
                                        <a href="/mapv2?fuel=E10" class="dropdown-item border-radius-md"><span>Unleaded 94 (E10)</span></a>
                                        <a href="/mapv2?fuel=E85" class="dropdown-item border-radius-md"><span>Flex Fuel (E85)</span></a>

                                        <h6 class="dropdown-header text-dark font-weight-bolder d-flex align-items-center px-1">Diesels</h6>
                                        <a href="/mapv2?fuel=DL" class="dropdown-item border-radius-md"><span>Diesel</span></a>
                                        <a href="/mapv2?fuel=PDL" class="dropdown-item border-radius-md"><span>Premium Diesel</span></a>
                                        <a href="/mapv2?fuel=B20" class="dropdown-item border-radius-md"><span>Bio-Diesel B20 (NSW Only)</span></a>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item ms-lg-auto">
                                <a class="nav-link nav-link-icon me-1" href="/mapv2?fuel=EV">
                                    <i class="fa fa-charging-station me-1"></i>
                                    <p class="d-inline text-sm z-index-1" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                       title="Show Electric Vehicle Charging station (NSW Only)">EV</p>
                                </a>
                            </li>
                            <li class="nav-item ms-lg-auto">
                                <a class="nav-link nav-link-icon me-1" href="/mapv2?fuel=LPG">
                                    <i class="fa fa-fire-flame-simple me-1"></i>
                                    <p class="d-inline text-sm z-index-1" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                       title="Show Available LPG stations (Limited)">LPG</p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- End Navbar -->
        </div>
    </div>
</div>

<header class="header-2">
    <div class="page-header min-vh-90 relative" id="mapv2"></div>
</header>

<footer class="footer">
    <div class="footer max-height-vh-10 related">
        <p id="ftline1" style="font-size: 0.65rem;margin: 0">Loading Station data</p>
        <p id="ftline2" style="font-size: 0.65rem;margin: 0">Loading Address info</p>
        <p style="font-size: 0.4rem;margin: 0">Data updated on: <?= date_format($latestinfo[0]['lastfetchtime'],'d-M-Y H:i')?></p>
        <p id="maprange" style="display: none"></p>
        <p class="text-dark text-sm font-weight-normal" style="font-size: 0.3rem;margin: 0">
            All rights reserved. Copyright ©
            <script>document.write(new Date().getFullYear())</script>
            Material Kit by <a href="https://www.creative-tim.com" target="_blank">Creative Tim</a>.
        </p>
    </div>
</footer>


<!--   Core JS Files   -->
<script src="/js/CTmaterial/core/popper.min.js" type="text/javascript"></script>
<script src="/js/CTmaterial/core/bootstrap.min.js" type="text/javascript"></script>
<script src="/js/CTmaterial/plugins/perfect-scrollbar.min.js"></script>

<!--  Plugin for TypedJS, full documentation here: https://github.com/inorganik/CountUp.js -->
<script src="/js/CTmaterial/plugins/countup.min.js"></script>


<script src="/js/CTmaterial/plugins/choices.min.js"></script>


<script src="/js/CTmaterial/plugins/prism.min.js"></script>
<script src="/js/CTmaterial/plugins/highlight.min.js"></script>


<!--  Plugin for Parallax, full documentation here: https://github.com/dixonandmoe/rellax -->
<script src="/js/CTmaterial/plugins/rellax.min.js"></script>
<!--  Plugin for TiltJS, full documentation here: https://gijsroge.github.io/tilt.js/ -->
<script src="/js/CTmaterial/plugins/tilt.min.js"></script>
<!--  Plugin for Selectpicker - ChoicesJS, full documentation here: https://github.com/jshjohnson/Choices -->
<script src="/js/CTmaterial/plugins/choices.min.js"></script>


<!-- Control Center for Material UI Kit: parallax effects, scripts for the example pages etc -->
<!--  Google Maps Plugin    -->

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDTTfWur0PDbZWPr7Pmq8K3jiDp0_xUziI"></script>
<script src="/js/CTmaterial/material-kit.min.js?v=3.0.4" type="text/javascript"></script>


<script type="text/javascript">

    if (document.getElementById('state1')) {
        const countUp = new CountUp('state1', document.getElementById("state1").getAttribute("countTo"));
        if (!countUp.error) {
            countUp.start();
        } else {
            console.error(countUp.error);
        }
    }
    if (document.getElementById('state2')) {
        const countUp1 = new CountUp('state2', document.getElementById("state2").getAttribute("countTo"));
        if (!countUp1.error) {
            countUp1.start();
        } else {
            console.error(countUp1.error);
        }
    }
    if (document.getElementById('state3')) {
        const countUp2 = new CountUp('state3', document.getElementById("state3").getAttribute("countTo"));
        if (!countUp2.error) {
            countUp2.start();
        } else {
            console.error(countUp2.error);
        }
        ;
    }
</script>

<script>
    const intype = <?= $intype;?>;
    let iconurl = window.location.origin+'/img/fuel/'
    let priceinfo = <?= json_encode($priceinfo);?>;
    let fueltype = window.location.pathname.replace("/mapv2/","");
    let config = {
        minZoom: 5.5,
        maxZoom: 16
    }
    const map = L.map('mapv2',config).setView([-28, 133], 6);
    map.attributionControl.setPrefix("Leaflet")
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 16,
        minZoom: 5.5,
        attribution: '0xJoy © OpenStreetMap'
    }).addTo(map);
    map.locate({setView: true, maxZoom: 16});

    let markers = L.markerClusterGroup();
    const fueltypearr = ['B20','DL','E10','E85','EV','LAF','LPG','P95','P98','PDL','U91']
    let customPopup = ``
    priceinfo.forEach(currentStation =>{
        var stationAddress = currentStation['address']+(currentStation['suburb'] !== ''? `, ${currentStation['suburb']}`:'')+
            (currentStation['state'] !== ''? `, ${currentStation['state']}`:'')+(currentStation['postcode'] !== ''? `, ${currentStation['postcode']}`:'')
        var googleMapLink = `https://www.google.com/maps/dir/?api=1&destination=${currentStation.loc_lat}%2C${currentStation.loc_lng}`
        var wazeLink = `https://www.waze.com/ul?q=${currentStation['name']}&ll=${currentStation.loc_lat}%2C${currentStation.loc_lng}&navigate=yes&zoom=15`
        customPopup = `<div style="min-width:350px"><h6>${currentStation['name']}</h6><hr><p>Address: ${stationAddress}</p>`
        customPopup += `Navigate with:<span><a href=${googleMapLink} style="padding: 10px">Google Map</a><a href=${wazeLink} style="padding: 10px">Waze</a></span>`
        fueltypearr.forEach(fuelType => {
            if (currentStation[fuelType] !== null){
                if(fuelType.includes("LPG") || fuelType.includes("EV")){
                    customPopup += `<p>${fuelType}: ${currentStation[fuelType].toFixed(1)}</p>`;
                } else if(fuelType.includes("LAF")){
                    customPopup += `<p>Low aromatic fuel: ${currentStation[fuelType].toFixed(1)}</p>`;
                }else if(fuelType.includes("B20")){
                    customPopup += `<p>BioDiesel: ${currentStation[fuelType].toFixed(1)}</p>`;
                }else {
                    customPopup += `<p>${fuelType.replace("P","Premium ").replace("U","Unleaded ").replace("E","Ethanol ").replace("DL","Diesel")}: `+
                        `${currentStation[fuelType].toFixed(1)}</p>`
                }
            }
        })
        customPopup += '</div>'

        const customOptions = {maxWidth: "550", className: "customPopup",};

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
            console.log(fueltype)
            marker.bindTooltip((currentStation[getQueryStringValue('fuel')] !== undefined ? `${currentStation[getQueryStringValue('fuel')].toFixed(1)}` : `${currentStation[getQueryStringValue('fuel')]}` ), {
                direction: 'top',
                permanent: true,
                offset: L.point({x: 0, y: -12})
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
                    document.getElementById('ftline1').innerHTML = `Cheapest ${getQueryStringValue('fuel')}: ${currentStation[getQueryStringValue('fuel')]} @ <a target="_blank" href="https://www.google.com/maps/dir/?api=1&destination=${currentStation['loc_lat']}%2C${currentStation['loc_lng']}&travelmode=driving">${currentStation['name']}</a>`
                    document.getElementById('ftline2').innerText = `Address: ${currentStation['address']}, ${currentStation['suburb']}, ${currentStation['state']} ${currentStation['postcode']}`
                } else if (cheapeststation[getQueryStringValue('fuel')] > currentStation[getQueryStringValue('fuel')]) {
                    cheapeststation = currentStation
                    document.getElementById('ftline1').innerHTML = `Cheapest ${getQueryStringValue('fuel')}: ${currentStation[getQueryStringValue('fuel')]} @ <a target="_blank" href="https://www.google.com/maps/dir/?api=1&destination=${currentStation['loc_lat']}%2C${currentStation['loc_lng']}&travelmode=driving">${currentStation['name']}</a>`
                    document.getElementById('ftline2').innerText = `Address: ${currentStation['address']}, ${currentStation['suburb']}, ${currentStation['state']} ${currentStation['postcode']}`
                }
        });
    }

    function getQueryStringValue (key) {
        return decodeURIComponent(window.location.search.replace(new RegExp("^(?:.*[&\\?]" + encodeURIComponent(key).replace(/[\.\+\*]/g, "\\$&") + "(?:\\=([^&]*))?)?.*$", "i"), "$1"))
    }
</script>
</body>
</html>

