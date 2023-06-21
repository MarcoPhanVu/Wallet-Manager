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


	if (isset($target_table_size)) {
		$target_table_size = @$target_table_size;
	} else {
		$target_table_size = 1;
	}
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
					<?php 
						// print_r($data);
						$countKey = 0;
						$recordID = "";

						foreach (array_keys($data) as $key) {
							if ($countKey == 0) {
								$recordID = $data[$key];
								$countKey++;
							}
							echo "<td>$data[$key]</td>";
						}
					?>

					<td>
						<button class="action-btn edit notYet">Edit</button>
						<button class="action-btn delete notYet" <?php echo "data-table-id='" . $target_table . "' data-record-id='" . $recordID . "'"; ?>>Delete</button>
						<!-- THIS SHIT GONNA NEED AJAX -->
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
		$countKey = 0;
		$recordID = NULL;
	?>
</div>
