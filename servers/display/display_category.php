<?php 
	// ADD USER


	// LOAD USERS
	$category_query = "SELECT * FROM categories";
	$category_query_result = mysqli_query($connection, $category_query);
	$categories_list = mysqli_fetch_all($category_query_result, MYSQLI_ASSOC);
?>


<table class="object-list large">
	<caption>Categories List</caption>
	<thead>
		<tr>
			<?php foreach (array_keys($categories_list[0]) as $key): ?> // Use array_keys() for associative arrays
				<td><?php echo $key; ?></td>
			<?php endforeach; ?>
			<th>Actions</th>
		</tr>
	</thead>
	
	<tbody>
		<?php if (empty($categories_list)): ?>
			<p>There is no category for now</p>
		<?php endif; ?>

		<?php 
			echo "checker";
		?>

		<?php foreach ($categories_list as $category): ?>
			<tr>
				<?php foreach (array_keys($category) as $key): ?>
					<td><?php echo $category[$key]; ?></td>
				<?php endforeach; ?>
				<td>
					<button class="action-btn edit">Edit</button>
					<button class="action-btn delete">Delete</button>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>