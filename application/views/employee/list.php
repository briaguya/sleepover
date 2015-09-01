<div class="main">
	<div class="main-inner">
		<div class="container">
			<div class="row">
				<div class="span12">
					<a href="/sleepover/employee/add" class="btn btn-small btn-primary"><i class="btn-icon-only icon-ok"></i>Add Employee</a>
					<br><br>
					<table class="table table-striped table-bordered">
						<thead>
						<tr>
							<th> Fullname </th>
							<th> Username </th>
							<th> Department </th>
							<th> Job </th>
							<th> Email </th>
							<th class="td-actions"> Actions </th>
						</tr>
						</thead>
						<tbody>
						<?php
						foreach ($employees as $emp)
						{
						echo "<tr>";
                        echo "<td>";
                        echo $emp->employee_firstname;
                        echo " ";
                        echo $emp->employee_lastname;
                        echo "</td><td>";
                        echo $emp->employee_username;
                        echo "</td><td>";
                        echo $emp->department_name;
                        echo "</td><td>";
                        echo $emp->employee_type;
                        echo "</td><td>";
                        echo $emp->employee_email;
                        echo "</td>";
                        echo "<td class=\"td-actions\">";
                        echo "<a href=\"/sleepover/employee/edit/";
                        echo $emp->employee_id;
                        echo "\"";
                        echo "class=\"btn btn-small btn-primary\"><i class=\"btn-icon-only icon-edit\"></i></a>";
                        echo "<a href=\"/employee/delete/";
                        echo $emp->employee_id;
                        echo "\"onclick=\"return confirm('Are you sure ?')\" class=\"btn btn-danger btn-small\"><i class=\"btn-icon-only icon-remove\"></i></a></td>";
                        echo "</tr>";
						} ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>