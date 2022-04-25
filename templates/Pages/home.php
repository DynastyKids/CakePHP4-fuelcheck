<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        DynastyFuel Access
    </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <?= $this->Html->meta('icon') ?>
</head>

<body>
<h1>Aus Fuel Pump Price Cluster API - Version 1</h1>
<br>
The fuel pump price API provides direct access to pump data for all over australia exclude VIC and ACT area.
<br>
The API returns updated data for most stations for all fuel types. By using this document you are agreed to comply with the license and terms of service
<br>
All data are updated regularly, while some data may update daily, taking into account and any planned price changes (E.g. due to holiday or server disruptions). To access the most up to day data, you must using the API dynamically.
<br>
You can access the API through HTTP requests, as follows
<br>
<input class="form-control" type="text" value="base URL/ API name / Query String" aria-label="readonly input example" readonly>
<br><br>
The base URL is either https://fuel.danisty8.com/ or http://fuel.danisty8.com/

<footer>
    Page was accessed on <?= date('Y-m-d H:i:s')?>
</footer>

</body>
</html>
