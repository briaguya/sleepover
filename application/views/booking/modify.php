<div class="account-container" style="margin: 0 auto;">

    <div class="content clearfix">

        <form action="/sleepover/booking/save/<?=$booking_id?>" method="post">

            <h1>
                <? if($booking_id == null) {?>
                    <?="Add Booking";?>
                <?} else {?>
                    <?="Edit Booking";}?>
            </h1>

            <div class="field">
                <label for="pod">Pod:</label>
                <select id="pod" name="pod">
                    <? foreach ($pods as $pod) { ?>
                        <option value="<?=$pod->pod_id?>"
                            <? if($booking_id != null) { if($pod->pod_id==$booking->location_id) { echo "selected";}}?>><?=$pod->comboname?></option>
                    <? } ?>
                </select>
            </div>

            <? if($booking_id == null) {?>
                <?= "<div class=\"field\">" ?>
                <?= "<label for=\"podestrian\">Podestrian:</label>" ?>
                <?= "<select id=\"podestrian_id\" name=\"podestrian_id\">" ?>
                <? foreach ($podestrians as $podestrian) { ?>
                    <?= "<option value=" ?>
                    <?=$podestrian->podestrian_id?><?="\">"?>
                    <?=$podestrian->first_name?><?= " " ?><?=$podestrian->last_name?>
                    <?= "</option>" ;}?>
            <?= "</select>" ?>
            <?= "</div>" ;}?>

            <div class="login-actions">
                <button class="button btn btn-success btn-large">
                    <? if($booking_id == null) {?>
                        <?="Add";?>
                    <?} else {?>
                        <?="Save";}?>
                </button>
            </div>

        </form>

    </div> <!-- /content -->

</div> <!-- /account-container -->