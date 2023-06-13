<?php 
	$data_query = "SELECT * FROM $target_table";

    if(isset($custom_query)) {
        $data_query = $custom_query;
    } else { //JUST USE THE NORMAL QUERY TO EXTRACT FIELDNAME(because table may not contain any data yet)
		$column_field_name_query = "SHOW COLUMNS FROM $target_table";
		$column_field_name_result = mysqli_query($connection, $column_field_name_query);
	}



	$data_query_result = mysqli_query($connection, $data_query);
	$data_list = mysqli_fetch_all($data_query_result, MYSQLI_ASSOC);


    $target_table_size = @$target_table_size;
	// $column_field_name_result = $connection -> query($column_field_name_query); These are the same shits
?>

<div class="container">

	<table class="data-table <?php echo $target_table_size; ?>">
		<caption>
			<?php 
				if(isset($custom_table_name)) {
					echo ucfirst($custom_table_name);
				} else {
					echo ucfirst($target_table);
				}
			?>'s Data
		</caption>
		<thead>
			<tr>
				<?php
					// Display all columns of the table
					if ($column_field_name_result) { // Check if the query was successful
						$column_count = 0;
						// Fetch the results
						if (isset($custom_query)) { // => custom query means the data have been inserted successfully
							// have to get field name from the data
							foreach (array_keys($data_list[0]) as $field) {
								echo '<th>' . $field . '</th>';
							}
						} else {
							while ($column = mysqli_fetch_array($column_field_name_result)) {
								// [$row = $column_field_name_result->fetch_assoc()] <= same shit
								echo '<th>' . $column["Field"] . '</th>';
								++$column_count;
							}
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
				<tr><td class="text-center" colspan="<?php echo $column_count + 1; ?>">
					<p>There is no data for table <?php echo $target_table; ?> for now</p>
				</td></tr>
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
	
	<?php 
		// DELETE REPETITIVE VARIABLES TO PREVENT CONFLICTS
		$target_table = NULL;
		$target_table_size = NULL;
		$custom_query = NULL;
		$custom_table_name = NULL;
		$column_count = 0;
	?>
</div>
