<div class="account-container" style="margin: 0 auto;">

    <div class="content clearfix">

        <form action="/sleepover/pod/save/<?=$pod_id?>" method="post">

            <h1>
                <? if($pod_id == null) {?>
                    <?="Add Pod";?>
                <?} else {?>
                    <?="Edit Pod";}?>
            </h1>

            <div class="field">
                <label for="location_id">Location:</label>
                <select id="location_id" name="location_id">
                    <? foreach ($locations as $loc) { ?>
                        <option value="<?=$loc->location_id?>"
                            <? if($pod_id != null) { if($loc->location_id==$pod->location_id) { echo "selected";}}?>><?=$loc->location_name?></option>
                    <? } ?>
                </select>
            </div>

            <div class="add-fields">
                <div class="field">
                    <label for="pod_name">Name:</label>
                    <input type="text" id="pod_name" name="pod_name" value="<? if($pod_id != null) { echo $pod->pod_name;}?>"/>
                </div>
            </div>

            <div class="field">
                <label for="pod_type">Pod Type:</label>
                <select id="pod_type" name="pod_type">
                    <? foreach ($pod_types as $type) { ?>
                        <option value="<?=$type->pod_type_id?>"
                            <? if($pod_id != null) { if($type->pod_type_id==$pod->pod_type) { echo "selected";}}?>><?=$type->pod_type?></option>
                    <? } ?>
                </select>
            </div>

            <div class="login-actions">
                <? if($pod_id != null) {?>
                    <?="<a href=\"/sleepover/pod/delete/$pod_id\" onclick=\"return confirm('Are you sure ?')\" class=\"button btn btn-danger btn-large\" style=\"float: left\">Delete</i></a></td>" ?>
                    <? ;} ?>
                <button class="button btn btn-success btn-large">
                    <? if($pod_id == null) {?>
                        <?="Add";?>
                    <?} else {?>
                        <?="Save";}?>
                </button>
            </div>

        </form>

    </div> <!-- /content -->

</div> <!-- /account-container -->