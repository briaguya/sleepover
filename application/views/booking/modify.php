<div class="account-container" style="margin: 0 auto;">

    <div class="content clearfix">

        <form action="/sleepover/booking/save/<?=$booking_id?>" method="post">

            <h1>
                <? if($booking_id == null) {?>
                    <?="Add Booking";?>
                <?} else {?>
                    <?="Edit Booking";}?>
            </h1>

            <? if($booking_id != null) {?>
                <?= "<img src=\"/sleepover/img/success-kid.png\">" ?>
                <?= "<h3>" ?>
                <?=$booking->podestrian_name?>
                <?= "</h3>" ;}?>

            <? if($booking_id == null) {?>
                <?= "<div class=\"field\">" ?>
                <?= "<label for=\"podestrian\">Podestrian:</label>" ?>
                <?= "<select id=\"podestrian_id\" name=\"podestrian_id\">" ?>
                <? foreach ($podestrians as $podestrian) { ?>
                    <?= "<option value=" ?>
                    <?=$podestrian->podestrian_id?><?=">"?>
                    <?=$podestrian->first_name?><?= " " ?><?=$podestrian->last_name?>
                    <?= "</option>" ;}?>
                <?= "</select>" ?>
                <?= "</div>";} ?>

            <div class="field">
                <label for="status_id">Status:</label>
                <select id="status_id" name="status_id">
                    <? foreach ($statuses as $status) { ?>
                        <option value="<?=$status->status_id?>"
                            <? if($booking_id != null) { if($status->status_id==$booking->status_id) { echo "selected";}}?>><?=$status->booking_status?></option>
                    <? } ?>
                </select>
            </div>

            <div class="field">
                <label for="pod_id">Pod:</label>
                <select id="pod_id" name="pod_id">
                    <? foreach ($pods as $pod) { ?>
                        <option value="<?=$pod->pod_id?>"
                            <? if($booking_id != null) { if($pod->pod_id==$booking->pod_id) { echo "selected";}}?>><?=$pod->comboname?></option>
                    <? } ?>
                </select>
            </div>

            <? if($booking_id == null) {?>
            <?="<div class=\"field\">" ?>
                <?="<label for=\"checkin_date\">Checkin Date:</label>"?>
                <?="<input type=\"date\" id=\"checkin_date\" name=\"checkin_date\" value=\""?><?=date("Y-m-d")?><?="\"/>"?>
            <?="</div>"?>

            <? }?>

            <div class="field">
                <label for="checkout_date">Checkout Date:</label>
                <input type="date" id="checkout_date" name="checkout_date" value="<? if($booking_id != null) { echo $booking->checkout_date; } else {echo date("Y-m-d");;} ?>"/>
            </div>

            <div class="field">
                <label for="price">Price:</label>
                <input type="number" step=".01" id="price" name="price" value="<? if($booking_id != null) { echo $booking->price; }; ?>"/>
            </div>

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