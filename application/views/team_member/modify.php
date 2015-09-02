<div class="account-container" style="margin: 0 auto;">
	
	<div class="content clearfix">
		
		<form action="/sleepover/team_member/modify" method="post">
		
			<h1>
                <? if($team_id == null) {?>
                    <?="Add Team Member";?>
                <?} else {?>
                    <?="Edit Team Member";}?>
            </h1>
            <? if($team_id != null) {?>
                <?= "<h3>" ?>
                <?=$team_member->username?>
                <?= "</h3>" ;}?>

            <div class="add-fields">
                <? if($team_id == null) {?>
                    <?= "<div class=\"field\">" ?>
                        <?= "<label for=\"podestrian\">Login:</label>" ?>
                        <label for="podestrian_type_id">Podestrian Type:</label>
                        <select id="podestrian_type_id" name="podestrian_type_id">
                            <? foreach ($podestrian_types as $type) { ?>
                                <option value="<?=$type->podestrian_type_id?>"><?=$type->podestrian_type?></option>
                            <? } ?>
                        </select>
                    <?= "</div>" ?>

                    <?= "<div class=\"field\">" ?>
					    <?= "<label for=\"username\">Login:</label>" ?>
					    <?= "<input type=\"text\" id=\"username\" name=\"username\" required value=\"\"/>" ?>
				    <?= "</div>" ?>

				    <?= "<div class=\"field\">" ?>
					    <?= "<label for=\"password\">Password:</label>" ?>
					    <?= "<input type=\"text\" id=\"password\" name=\"password\" required value=\"\"/>" ?>
                    <?= "</div>";} ?>
			</div>
			
			<div class="login-actions">
                <? if($team_id != null) {?>
                    <?="<a href=\"/sleepover/team_member/delete/$team_member->team_id\" onclick=\"return confirm('Are you sure ?')\" class=\"button btn btn-danger btn-large\" style=\"float: left\">Delete</i></a></td>" ?>
                <? ;} ?>
				<button class="button btn btn-success btn-large">
                    <? if($podestrian_id == null) {?>
                        <?="Add";?>
                    <?} else {?>
                        <?="Save";}?>
                </button>
			</div>

		</form>
		
	</div> <!-- /content -->
	
</div> <!-- /account-container -->
<br>