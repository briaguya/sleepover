<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
        <div class="span12">
			<a href="/sleepover/pod/add" class="btn btn-small btn-primary"><i class="btn-icon-only icon-ok"></i>Add Pods</a>
			<br><br>
			<table class="table table-striped table-bordered">
				<thead>
				  <tr>
				    <th> Pod Name </th>
				    <th> Pod Type </th>
				    <th class="td-actions"> Actions </th>
				  </tr>
				</thead>
				<tbody>
				<?
					foreach ($pods as $pod) {
						// $emp->username
				?>
				  <tr>
				    <td> <?=$pod->pod_name ?> </td>
				    <td> <?=$pod->pod_type ?> </td>
				    <td class="td-actions">
				    	<a href="/pod/modify/<?=$pod->room_type?>" class="btn btn-small btn-primary"><i class="btn-icon-only icon-edit"> </i></a>
				    	<a href="/pod/delete/<?=$pod->min_id?>" onclick="return confirm('Are you sure ?')" class="btn btn-danger btn-small"><i class="btn-icon-only icon-remove"> </i></a>
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