<?php
//Plain table on this page for fetch
$this->layout = 'blank';
$statenames = ['QLD', 'NSW', 'VIC', 'ACT', 'TAS', 'SA', 'NT', 'WA'];
?>
<?php
foreach ($allresults as $statename => $eachstate) {
    if (in_array($statename, $statenames)) {
        ?>
        <h4><?= $statename ?></h4>
        <?php foreach ($eachstate as $fueltype => $eachFuel) { ?>
            <?php if(sizeof($eachFuel) > 0){?>
                <table class="table table-sm">
                    <thead><tr>
                        <th scope="col" colspan="1"><?= $fueltype ?></th>
                        <th scope="col" colspan="3">Station Name</th>
                        <th scope="col" colspan="1">Price</th>
                        <th scope="col" colspan="1">Navigation</th>
                    </tr></thead>
                    <tbody>
                    <?php foreach ($eachFuel as $key => $eachstation) { ?>
                        <tr>
                            <td colspan="1"><?= $key+1 ?></td>
                            <td colspan="3"><?= $eachstation['name'] ?></td>
                            <td colspan="1"><?= $eachstation[$fueltype] ?></td>
                            <td colspan="1"><?= $eachstation['lat'] ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            <?php }?>
        <?php } ?>
        <hr>
    <?php } ?>
<?php } ?>
</div>
