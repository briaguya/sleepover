<div class="account-container" style="margin: 0 auto;">
	
	<div class="content clearfix">
		
		<form action="/sleepover/podestrian/modify" method="post">
		
			<h1>
                <? if($podestrian_id == null) {?>
                    <?="Add Podestrian";?>
                <?} else {?>
                    <?="Edit Podestrian";}?>
            </h1>

                <? if($podestrian_id != null) {?>
                    <?= "<h3>" ?>
                    <?=$podestrian->first_name ." ".$podestrian->last_name?>
                    <?= "</h3>" ?>
                    <?= "<h3>" ?>
                    <?=$podestrian->email ?>
                    <?= "</h3>" ;}?>
                <div class="add-fields">
                <? if($podestrian_id == null) {?>
				<?= "<div class=\"field\">" ?>
					<?= "<label for=\"first_name\">First Name:</label>" ?>
					<?= "<input type=\"text\" id=\"first_name\" name=\"first_name\" required value=\"\"/>" ?>
				<?= "</div>" ?>

				<?= "<div class=\"field\">" ?>
					<?= "<label for=\"last_name\">Last Name:</label>" ?>
					<?= "<input type=\"text\" id=\"last_name\" name=\"last_name\" required value=\"\"/>" ?>
				<?= "</div>" ?>

				<?= "<div class=\"field\">" ?>
					<?= "<label for=\"email\">Email Address:</label>" ?>
					<?= "<input type=\"text\" id=\"email\" name=\"email\" required value=\"\"/>" ?>
				<?= "</div>"; ?>
                    
                <div>todo:pic</div>

				<div class="field">
					<label for="podestrian_type_id">Podestrian Type:</label>
					<select id="podestrian_type_id" name="podestrian_type_id">
						<? foreach ($podestrian_types as $type) { ?>
							<option value="<?=$type->podestrian_type_id?>"><?=$type->podestrian_type?></option>
						<? } ?>
					</select>
				</div>

				<div class="field">
					<label for="address_id">Address:</label>
					<select id="address_id" name="address_id">
						<? foreach ($addresses as $address) { ?>
							<option value="<?=$address->address_id?>"><?=$address->city?>, <?=$address->country?></option>
						<? } ?>
					</select>
				</div>

                <div class="field">
                    <label for="sex">Sex:</label>
                    <select id="sex" name="sex">
                        <option value ="Female">Female</option>
                        <option value ="Male">Male</option>
                        <option value ="Not Applicable">Not Applicable</option>
                    </select>
                </div>

                <div class="field">
                    <label for="facebook">Facebook:</label>
                    <input type="text" id="facebook" name="facebook" value=""/>
                </div>

                <div class="field">
                    <label for="twitter">Twitter:</label>
                    <input type="text" id="twitter" name="twitter" value=""/>
                </div>

                <div class="field">
                    <label for="instagram">Instagram:</label>
                    <input type="text" id="instagram" name="instagram" value=""/>
                </div>

                <div class="field">
                    <label for="birthday">Birthday:</label>
                    <input type="date" id="birthday" name="birthday" value=""/>
                </div>

                <div class="field">
                    <label for="how_found">How they found us:</label>
                    <input type="text" id="how_found" name="how_found" value=""/>
                </div>

			</div>
			
			<div class="login-actions">
				
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