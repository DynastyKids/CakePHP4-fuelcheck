<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home</title>
    <?= $this->Html->meta('icon') ?>
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
</head>

<div class="container">
    <h1>DynastyFuel Pump looker - Cheapest stations</h1>
    <hr>
    <p>Table below is showing current cheapest station for each state</p>
    <div class="row">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <?php foreach ($allresults as $statename => $eachstate) { ?>
                    <?php if ($statename == "ACT") { ?>
                        <button class="nav-link active" id="nav-<?= $statename ?>-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-<?= $statename ?>" type="button" role="tab"
                                aria-controls="nav-<?= $statename ?>" aria-selected="true"><?= $statename ?></button>
                    <?php } else if (in_array($statename, $statenames)) { ?>
                        <button class="nav-link" id="nav-<?= $statename ?>-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-<?= $statename ?>" type="button" role="tab"
                                aria-controls="nav-<?= $statename ?>" aria-selected="false"><?= $statename ?></button>
                    <?php } ?>
                <?php } ?>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <?php foreach ($allresults as $statename => $eachstate) { ?>
            <?php if (in_array($statename, $statenames)) { ?>
            <?php if ($statename == 'ACT'){ ?>
            <div class="tab-pane fade show active" id="nav-<?= $statename ?>" role="tabpanel"
                 aria-labelledby="nav-<?= $statename ?>-tab">
                <?php } else{ ?>
                <div class="tab-pane fade" id="nav-<?= $statename ?>" role="tabpanel"
                     aria-labelledby="nav-<?= $statename ?>-tab">
                    <?php } ?>
                    <div class="d-flex align-items-start">
                        <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist"
                             aria-orientation="vertical">
                            <?php foreach ($eachstate as $fueltype => $eachFuel) { ?>
                                <?php if ($fueltype == 'U91') { ?>
                                    <button class="nav-link active" id="v-pills-<?= $fueltype . $statename ?>-tab"
                                            data-bs-toggle="pill"
                                            data-bs-target="#v-pills-<?= $fueltype . $statename ?>" type="button"
                                            role="tab" aria-controls="v-pills-home" aria-selected="true">Unleaded 91
                                    </button>
                                <?php } else { ?>
                                    <?php if (sizeof($eachFuel) > 0) { ?>
                                        <button class="nav-link" id="v-pills-<?= $fueltype . $statename ?>-tab"
                                                data-bs-toggle="pill"
                                                data-bs-target="#v-<?= $fueltype . $statename ?>-profile" type="button"
                                                role="tab" aria-controls="v-pills-profile" aria-selected="false">
                                            <?php if ($fueltype == 'P95' || $fueltype == 'P98') {
                                                echo "Premium Unleaded " . substr($fueltype, 1);
                                            } else if ($fueltype == 'E10') {
                                                echo "Unleaded 94 / E10";
                                            } else if ($fueltype == 'DL') {
                                                echo "Diesel";
                                            } else if ($fueltype == 'PDL') {
                                                echo "Premium Diesel";
                                            } else if ($fueltype == 'LAF') {
                                                echo "Low Aromatic 91";
                                            } else {
                                                echo $fueltype;
                                            }
                                            ?>
                                        </button>
                                    <?php }
                                } ?>
                            <?php } ?>
                        </div>
                        <div class="tab-content" id="v-pills-tabContent">
                            <?php foreach ($eachstate as $fueltype => $eachFuel) { ?>
                            <?php if ($fueltype == 'U91'){ ?>
                            <div class="tab-pane fade show active" id="v-pills-<?= $fueltype . $statename ?>"
                                 role="tabpanel" aria-labelledby="v-pills-<?= $fueltype . $statename ?>-tab">
                                <?php } else { ?>
                                <div class="tab-pane fade" id="v-<?= $fueltype . $statename ?>-profile" role="tabpanel"
                                     aria-labelledby="v-pills-<?= $fueltype . $statename ?>-tab">
                                    <?php } ?>
                                    <table class="table table-hover table-sm">
                                        <thead>
                                        <tr>
                                            <th scope="col" colspan="1">No.</th>
                                            <th scope="col" colspan="2">Station Name</th>
                                            <th scope="col" colspan="1">Price</th>
                                            <th scope="col" colspan="5">Address</th>
                                        </tr>
                                        </thead>
                                        <?php if (sizeof($eachFuel) > 0) { ?>
                                            <tbody>
                                            <?php foreach ($eachFuel as $key => $eachstation) { ?>
                                                <tr>
                                                    <td colspan="1"><?= $key + 1 ?></td>
                                                    <td colspan="2"><?= $eachstation['name'] ?></td>
                                                    <td colspan="1"><?= $eachstation[$fueltype] ?></td>
                                                    <td colspan="5">
                                                        <a href="https://www.google.com/maps/search/?api=1&query=<?= $eachstation['loc_lat'] ?>%2C<?= $eachstation['loc_lng'] ?>">
                                                            <?= $eachstation['address'] . ',' . $eachstation['suburb'] . ',' . $eachstation['state'] . ' ' . $eachstation['postcode']; ?></a></td>
                                                </tr>
                                            <?php } ?>
                                            </tbody>
                                        <?php } ?>
                                    </table>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    <?php } ?>
                </div>
            </div>
            <small>Some of data are provided by Data.NSW, NT Fuel check, WA Fuelwatch etc.</small>
            <br>
            <small>Disclaimer: The information provided by DynastyFuel ('we', 'us' or 'our') on this website is for
                general information purposes. All information are provided in good faith but not representation in
                any kind, express or implied, regarding the accuracy, adequacy, validity, reliability, availability
                or completeness of any information holding on this Site.
            </small>
            <hr>
            <small>
                <a href='<?= $this->Url->build('/development') ?>'>Developer's Information</a>
            </small>
            <footer>
                Page was accessed on <?= date('Y-m-d H:i:s') ?>
            </footer>
        </div>
    </div>
</div>
