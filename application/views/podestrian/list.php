<div class="main">
	<div class="main-inner">
		<div class="container">
			<div class="row">
				<div class="span12">
					<a href="/sleepover/podestrian/modify" class="btn btn-small btn-primary"><i class="btn-icon-only icon-ok"></i>Add Podestrian</a>
					<br><br>
					<table class="table table-striped table-bordered">
						<thead>
						<tr>
							<th></th>
							<th> Name </th>
							<th> Email </th>
							<th> Podestrian Type </th>
							<th> Address </th>
							<th> Sex </th>
                            <th> Birthday </th>
							<th> Social </th>
							<th class="td-actions"> </th>
						</tr>
						</thead>
						<tbody>
						<?
						foreach ($podestrians as $podestrian) {
							// $emp->username
							?>
							<tr>
								<td> <a href="/sleepover/podestrian/modify/<?=$podestrian->podestrian_id?>"><img src="/sleepover/img/success-kid-thumb.png"></a> </td>
								<td> <?=$podestrian->first_name ." ".$podestrian->last_name?> </td>
								<td> <?=$podestrian->email ?> </td>
								<td> <?=$podestrian->podestrian_type ?> </td>
								<td> <?=$podestrian->city .", ".$podestrian->country?> </td>
								<td> <?=$podestrian->sex ?> </td>
                                <td> <?=$podestrian->birthday ?> </td>
								<td>
                                    <a href="https://www.facebook.com/"><img src="/sleepover/img/fb40.png"></a>
                                    <a href="https://www.twitter.com/"><img src="/sleepover/img/tw40.png"></a>
                                    <a href="https://www.instagram.com/"><img src="/sleepover/img/ig40.png"></a>
                                </td>
                                <td class="td-actions"><a href="/sleepover/podestrian/delete/<?=$podestrian->podestrian_id?>" onclick="return confirm('Are you sure ?')" class="btn btn-danger btn-small"><i class="btn-icon-only icon-remove"> </i></a></td>
							</tr>
						<? } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>