<?php
//Plain table on this page for fetch
$this->layout = 'blank';
$statenames = ['QLD', 'VIC', 'ACT', 'TAS', 'SA', 'NT', 'WA'];
?>

<nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <button class="nav-link active" id="nav-NSW-tab" data-bs-toggle="tab" data-bs-target="#nav-NSW" type="button" role="tab" aria-controls="nav-NSW" aria-selected="true">NSW</button>
        <?php foreach ($allresults as $statename => $eachstate) { ?>
            <?php if (in_array($statename, $statenames)) { ?>
                <button class="nav-link" id="nav-<?= $statename?>-tab" data-bs-toggle="tab" data-bs-target="#nav-<?= $statename?>" type="button" role="tab" aria-controls="nav-<?= $statename?>" aria-selected="false"><?= $statename?></button>
            <?php }?>
        <?php }?>
    </div>
</nav>
<div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade show active" id="nav-NSW" role="tabpanel" aria-labelledby="nav-NSW-tab">
        <table class="table table-hover table-sm">
            <thead><tr>
                <th scope="col" colspan="1">Fuel Type</th>
                <th scope="col" colspan="1">Sequence</th>
                <th scope="col" colspan="2">Station Name</th>
                <th scope="col" colspan="1">Price</th>
                <th scope="col" colspan="4">Address</th>
            </tr></thead>
        <?php foreach ($nswcluster as $fueltype => $eachFuel) { ?>
            <?php if(sizeof($eachFuel) > 0){?>
                    <tbody>
                    <?php foreach ($eachFuel as $key => $eachstation) { ?>
                        <tr>
                            <td colspan="1"><?php
                                if($fueltype=='DL'){echo "Diesel";}
                                else if($fueltype=='PDL'){echo "Premium Diesel";}
                                else if($fueltype=='U91'||$fueltype=='P95'||$fueltype=='P98'){
                                    echo "Unleaded ".substr($fueltype,1);
                                } else {
                                    echo $fueltype;
                                }
                                ?></td>
                            <td colspan="1"><?= $key+1 ?></td>
                            <td colspan="2"><?= $eachstation['name'] ?></td>
                            <td colspan="1"><?= $eachstation[$fueltype] ?></td>
                            <td colspan="4"><?php echo $eachstation['address']; ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>

            <?php }?>
        <?php } ?>
        </table>
    </div>

<!--    Rest of states-->
    <?php foreach ($allresults as $statename => $eachstate) { ?>
        <?php if (in_array($statename, $statenames)) { ?>
        <div class="tab-pane fade" id="nav-<?= $statename?>" role="tabpanel" aria-labelledby="nav-<?= $statename?>-tab">
            <table class="table table-hover table-sm">
                <thead><tr>
                    <th scope="col" colspan="1">Fuel Type</th>
                    <th scope="col" colspan="1">Sequence</th>
                    <th scope="col" colspan="2">Station Name</th>
                    <th scope="col" colspan="1">Price</th>
                    <th scope="col" colspan="4">Address</th>
                </tr></thead>
            <?php foreach ($eachstate as $fueltype => $eachFuel) { ?>
                <?php if(sizeof($eachFuel) > 0){?>
                        <tbody>
                        <?php foreach ($eachFuel as $key => $eachstation) { ?>
                            <tr>
                                <td colspan="1"><?php
                                    if($fueltype=='DL'){echo "Diesel";}
                                    else if($fueltype=='PDL'){echo "Premium Diesel";}
                                    else if($fueltype=='U91'||$fueltype=='P95'||$fueltype=='P98'){
                                        echo "Unleaded ".substr($fueltype,1);
                                    } else {
                                        echo $fueltype;
                                    }
                                    ?></td>
                                <td colspan="1"><?= $key+1 ?></td>
                                <td colspan="2"><?= $eachstation['name'] ?></td>
                                <td colspan="1"><?= $eachstation[$fueltype] ?></td>
                                <td colspan="4">
                                    <?php if ($statename =="TAS") { echo $eachstation['address']; }
                                    else { echo $eachstation['address'].','.$eachstation['suburb'].','.$statename.' '.$eachstation['postcode'];}
                                    ?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                <?php }?>
            <?php } ?>
            </table>
        </div>
        <?php } ?>
    <?php } ?>
</div>
