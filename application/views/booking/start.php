<div class="account-container" style="margin: 0 auto;">

    <div class="content clearfix">

        <form action="/sleepover/booking/check_availability" method="post">

            <h1>New Booking</h1>

            <div class="field">
                <label for="location_id">Location:</label>
                <select id="location_id" name="location_id">
                    <? foreach ($locations as $loc) { ?>
                        <option value="<?=$loc->location_id?>">
                            <?=$loc->location_name?></option>
                    <? } ?>
                </select>
            </div>

            <div class="field">
                <label for="pod_type">Pod Type:</label>
                <select id="pod_type" name="pod_type">
                    <? foreach ($pod_types as $type) { ?>
                        <option value="<?=$type->pod_type_id?>">
                            <?=$type->pod_type?></option>
                    <? } ?>
                </select>
            </div>

            <div class="field">
                <label for="checkin_date">Checkin Date:</label>
                <input type="date" id="checkin_date" name="checkin_date" value="<?=date("Y-m-d")?>"/>
            </div>

            <div class="field">
                <label for="checkout_date">Checkout Date:</label>
                <input type="date" id="checkout_date" name="checkout_date" value="<?=date("Y-m-d")?>"/>
            </div>

            <div class="login-actions">
                <button class="button btn btn-success btn-large">Find Pods</button>
            </div>

        </form>

    </div> <!-- /content -->

</div> <!-- /account-container -->