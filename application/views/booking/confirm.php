<div class="account-container" style="margin: 0 auto;">

    <div class="content clearfix">

        <form action="/sleepover/booking/blarg" method="post">

            <h1>Confirm Booking</h1>
            <h3><?=$pod->comboname?></h3>
            <h4>Check in: <?=date("l F j, Y",mktime($booking['checkin_date']))?></h4>
            <h4>Check out: <?=date("l F j, Y",mktime($booking['checkout_date']))?></h4>

            <div class=\"field\">
                <label for=\"podestrian\">Podestrian:</label>
                <select id=\"podestrian_id\" name=\"podestrian_id\">
                    <? foreach ($podestrians as $podestrian) { ?>
                        <?= "<option value=" ?>
                        <?=$podestrian->podestrian_id?><?=">"?>
                        <?=$podestrian->first_name?><?= " " ?><?=$podestrian->last_name?>
                        <?= "</option>" ;}?>
                </select>
            </div>

            <div class="field">
                <label for="status_id">Status:</label>
                <select id="status_id" name="status_id">
                    <? foreach ($statuses as $status) { ?>
                        <option value="<?=$status->status_id?>"><?=$status->booking_status?></option>
                    <? } ?>
                </select>
            </div>

            <div class="field">
                <label for="price">Price:</label>
                <input type="number" step=".01" id="price" name="price"/>
            </div>

            <div class="login-actions">
                <button class="button btn btn-success btn-large">Book</button>
            </div>

        </form>

    </div> <!-- /content -->

</div> <!-- /account-container -->