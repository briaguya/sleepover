<div class="main">
	<div class="main-inner">
		<div class="container">
			<div class="row">
				<div class="span12">
					<table class="table table-striped table-bordered">
						<thead>
						<tr>
							<th><a href="/sleepover/team_member/modify" class="btn btn-small btn-primary"><i class="btn-icon-only icon-plus"></a></th>
							<th> Name </th>
							<th> Login </th>
							<th> Role </th>
						</tr>
						</thead>
						<tbody>
						<?
						foreach ($team_members as $team_member) {
							?>
							<tr>
								<td> <a href="/sleepover/team_member/modify/<?=$team_member->team_id?>"><img src="/sleepover/img/success-kid-thumb.png"></a> </td>
								<td> <?=$team_member->first_name ." ".$team_member->last_name?> </td>
								<td> <?=$team_member->username ?> </td>
								<td> <?=$team_member->role ?> </td>
							</tr>
						<? } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>