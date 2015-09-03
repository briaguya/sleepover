<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
        <div class="span12">
			<a href="/sleepover/pod/modify" class="btn btn-small btn-primary"><i class="btn-icon-only icon-ok"></i>Add Pod</a>
			<br><br>
			<table class="table table-striped table-bordered">
				<thead>
				  <tr>
					<th> Location </th>
				    <th> Pod Name </th>
				    <th> Pod Type </th>
				    <th class="td-actions"> Actions </th>
				  </tr>
				</thead>
				<tbody>
				<?
					foreach ($pods as $pod) {
				?>
				  <tr>
					<td> <?=$pod->location_name ?> </td>
				    <td> <?=$pod->pod_name ?> </td>
				    <td> <?=$pod->pod_type ?> </td>
				    <td class="td-actions">
				    	<a href="/sleepover/pod/modify/<?=$pod->pod_id?>" class="btn btn-small btn-primary"><i class="btn-icon-only icon-edit"> </i></a>
				    	<a href="/sleepover/pod/delete/<?=$pod->pod_id?>" onclick="return confirm('Are you sure ?')" class="btn btn-danger btn-small"><i class="btn-icon-only icon-remove"> </i></a>
				    </td>
				  </tr>
				<? } ?>
				</tbody>
			</table>
		</div>
	  </div>
	</div>
  </div>
</div>