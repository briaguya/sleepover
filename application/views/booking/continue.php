<div class="account-container" style="margin: 0 auto;">

    <div class="content clearfix">

        <form action="/sleepover/booking/blarg" method="post">

            <h1>Continue Booking</h1>

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
                <label for="pod_id">Pod:</label>
                <select id="pod_id" name="pod_id">
                    <? foreach ($pods as $pod) { ?>
                        <option value="<?=$pod->pod_id?>"><?=$pod->comboname?></option>
                    <? } ?>
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