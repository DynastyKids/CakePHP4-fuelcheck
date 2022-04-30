<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DynastyFuel Access</title>
    <?= $this->Html->meta('icon') ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/core.min.js" integrity="sha512-t8vdA86yKUE154D1VlNn78JbDkjv3HxdK/0MJDMBUXUjshuzRgET0ERp/0MAgYS+8YD9YmFwnz6+FWLz1gRZaw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/hmac.min.js" integrity="sha512-tLNkZ/sTmmvq8RDIGCLU3ZzUYSixlGQxpL0X1LWFnTBdvw0SGurLkjAIh0CtG0oQ/1Yt6MaDiI8Gif05JZqEyQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/sha1.min.js" integrity="sha512-NHw1e1pc4RtmcynK88fHt8lpuetTUC0frnLBH6OrjmKGNnwY4nAnNBMjez4DRr9G1b+NtufOXLsF+apmkRCEIw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/hmac-sha1.min.js" integrity="sha512-OahNHQh8EnqAptVvXgLLIT3LOv+irJSkED9oyUvGvh1MULTHriuXGIk8RHFfRffj5ejGREfE9IRWoBCPSZ5XGw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>
<h1>Aus Fuel Pump Price Cluster API - Version 1</h1>
<hr>
<!--<p>Current Cheapest 5 station across each state</p>-->
<!--<small>* Currently ACT and VIC only having limited stations data</small>-->


<hr>
<h2>API Accessing information - Version 1</h2>
<p>The fuel pump price API provides direct access to pump data for all over australia exclude VIC and ACT area.</p>
<p>The API returns updated data for most stations for all fuel types. By using this document you are agreed to comply
    with the license and terms of service</p>
<p>All data are updated regularly, while some data may update daily, taking into account and any planned price changes
    (E.g. due to holiday or server disruptions). To access the most up to day data, you must using the API dynamically.</p>
<p>You can access the API through HTTP requests, the simulator has build as follows</p>

<br><br>
The base URL is <p id="baseurl"></p>
<input id="devid" type="text" placeholder="Input your developer id"/>
<br><br>
<input id="devkey" type="text" placeholder="Input your developer key"/>
<button id="generate" onclick="myFunction()">Generate link</button>
<hr>
<h5>Request Fuel Price:</h5>
<p id="fuellink"></p>
<br>
<h5>Request Cheapest Stations API:</h5>
<p id="cheaplink"></p>
<br>
<h5>Request Cheapest Stations plain Table:</h5>
<p id="cheaptablelink"></p>
<br>
<hr>

<footer>
    Page was accessed on <?= date('Y-m-d H:i:s')?>
</footer>
</body>
<script>
    function myFunction() {
        var devid = document.getElementById("devid").value;
        var devkey = document.getElementById("devkey").value;
        var fuellink = window.location.href+"data?user="+devid
        var cheaplink = window.location.href+"cheapinfo?user="+devid
        var cheaptable = window.location.href+"cheaptable?user="+devid
        const d2 = new Date();
        var date=String(d2.getUTCFullYear())
        if(d2.getUTCMonth()<9){
            date= date+"0"+String(d2.getUTCMonth()+1)
        }else{
            date= date+String(d2.getUTCMonth()+1)
        }
        if(d2.getUTCDate()<10){
            date= date+"0"+String(d2.getUTCDate())
        }else{
            date= date+String(d2.getUTCDate())
        }
        var requestkey =  CryptoJS.HmacSHA1(fuellink,date+devkey).toString()
        fuellink = fuellink+"&key="+requestkey
        requestkey = CryptoJS.HmacSHA1(cheaplink,date+devkey).toString()
        cheaplink = cheaplink+"&key="+requestkey
        requestkey = CryptoJS.HmacSHA1(cheaptable,date+devkey).toString()
        cheaptable = cheaptable+"&key="+requestkey
        document.getElementById("baseurl").innerHTML=window.location.href
        document.getElementById("fuellink").innerHTML=fuellink
        document.getElementById("cheaplink").innerHTML=cheaplink
        document.getElementById("cheaptablelink").innerHTML=cheaptable
    }
</script>
</html>

