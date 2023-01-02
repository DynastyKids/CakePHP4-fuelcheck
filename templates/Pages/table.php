<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Table view</title>
    <?= $this->Html->meta('icon') ?>
</head>

<div class="container">
    <p>Data updated on: <?= date_format($latestinfo[0]['lastfetchtime'],'d-M-Y H:i')?></p>
    <script type="text/javascript" src="https://cdnjs.buymeacoffee.com/1.0.0/button.prod.min.js" data-name="bmc-button" data-slug="DynastyKids" data-color="#FFDD00" data-emoji="⛽"  data-font="Cookie" data-text="Buy me a coffee" data-outline-color="#000000" data-font-color="#000000" data-coffee-color="#ffffff" ></script>
    <div class="row">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <?php foreach ($allresults as $statename => $eachstate) {
                    if (in_array($statename, $statenames)) {
                        ?>
                        <button class="nav-link <?= ($statename == "NATIONWIDE") ? "active" : "" ?>"
                                id="nav-<?= $statename ?>-tab" data-bs-toggle="tab" type="button" role="tab"
                                data-bs-target="#nav-<?= $statename ?>" aria-controls="nav-<?= $statename ?>"
                                aria-selected="<?= ($statename == "NATIONWIDE") ? "true" : "false" ?>"><?= $statename ?></button>
                    <?php } ?>
                <?php } ?>
            </div>
        </nav>
        <div class="tab-content container-fluid" id="nav-tabContent">
            <?php foreach ($allresults as $statename => $eachstate) {
                if (in_array($statename, $statenames)) { ?>
                    <div class="tab-pane fade show <?= ($statename == 'NATIONWIDE') ? "active" : "" ?>"
                         id="nav-<?= $statename ?>" role="tabpanel" aria-labelledby="nav-<?= $statename ?>-tab" style="border: solid #cfcfcf 0.5px">
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <?php foreach ($eachstate as $fueltype => $eachFuel) { ?>
                                    <a class="nav-item nav-link <?= (($fueltype == 'U91') ? "active" : "") ?>" id="nav-<?= $fueltype . $statename ?>-tab"
                                       data-bs-toggle="tab" href="#nav-<?= $fueltype . $statename ?>" role="tab"
                                       aria-controls="nav-<?= $fueltype . $statename ?>" aria-selected="<?= (($fueltype == 'U91') ? "true" : "false") ?>">
                                        <?= $fueltype ?>
                                    </a>
                                <?php } ?>
                            </div>
                        </nav>
                        <div class="tab-content container" id="nav-tabContent">
                            <?php foreach ($eachstate as $fueltype => $eachFuel) { ?>
                                <div class="tab-pane fade <?= ($fueltype == 'U91') ? "show active" : "" ?>"
                                     id="nav-<?= $fueltype . $statename ?>" role="tabpanel"
                                     aria-labelledby="nav-<?= $fueltype . $statename ?>-tab">
                                    <table class="table table-hover table-sm">
                                        <thead>
                                        <tr>
                                            <th scope="col" colspan="1">No.</th>
                                            <th scope="col" colspan="2">Station</th>
                                            <th scope="col" colspan="1">Price</th>
                                            <th scope="col" colspan="5">Address</th>
                                        </tr>
                                        </thead>
                                        <?php if (sizeof($eachFuel) > 0) { ?>
                                            <tbody>
                                            <?php foreach ($eachFuel as $key => $eachstation) { ?>
                                                <tr>
                                                    <td colspan="1" style="font-size: 0.7rem"><?= $key + 1 ?></td>
                                                    <td colspan="2" style="font-size: 0.7rem"><?= $eachstation['name'] ?></td>
                                                    <td colspan="1" style="font-size: 0.7rem"><?= $eachstation[$fueltype] ?></td>
                                                    <td colspan="5" style="font-size: 0.5rem">
                                                        <a href="https://www.google.com/maps/search/?api=1&query=<?= $eachstation['loc_lat'] ?>%2C<?= $eachstation['loc_lng'] ?>">
                                                            <?= $eachstation['address'] . ',' . $eachstation['suburb'] . ',' . $eachstation['state'] . ' ' . $eachstation['postcode']; ?></a>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                            </tbody>
                                        <?php } ?>
                                    </table>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
            <?php } ?>
        </div>
    </div>
    <small>Some of data are provided by Data.NSW, NT Fuel check, WA Fuelwatch etc.</small>
    <br>
    <small>Disclaimer: The information provided by us on this website is for general information purposes.
        All information are provided in good faith but not representation in any kind, express or implied,
        regarding the accuracy, adequacy, validity, reliability, availability or completeness of any information holding on this Site.

        * Price info are updated every 4 hours.
    </small>
    <hr>
<!--    <small><a href='--><?php //echo $this->Url->build('/development') ?><!--'>Developer's Information</a></small>-->
</div>
</div>
</div>
