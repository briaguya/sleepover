<div class="main">
	<div class="main-inner">
		<div class="container">
			<div class="row">
				<div class="span12">
					<a href="/sleepover/podestrian/add" class="btn btn-small btn-primary"><i class="btn-icon-only icon-ok"></i>Add Podestrian</a>
					<br><br>
					<table class="table table-striped table-bordered">
						<thead>
						<tr>
							<th> todo: Pic </th>
							<th> Name </th>
							<th> Email </th>
							<th> Podestrian Type </th>
							<th> Address </th>
							<th> Sex </th>
							<th> Facebook </th>
							<th> Twitter </th>
							<th> Instagram </th>
							<th> Birthday </th>
							<th> How they found Podshare </th>
							<th class="td-actions"> Actions </th>
						</tr>
						</thead>
						<tbody>
						<?
						foreach ($podestrians as $podestrian) {
							// $emp->username
							?>
							<tr>
								<td> Pic Here? </td>
								<td> <?=$podestrian->first_name ." ".$podestrian->last_name?> </td>
								<td> <?=$podestrian->email ?> </td>
								<td> todo: Type </td>
								<td> todo: Address </td>
								<td> <?=$podestrian->sex ?> </td>
								<td> <?=$podestrian->facebook ?> </td>
								<td> <?=$podestrian->twitter ?> </td>
								<td> <?=$podestrian->instagram ?> </td>
								<td> todo: Birthday </td>
								<td> <?=$podestrian->how_found ?> </td>
								<td class="td-actions"><a href="/podestrian/edit/<?=$podestrian->podestrian_id?>" class="btn btn-small btn-primary"><i class="btn-icon-only icon-edit"> </i></a><a href="/podestrian/delete/<?=$podestrian->podestrian_id?>" onclick="return confirm('Are you sure ?')" class="btn btn-danger btn-small"><i class="btn-icon-only icon-remove"> </i></a></td>
							</tr>
						<? } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>