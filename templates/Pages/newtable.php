<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Table view</title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->script("https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js") ?>
    <?= $this->Html->css("https://cdn.jsdelivr.net/npm/datatables@1.10.18/media/css/jquery.dataTables.min.css") ?>
    <?= $this->Html->script("https://cdn.jsdelivr.net/npm/datatables@1.10.18/media/js/jquery.dataTables.min.js") ?>
</head>

<div class="container">
    <div class="row">
        <div class="row">
            <nav>
                <div>State: </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input stateCheckbox" name="stateCheckbox" type="radio" id="stateCheckboxACT" value="ACT">
                    <label class="form-check-label" for="stateCheckboxACT">ACT</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input stateCheckbox" name="stateCheckbox" type="radio" id="stateCheckboxNSW" value="NSW" checked>
                    <label class="form-check-label" for="stateCheckboxNSW">NSW</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input stateCheckbox" name="stateCheckbox" type="radio" id="stateCheckboxNT" value="NT">
                    <label class="form-check-label" for="stateCheckboxNT">NT</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input stateCheckbox" name="stateCheckbox" type="radio" id="stateCheckboxQLD" value="QLD">
                    <label class="form-check-label" for="stateCheckboxQLD">QLD</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input stateCheckbox" name="stateCheckbox" type="radio" id="stateCheckboxSA" value="SA">
                    <label class="form-check-label" for="stateCheckboxSA">SA</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input stateCheckbox" name="stateCheckbox" type="radio" id="stateCheckboxTAS" value="TAS">
                    <label class="form-check-label" for="stateCheckboxTAS">TAS</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input stateCheckbox" name="stateCheckbox" type="radio" id="stateCheckboxVIC" value="VIC">
                    <label class="form-check-label" for="stateCheckboxVIC">VIC</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input stateCheckbox" name="stateCheckbox" type="radio" id="stateCheckboxWA" value="WA">
                    <label class="form-check-label" for="stateCheckboxWA">WA</label>
                </div>
            </nav>
            <hr>
            <nav>
            <div>Fuel Types:</div>
            <div class="form-check form-check-inline">
                <input class="form-check-input fuelTypeCheck" name="fuelTypeCheck" type="radio" id="inlineCheckbox1" value="U91" checked>
                <label class="form-check-label" for="inlineCheckbox1">Unleaded 91</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input fuelTypeCheck" name="fuelTypeCheck" type="radio" id="inlineCheckbox1" value="E10">
                <label class="form-check-label" for="inlineCheckbox1">Unleaded 94 (E10)</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input fuelTypeCheck" name="fuelTypeCheck" type="radio" id="inlineCheckbox2" value="P95">
                <label class="form-check-label" for="inlineCheckbox2">Premium Unleaded 95</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input fuelTypeCheck" name="fuelTypeCheck" type="radio" id="inlineCheckbox3" value="P98">
                <label class="form-check-label" for="inlineCheckbox3">Premium Unleaded 98</label>
            </div>

            <div class="form-check form-check-inline">
                <input class="form-check-input fuelTypeCheck" name="fuelTypeCheck" type="radio" id="inlineCheckbox3" value="DL">
                <label class="form-check-label" for="inlineCheckbox3">Diesel</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input fuelTypeCheck" name="fuelTypeCheck" type="radio" id="inlineCheckbox3" value="PDL">
                <label class="form-check-label" for="inlineCheckbox3">Premium Diesel</label>
            </div>

            <div class="form-check form-check-inline">
                <input class="form-check-input fuelTypeCheck" name="fuelTypeCheck" type="radio" id="inlineCheckbox3" value="LPG">
                <label class="form-check-label" for="inlineCheckbox3">LPG</label>
            </div>
            </nav>
        </div>
        <hr>
        <div class="tab-content container-fluid">
        <table class="table table-hove" id="dataTable">
            <thead>
            <tr>
                <th>Station</th>
                <th>Price</th>
                <th>Address</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Loading Stations</td>
                <td></td>
                <td></td>
            </tr>
            </tbody>
        </table>
        </div>
    </div>
    <div style="font-size: xx-small">
        <div>
            <table>
                <tr><td colspan="2">Data Updated</td></tr>
                <?php foreach ($latestinfo as $result){?>
                    <tr><td><?= $result['state'] ?></td><td><?= date_format($result['lastfetchtime'], 'd-M-Y H:i') ?></td></tr>
                <?php } ?>
            </table>
        </div>
        <div>Disclaimer: The information provided by us on this website is for general information purposes.
            All information are provided in good faith but not representation in any kind, express or implied,
            regarding the accuracy, adequacy, validity, reliability, availability or completeness of any information holding on this Site.
        </div>
    </div>
    <hr>
    <!--    <small><a href='-->
    <?php //echo $this->Url->build('/development') ?><!--'>Developer's Information</a></small>-->

    <script type="text/javascript" src="https://cdnjs.buymeacoffee.com/1.0.0/button.prod.min.js" data-name="bmc-button"
            data-slug="DynastyKids" data-color="#FFDD00" data-emoji="⛽" data-font="Cookie" data-text="Buy me a coffee"
            data-outline-color="#000000" data-font-color="#000000" data-coffee-color="#ffffff"></script>
</div>
</div>
</div>
<script>
    let datatable = $('#dataTable').DataTable();
    datatable.order([1,'asc'])
    let priceData = []
    document.addEventListener("DOMContentLoaded", function(){
        ajaxGet('/getdata')
            .then(data => {
                priceData = data
                updateDataTables()
            })
            .catch(error => {
                console.error('Error:', error.statusText);
            });
        adjustTableTextSize()
    })
    window.addEventListener('resize', adjustTableTextSize);

    document.querySelectorAll(".stateCheckbox").forEach(eachRadioButton=>{
        eachRadioButton.addEventListener("change",function(){
            if (this.checked){
                updateDataTables()
            }
        })
    })

    document.querySelectorAll(".fuelTypeCheck").forEach(eachRadioButton=>{
        eachRadioButton.addEventListener("change",function(){
            if (this.checked){
                updateDataTables()
            }
        })
    })

    function updateDataTables(){
        var targetData = []
        datatable.clear();
        document.querySelectorAll(".stateCheckbox").forEach(eachState=>{
            if (eachState.checked){
                document.querySelectorAll(".fuelTypeCheck").forEach(eachFuelType=>{
                    if (eachFuelType.checked){
                        for (const eachData of priceData) {
                            if (eachData['state']===eachState.value && eachData[eachFuelType.value] != null){
                                targetData.push([eachData['name'],eachData[eachFuelType.value], `<a href=https://www.google.com/maps/search/?api=1&query=${eachData['loc_lat']}%2C${eachData['loc_lng']}>${eachData["address"]}, ${eachData['suburb'] ? eachData['suburb'] : ""} ${eachData['state'] ? eachData['state'] : ""} ${eachData['postcode'] ? eachData['postcode'] : ""}</a>`])
                            }
                        }
                    }
                })
            }
        })
        datatable.clear();
        datatable.rows.add(targetData);
        datatable.draw();
    }

    function ajaxGet(url) {
        return fetch(url)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok ' + response.statusText);
                }
                return response.json();
            });
    }

    function adjustTableTextSize(){
        const table = document.querySelector('#dataTable');
        if (window.innerWidth < 576) {
            table.setAttribute("style","font-size:small");
        } else {
            table.removeAttribute("style")
        }
    }
</script>
