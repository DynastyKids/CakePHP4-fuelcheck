<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Developer Access</title>
    <?= $this->Html->meta('icon') ?>
</head>

<body>
<h1>DynastyFuel Pump price lookup - Version 1</h1>
<br><br>
<h3>Developer Info Page</h3>
<hr>
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
<hr>

<footer>
    Page was accessed on <?= date('Y-m-d H:i:s')?>
</footer>
</body>
<script>document.getElementById("baseurl").innerHTML=window.location.origin</script>
<script>
    function myFunction() {
        var devid = document.getElementById("devid").value;
        var devkey = document.getElementById("devkey").value;
        var fuellink = window.location.origin+"/data?user="+devid
        var cheaplink = window.location.origin+"/cheapinfo?user="+devid
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
        document.getElementById("baseurl").innerHTML=window.location.origin
        document.getElementById("fuellink").innerHTML=fuellink
        document.getElementById("cheaplink").innerHTML=cheaplink
    }
</script>
</html>

