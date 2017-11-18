
<h2>
	<a href="/passwords/create" class="btn btn-primary pull-right"> Add a
		new password </a>
</h2>

<table class="table table-striped">
	<caption>Passwords List</caption>
	<thead>
		<tr>
			<th>Service</th>
			<th>User Name</th>
			<th>Password</th>
			<th>Remarks</th>
			<th>Created on</th>
			<th>Updated on</th>
			<th></th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php
		foreach ( $result as $row ) {
			echo '<tr>' . PHP_EOL;
			echo '<td>' . $row->service . '</td>' . PHP_EOL;
			echo '<td>' . $row->user_name . '</td>' . PHP_EOL;
			echo '<td><a href="/passwords/send/' . $row->id . '">Send Password</td>' . PHP_EOL;
			echo '<td>' . $row->remarks . '</td>' . PHP_EOL;
			echo '<td>' . $row->created_at . '</td>' . PHP_EOL;
			echo '<td>' . $row->updated_at . '</td>' . PHP_EOL;
			echo '<td><a href="/passwords/edit/' . $row->id . '">Edit</a></td>' . PHP_EOL;
			echo '<td><a href="/passwords/delete/' . $row->id . '">Delete</a></td>' . PHP_EOL;
			echo '</tr>' . PHP_EOL;
		}
		?>
		</tbody>
</table>