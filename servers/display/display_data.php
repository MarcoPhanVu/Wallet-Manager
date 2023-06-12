<?php 
	$data_query = "SELECT * FROM $target_table";
	$data_query_result = mysqli_query($connection, $data_query);
	$data_list = mysqli_fetch_all($data_query_result, MYSQLI_ASSOC);

	$column_field_name_query = "SHOW COLUMNS FROM $target_table";
	$column_field_name_result = mysqli_query($connection, $column_field_name_query);
	// $column_field_name_result = $connection -> query($column_field_name_query); These are the same shits
?>

<table class="object-list large">
	<caption><?php echo ucfirst($target_table); ?>'s Data</caption>
	<thead>
		<tr>
			<?php
				if ($column_field_name_result) { // Check if the query was successful
					// Fetch the results
					while ($column = mysqli_fetch_array($column_field_name_result)) {
						// [$row = $column_field_name_result->fetch_assoc()] <= same shit
						echo '<td>' . $column["Field"] . '</td>';
					}
				} else {
					echo "Error: " . $connection->error;
				}
			?>
			<th>Actions</th>
		</tr>
	</thead>
	
	<tbody>
		<?php if (empty($data_list)): ?>
			<p>There is no data for table <?php echo $target_table; ?> for now</p>
		<?php endif; ?>

		<?php foreach ($data_list as $data): ?>
			<tr>
				<?php foreach (array_keys($data) as $key): ?>
					<td><?php echo $data[$key]; ?></td>
				<?php endforeach; ?>
				<td>
					<button class="action-btn edit">Edit</button>
					<button class="action-btn delete">Delete</button>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>