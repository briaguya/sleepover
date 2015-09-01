<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
        <div class="span12">
			<a href="/sleepover/pod-type/add" class="btn btn-small btn-primary"><i class="btn-icon-only icon-ok"></i>Add Room Type</a>
			<br><br>
			<table class="table table-striped table-bordered">
				<thead>
				  <tr>
				    <th> Pod Type </th>
				    <th> Price </th>
				    <th> Details </th>
				    <th> Quantity </th>
				    <th class="td-actions"> Actions </th>
				  </tr>
				</thead>
				<tbody>
				<?
					foreach ($pod_types as $rt) {
				?>
				  <tr>
				    <td> <?=$rt->room_type ?> </td>
				    <td> <?=$rt->room_price ?>$ </td>
				    <td> <?=$rt->room_details ?> </td>
				    <td> <?=$rt->room_quantity ?> </td>
				    <td class="td-actions">
				    	<a href="/sleepover/pod-type/edit/<?=$rt->room_type?>" class="btn btn-small btn-primary"><i class="btn-icon-only icon-edit"> </i></a>
				    	<a href="/sleepover/pod-type/delete/<?=$rt->room_type?>" onclick="return confirm('Are you sure ?')" class="btn btn-danger btn-small"><i class="btn-icon-only icon-remove"> </i></a>
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